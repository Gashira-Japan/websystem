<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
ディスクリプション
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
function meta_box() {
	wp_nonce_field(wp_create_nonce(__FILE__), 'description_nonce');
	$description = get_post_meta(get_the_ID(), 'description', true);
?>
<textarea name="description" rows="5"><?= esc_attr(stripslashes_deep(strip_tags($description))) ?></textarea>
<?php
}

add_action('add_meta_boxes', function() {
	add_meta_box('description', 'ディスクリプション', 'meta_box', POST_TYPES, 'side');
});
 
add_action('save_post', function($post_id) {
	if (!isset($_POST['description_nonce']) || 
		!wp_verify_nonce($_POST['description_nonce'], wp_create_nonce(__FILE__)) || 
		(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
		return;
	}

	if (isset($_POST['description'])) {
		update_post_meta($post_id, 'description', $_POST['description']);
	} else {
		delete_post_meta($post_id, 'description');
	}
});

foreach (POST_TYPES as $post_type) {
	add_filter('manage_edit-' . $post_type . '_columns', function($columns) {
		$columns['description'] = 'ディスクリプション';
		return $columns;
	});

	add_action('manage_' . $post_type . 's_custom_column', function($column_name, $post_id) {
		if ($column_name == 'description') {
			echo get_post_meta($post_id, 'description', true);
		}
	}, 10, 2);
}

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
OGP
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
add_action('wp_head', function() {
	$ogp_image       = get_theme_file_uri('/img/common/ogp.png');
	$og_locale       = 'ja_JP';
	$twitter_card    = 'summary_large_image';
	$twitter_site    = '';
	$facebook_app_id = '';

	$ogp_title = wp_get_document_title();
	$ogp_description = get_bloginfo('description');
	$ogp_type = 'article';
	$ogp_url = get_current_url();

	if (is_front_page() || is_home()) {
		$ogp_type = 'website';

	} else {
		if (is_singular() && get_the_excerpt()) {
			$ogp_description = wp_trim_words(get_the_excerpt(), 100, '…');
		}
	}

	if (is_singular()) {
		if (has_post_thumbnail()) {
			$ogp_image = get_the_post_thumbnail_url(get_the_ID(), array(1200, 630));
		} else {
			preg_match_all('/<img.+src=[\'"]([^\'"]+.jpg)[\'"].*>/i', get_the_content(), $matches);
			if (!empty($matches[1])) {
				$image = $matches[1][0];
				if ($image) {
					$ogp_image = str_replace('/img/', get_theme_file_uri('/img/'), $image);
				}
			}
		}

		$description = get_post_meta(get_the_ID(), 'description', true);

		if ($description) {
			$ogp_description = $description;
		}
	}

	$html = '
<meta name="description" content="' . esc_attr($ogp_description) . '">
<meta property="og:title" content="' . esc_attr($ogp_title) . '">
<meta property="og:description" content="' . esc_attr($ogp_description) . '">
<meta property="og:type" content="' . $ogp_type . '">
<meta property="og:url" content="' . esc_url($ogp_url) . '">
<meta property="og:image" content="' . esc_url($ogp_image) . '">
<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">
<meta property="og:locale" content="' . $og_locale . '">
<meta name="twitter:card" content="' . $twitter_card . '">' . "\n";

	if ($twitter_site) {
		$html .= '<meta name="twitter:site" content="' . $twitter_site . '">' . "\n";
	}

	if ($facebook_app_id) {
		$html .= '<meta property="fb:app_id" content="' . $facebook_app_id . '">' . "\n";
	}

	echo $html;
});
?>
