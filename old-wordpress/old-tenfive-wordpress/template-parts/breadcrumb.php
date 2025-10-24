<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
パンくずリスト
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
if (!is_front_page() && !is_page('home')) {
	$post_type = get_current_post_type();
	$label = get_post_type_object($post_type)->labels;
	$position = 2;

	$html = '
<div class="breadcrumb">
	<div class="inner">
		<ul itemscope itemtype="https://schema.org/BreadcrumbList">
			<li>
				<a href="' . home_url() . '" ><span>' . get_post(get_page_by_path('home'))->post_title . '</span></a>
				<meta content="1">
			</li>';

	if (is_category() || is_tag() || is_tax()) {
		$html .= '
			<li>
				<a href="' . get_post_type_archive_link($post_type) . '"><span>' . $label->name . '</span></a>
				<meta content="' . $position . '">
			</li>' . "\n";

		$position++;
		$category    = get_queried_object();
		$category_id = $category->parent;
		$taxonomy    = $category->taxonomy;
		$position   += count(get_ancestors($category_id, $taxonomy));

		$category_list = '';

		while ($category_id) {
			$category = get_term($category_id);

			$category_list = '
			<li>
				<a href="' . get_term_link($category) . '"><span>' . $category->name . '</span></a>
				<meta content="' . $position . '">
			</li>' . "\n" . $category_list;

			$category_id = $category->parent;
			$position--;
		}

		$html .= $category_list . "\n";
		$html .= '			<li>' . get_the_archive_title() . '</li>' . "\n";

	} elseif (is_single()) {
		$html .= '
			<li>
				<a href="' . get_post_type_archive_link($post_type) . '"><span>' . $label->name . '</span></a>
				<meta content="' . $position . '">
			</li>' . "\n";

		$position++;
		$taxonomy = array_keys(get_the_taxonomies());
		$taxonomy = !empty($taxonomy) ? $taxonomy[0] : '';
		$terms = get_the_terms(get_the_ID(), $taxonomy);
		$category = !empty($terms) && is_array($terms) ? $terms[0] : null;
		if ($category) {
			$category_id = $category->term_id;
			$position += count(get_ancestors($category_id, $taxonomy));

			$category_list = '';

			while ($category_id) {
				$category = get_term($category_id);

				if ($category->slug != 'uncategorized') {
					$category_list = '
			<li>
				<a href="' . get_term_link($category) . '"><span>' . $category->name . '</span></a>
				<meta content="' . $position . '">
			</li>' . "\n" . $category_list;

					$position--;
				}

				$category_id = $category->parent;
			}

			$html .= $category_list . "\n";
			$html .= '			<li>' . wp_trim_words(get_the_title(), 20, '…') . '</li>';
		}

	} elseif ($post_type == 'post' || is_post_type_archive()) {
		$html .= '			<li>' . $label->name . '</li>';

	} elseif (is_page()) {
		$page_id = get_queried_object()->post_parent;
		$position += count(get_ancestors($page_id, 'page'));
		$page_list = '';

		while ($page_id) {
			$page = get_post($page_id);

			if ($page->post_name != 'contact') {
				$page_list = '
			<li>
				<a href="' . get_page_link($page_id) . '"><span>' . $page->post_title . '</span></a>
				<meta content="' . $position . '">
			</li>' . "\n" . $page_list;
			}

			$page_id = $page->post_parent;
			$position--;
		}

		if (!empty($page_list)) {
			$html .= $page_list . "\n";
		}
		$html .= '			<li>' . get_the_title() . '</li>';

	} elseif (is_404()) {
		$html .= '			<li>404 Not found</li>';
	}

	$html .= '
		</ul>
	</div>
</div>';

	$html = str_replace('<li>' . "\n", '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">' . "\n", $html);
	$html = str_replace('<a href='   , '<a itemprop="item" href='                                                               , $html);
	$html = str_replace('<span>'     , '<span itemprop="name">'                                                                 , $html);
	$html = str_replace('<meta '     , '<meta itemprop="position" '                                                             , $html);

	echo $html;
}
?>
