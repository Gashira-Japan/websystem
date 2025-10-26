<?php
/**
 * TenFive Recruit Theme Functions
 *
 * @package TenFive_Recruit
 * @since 1.0.0
 */

// テーマのセットアップ
function tenfive_recruit_setup() {
    // タイトルタグのサポート
    add_theme_support( 'title-tag' );

    // アイキャッチ画像のサポート
    add_theme_support( 'post-thumbnails' );

    // HTMLフィードリンクのサポート
    add_theme_support( 'automatic-feed-links' );

    // HTML5マークアップのサポート
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // カスタムロゴのサポート
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // ナビゲーションメニューの登録
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'tenfive-recruit' ),
        'footer'  => __( 'Footer Menu', 'tenfive-recruit' ),
    ) );
}
add_action( 'after_setup_theme', 'tenfive_recruit_setup' );

// スタイルとスクリプトの読み込み
function tenfive_recruit_enqueue_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    // Google Fonts
    wp_enqueue_style(
        'tenfive-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // テーマのメインスタイルシート（WordPress必須）
    wp_enqueue_style( 'tenfive-recruit-style', get_stylesheet_uri(), array(), $theme_version );

    // デザインシステム
    wp_enqueue_style( 'tenfive-design-system', get_template_directory_uri() . '/css/design-system.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-nav-reset', get_template_directory_uri() . '/css/nav-reset.css', array(), $theme_version );

    // 共有コンポーネント
    wp_enqueue_style( 'tenfive-shared-components', get_template_directory_uri() . '/shared-components.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-components', get_template_directory_uri() . '/css/components.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-card-system', get_template_directory_uri() . '/css/card-system.css', array(), $theme_version );

    // 共有セクション
    wp_enqueue_style( 'tenfive-shared-sections', get_template_directory_uri() . '/shared-sections.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-sections', get_template_directory_uri() . '/css/sections.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-selection-system', get_template_directory_uri() . '/css/selection-system.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-shared-news-system', get_template_directory_uri() . '/shared-news-system.css', array(), $theme_version );

    // ニュース関連CSS
    wp_enqueue_style( 'tenfive-news-list', get_template_directory_uri() . '/css/news-list.css', array(), $theme_version );
    wp_enqueue_style( 'tenfive-news-detail', get_template_directory_uri() . '/css/news-detail.css', array(), $theme_version );

    // ページ別CSS（条件付き読み込み）
    if ( is_page_template( 'page-new-grad.php' ) ) {
        wp_enqueue_style( 'tenfive-new-grad', get_template_directory_uri() . '/css/new-grad.css', array(), $theme_version );
    }
    if ( is_page_template( 'page-mid-career.php' ) ) {
        wp_enqueue_style( 'tenfive-mid-career', get_template_directory_uri() . '/css/mid-career.css', array(), $theme_version );
    }

    // JavaScript
    wp_enqueue_script( 'tenfive-hero-slider', get_template_directory_uri() . '/shared-hero-slider.js', array(), $theme_version, true );
    wp_enqueue_script( 'tenfive-main', get_template_directory_uri() . '/js/main.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'tenfive_recruit_enqueue_scripts' );

// カスタム投稿タイプ：ニュース
function tenfive_recruit_register_news_post_type() {
    $labels = array(
        'name'                  => 'ニュース',
        'singular_name'         => 'ニュース',
        'menu_name'             => 'ニュース',
        'add_new'               => '新規追加',
        'add_new_item'          => '新しいニュースを追加',
        'edit_item'             => 'ニュースを編集',
        'new_item'              => '新しいニュース',
        'view_item'             => 'ニュースを表示',
        'search_items'          => 'ニュースを検索',
        'not_found'             => 'ニュースが見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱にニュースがありません',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'news' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'          => true, // Gutenbergエディタサポート
    );

    register_post_type( 'news', $args );
}
add_action( 'init', 'tenfive_recruit_register_news_post_type' );

// カスタムタクソノミー：ニュースカテゴリー
function tenfive_recruit_register_news_taxonomies() {
    // カテゴリー
    $labels = array(
        'name'              => 'ニュースカテゴリー',
        'singular_name'     => 'ニュースカテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新しいカテゴリーを追加',
        'new_item_name'     => '新しいカテゴリー名',
        'menu_name'         => 'カテゴリー',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'news-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'news_category', array( 'news' ), $args );

    // タグ
    $tag_labels = array(
        'name'                       => 'ニュースタグ',
        'singular_name'              => 'ニュースタグ',
        'search_items'               => 'タグを検索',
        'popular_items'              => '人気のタグ',
        'all_items'                  => 'すべてのタグ',
        'edit_item'                  => 'タグを編集',
        'update_item'                => 'タグを更新',
        'add_new_item'               => '新しいタグを追加',
        'new_item_name'              => '新しいタグ名',
        'separate_items_with_commas' => 'タグをカンマで区切る',
        'add_or_remove_items'        => 'タグを追加または削除',
        'choose_from_most_used'      => 'よく使われるタグから選択',
        'menu_name'                  => 'タグ',
    );

    $tag_args = array(
        'hierarchical'          => false,
        'labels'                => $tag_labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'news-tag' ),
        'show_in_rest'          => true,
    );

    register_taxonomy( 'news_tag', 'news', $tag_args );
}
add_action( 'init', 'tenfive_recruit_register_news_taxonomies' );

// 抜粋文の長さをカスタマイズ
function tenfive_recruit_custom_excerpt_length( $length ) {
    return 120;
}
add_filter( 'excerpt_length', 'tenfive_recruit_custom_excerpt_length', 999 );

// 抜粋の省略記号をカスタマイズ
function tenfive_recruit_custom_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'tenfive_recruit_custom_excerpt_more' );

// アイキャッチ画像のサイズを追加
function tenfive_recruit_image_sizes() {
    add_image_size( 'news-thumbnail', 800, 450, true );  // ニュースカード用
    add_image_size( 'news-large', 1200, 675, true );     // ニュース詳細用
    add_image_size( 'hero-slide', 1920, 1080, true );    // ヒーロースライダー用
}
add_action( 'after_setup_theme', 'tenfive_recruit_image_sizes' );

// ページネーション機能
function tenfive_recruit_pagination() {
    global $wp_query;

    $big = 999999999;

    $paginate_links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '<span class="pagination__prev">前へ</span>',
        'next_text' => '<span class="pagination__next">次へ</span>',
        'type'      => 'list',
    ) );

    if ( $paginate_links ) {
        echo '<nav class="pagination">';
        echo $paginate_links;
        echo '</nav>';
    }
}

// カスタムナビゲーションウォーカー（ドロップダウン対応）
class TenFive_Recruit_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<div class=\"nav__dropdown\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</div>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav__item';

        if ( $args->walker->has_children ) {
            $classes[] = 'nav__item--has-dropdown';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        if ( $depth === 0 ) {
            $output .= $indent . '<li' . $class_names . '>';

            if ( $args->walker->has_children ) {
                $output .= '<button class="nav__link nav__link--dropdown" aria-expanded="false">';
                $output .= apply_filters( 'the_title', $item->title, $item->ID );
                $output .= '</button>';
            } else {
                $output .= '<a href="' . esc_attr( $item->url ) . '" class="nav__link">';
                $output .= apply_filters( 'the_title', $item->title, $item->ID );
                $output .= '</a>';
            }
        } else {
            $output .= $indent . '<a href="' . esc_attr( $item->url ) . '" class="dropdown__link">';
            $output .= apply_filters( 'the_title', $item->title, $item->ID );
            $output .= '</a>';
        }
    }
}

// ウィジェットエリアの登録
function tenfive_recruit_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'tenfive-recruit' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'tenfive-recruit' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'tenfive_recruit_widgets_init' );
