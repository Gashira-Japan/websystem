<?php
define('POST', 'news');
define('CUSTOM_POST_TYPES', array('blog-tenfive', 'member', 'recruit'));

$post_types = array('post', 'page');
if (is_array(CUSTOM_POST_TYPES)) {
	$post_types = array_merge($post_types, CUSTOM_POST_TYPES);
}
define('POST_TYPES', $post_types);

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('editor-styles');

/* パス置換 */
add_action('the_content', function($content) {
	$content = str_replace('src="/home_url/' , 'src="'    . home_url('/')                , $content);
	$content = str_replace('src="/img/'      , 'src="'    . get_theme_file_uri('/img/')  , $content);
	$content = str_replace('srcset="/img/'   , 'srcset="' . get_theme_file_uri('/img/')  , $content);
	$content = str_replace('src="/audio/'    , 'src="'    . get_theme_file_uri('/audio/'), $content);
	$content = str_replace('src="/video/'    , 'src="'    . get_theme_file_uri('/video/'), $content);
	$content = str_replace('poster="/img/'   , 'poster="' . get_theme_file_uri('/img/')  , $content);
	$content = str_replace('href="/home_url/', 'href="'   . home_url('/')                , $content);
	$content = str_replace('href="/file/'    , 'href="'   . get_theme_file_uri('/file/') , $content);
	return $content;
});

/* スクリプト */
add_action('wp_enqueue_scripts', function() {
    $common_css_version = filemtime(get_theme_file_path('/css/common.css'));
    wp_enqueue_style('theme-common', get_theme_file_uri('/css/common.css'), array(), $common_css_version);

    $site_url = site_url();
    wp_enqueue_style('chatbot-styles', $site_url . '/chatbot/chatbot-styles.css', array(), '1.0.0');
    wp_enqueue_script('chatbot-script', $site_url . '/chatbot/chatbot-script.js', array('jquery'), '1.0.0', true);

    $slug = get_parent_slug();
    if (preg_match('/^blog/', $slug)) {
        $slug = 'blog';
    }

    wp_add_inline_script('jquery', "
        console.log('Debug Info:');
        console.log('Page ID:', '" . get_the_ID() . "');
        console.log('Is Partners Page:', '" . (is_page('partners') ? 'Yes' : 'No') . "');
        console.log('Is Page 2957:', '" . (is_page(2957) ? 'Yes' : 'No') . "');
        console.log('Theme Directory:', '" . get_template_directory_uri() . "');
        console.log('Partner JS Path:', '" . get_template_directory_uri() . "/js/partner-lp.js');
    ");

    if (is_page('partners') || is_page(2957)) {
        $theme_path = get_template_directory();
        $js_file = '/js/partner-lp.js';
        $css_file = '/css/partner-lp.css';

        wp_add_inline_script('jquery', "
            console.log('Partner Page Debug:');
            console.log('CSS File Exists:', '" . (file_exists($theme_path . $css_file) ? 'Yes' : 'No') . "');
            console.log('JS File Exists:', '" . (file_exists($theme_path . $js_file) ? 'Yes' : 'No') . "');
        ");

        if (file_exists($theme_path . $css_file)) {
            wp_enqueue_style('partner-lp-style', get_template_directory_uri() . $css_file, array('theme-common'), filemtime($theme_path . $css_file));
        }

        wp_enqueue_script('gsap-core', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
        wp_enqueue_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap-core'), '3.12.2', true);

        if (file_exists($theme_path . $js_file)) {
            wp_enqueue_script('partner-lp-script', get_template_directory_uri() . $js_file, array('jquery', 'gsap-core', 'gsap-scroll-trigger'), filemtime($theme_path . $js_file), true);
            wp_add_inline_script('partner-lp-script', "console.log('Partner LP Script loaded');");
        } else {
            wp_add_inline_script('jquery', "console.log('Partner LP Script not found');");
        }
    } elseif ($slug) {
        $file = '/css/' . $slug . '.css';
        if (file_exists(get_theme_file_path($file))) {
            $slug_css_version = filemtime(get_theme_file_path($file));
            wp_enqueue_style('theme-' . $slug, get_theme_file_uri($file), array(), $slug_css_version);
        }
    }

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery-core');

    if ($slug == 'home') {
        wp_enqueue_script('particles', 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js', array(), false, true);
    }

    wp_enqueue_script('theme-common', get_theme_file_uri('/js/common.js'), array(), false, true);

    $slug = get_parent_slug();
    $current_page_id = get_the_ID();

    if ($slug != 'contact') {
        if ($slug == 'entry' || $slug == 'erp' || $slug == 'ai-object-detection' || 
            (strpos($slug, 'recruit') === 0 && is_single()) || 
            is_page('partners') || is_page(2957)) {
            wp_register_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true);
            wp_enqueue_script('google-recaptcha');
        } else {
            wp_deregister_script('google-recaptcha');
        }
    }
}, 20);

/* 投稿 */
add_filter('post_type_labels_post', function($labels) {
	$labels->name          = 'お知らせ';
	$labels->singular_name = 'お知らせ';
	$labels->all_items     = 'お知らせ一覧';
	$labels->menu_name     = 'お知らせ';
	return $labels;
});

foreach (array('created_category', 'edited_category', 'delete_category') as $hook) {
	add_action($hook, function() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules(false);
	});
}

add_filter('category_rewrite_rules', function($rule) {
	$rule = array();
	$categories = get_categories(array('hide_empty' => 0));
	global $wp_rewrite;
	foreach($categories as $category) {
		$category_slug = $category->slug;
		if ($category->parent == $category->cat_ID) {
			$category->parent = 0;
		} elseif ($category->parent != 0) {
			$category_slug = get_category_parents($category->parent, false, '/', true) . $category_slug;
		}
		$rule[POST . "/({$category_slug})/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?$"] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$rule[POST . '/(' . $category_slug . ')/?$'] = 'index.php?category_name=$matches[1]';
	}
	return $rule;
});

add_filter('term_link', function($link) {
	$link = str_replace('/category/', '/', $link);
	return $link;
});

/* テンプレート階層化 */
add_filter('page_template_hierarchy', function($templates) {
	$template_slug = get_page_template_slug();
	$pagename = get_query_var('pagename', '');
	if (!$template_slug && $pagename) {
		$pagename = str_replace('/', '__', $pagename);
		$decoded  = urldecode($pagename);
		if ($pagename === $decoded) {
			array_unshift($templates, "page-{$pagename}.php");
		}
	}
	return $templates;
});

/* テンプレートパーツ */
add_shortcode('get_template_part', function($atts) {
	ob_start();
	get_template_part($atts['template'], null, $atts['post_type']);
	return ob_get_clean();
});

/* メニュー */
add_action('after_setup_theme', function() {
	register_nav_menu('primary', __('Primary Menu', 'theme-slug'));
});

/* タイトル */
add_filter('document_title_separator', function($separator) {
	return '|';
});

add_filter('document_title_parts', function($title) {
	unset($title['page']);
	if (is_category() || is_tag() || is_single()) {
		$pt = get_post_type();
		if ($pt) {
			$obj = get_post_type_object($pt);
			if ($obj && isset($obj->labels->name)) {
				$title['title'] .= ' | ' . $obj->labels->name;
			}
		}
	} elseif (is_tax()) {
		$category = get_queried_object();
		if ($category && isset($category->name)) {
			$title['title'] = $category->name . ' | ' . ($title['title'] ?? '');
		}
	} elseif (is_page()) {
		$anc = get_post_ancestors(get_the_ID());
		if (!empty($anc)) {
			$parent_id   = (int) array_pop($anc);
			$parent      = get_post($parent_id);
			$parent_slug = $parent ? $parent->post_name : '';
			if ($parent && $parent_slug !== 'contact') {
				$title['title'] .= ' | ' . $parent->post_title;
			}
		}
	} elseif (is_404()) {
		$title['title'] = 'お探しのページは見つかりません';
	}
	return $title;
});

add_filter('get_the_archive_title', function($title) {
	if (is_category() || is_tag() || is_tax()) {
		$title = single_cat_title('', false);
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});

/* 自動整形 */
add_action('wp', function() {
	if (is_page()) {
		remove_filter('the_content', 'wpautop');
	}
});

add_filter('tiny_mce_before_init', function($init) {
	global $allowedposttags;
	$init['valid_elements']          = '*[*]';
	$init['extended_valid_elements'] = '*[*]';
	$init['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
	$init['indent']                  = true;
	$init['wpautop']                 = false;
	$init['force_p_newlines']        = false;
	return $init;
});

add_action('init', function() {
	remove_action('wp_head'            , 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles'    , 'print_emoji_styles');
	remove_action('admin_print_styles' , 'print_emoji_styles');
	remove_filter('the_content_feed'   , 'wp_staticize_emoji');
	remove_filter('comment_text_rss'   , 'wp_staticize_emoji');
	remove_filter('wp_mail'            , 'wp_staticize_emoji_for_email');
});
add_filter('run_wptexturize', '__return_false');

/* 抜粋 */
add_filter('excerpt_length', function() { return 50; }, 999);
add_filter('excerpt_more', function() { return '…'; });

/* 投稿者アーカイブ無効 */
add_action('parse_query', function($query) {
	if (is_author() && !is_admin()) {
		$query->set_404();
		status_header(404);
		nocache_headers();
	}
});

/* 添付ファイルページ noindex */
add_action('wp_head', function() {
	if (is_attachment()) {
		echo "\n" . '<meta name="robots" content="noindex">' . "\n";
	}
});

/* 投稿タイプ取得 */
function get_current_post_type() {
	$pt = get_post_type();
	if ($pt) return (string) $pt;
	$q = get_query_var('post_type');
	if (is_array($q)) return (string) ($q[0] ?? 'post');
	if (!empty($q))   return (string) $q;
	return is_page() ? 'page' : 'post';
}

/* 親ページスラッグ取得 */
function get_parent_slug() {
	if (is_404()) return 'notfound';
	$post_type = get_current_post_type();
	if ($post_type === 'page' && is_page()) {
		$ancestors = get_post_ancestors(get_the_ID());
		if (!empty($ancestors)) {
			$parent_id   = (int) array_pop($ancestors);
			$parent_post = get_post($parent_id);
			return $parent_post ? (string) $parent_post->post_name : '';
		}
		$self = get_post(get_the_ID());
		return $self ? (string) $self->post_name : '';
	}
	if ($post_type === 'post') {
		return POST;
	}
	return (string) $post_type;
}

/* 現在のURL取得 */
function get_current_url() {
	return (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

require('inc/custom-post-type.php');
require('inc/ogp.php');

/* Basic認証 */
function basic_auth($userArray) {
    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
        if (isset($userArray[$username]) && $userArray[$username] == $password) {
            return;
        }
    }
    header('WWW-Authenticate: Basic realm="My Private Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo '認証が必要です';
    exit;
}

/* 求人検索対応 */
function get_job_type_value() {
    global $post;
    return get_field('job_type', $post->ID);
}
add_filter('wpcf7_form_tag', 'dynamic_value_job_type', 10, 2);
function dynamic_value_job_type($tag, $unused) {
    if ($tag['name'] != 'job_type') {
        return $tag;
    }
    $tag['values'] = array(get_job_type_value());
    return $tag;
}

/* 複数メニュー */
function register_my_menus() { 
  register_nav_menus( array(
    'ten-menu' => 'tenmenu',
    'sp-ten-menu' => 'sp-tenmenu',
    'ten-menu-recruitment' => 'tenmenu-recruitment',
  ) );
}
add_action( 'after_setup_theme', 'register_my_menus' );

/* ウィジェット */
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => 'サイドバー',
        'id' => 'sidebar',
    ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );

/* パーマリンクフラッシュはテーマ有効化時のみ */
add_action('after_switch_theme', function() {
    flush_rewrite_rules(false);
});

/* Nonce寿命延長 */
add_filter( 'ppp_nonce_life', 'my_nonce_life' );
function my_nonce_life() {
    return 60 * 60 * 24 * 365;
}
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
画像生成AI URL
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/

// 画像生成機能の読み込み
if (file_exists(ABSPATH . 'image-generative/functions.php')) {
    require_once(ABSPATH . 'image-generative/functions.php');
}