<?php
/**
 * テンファイブ統一ニュースシステム - WordPress関数
 * コーポレートサイト・採用サイト共通
 */

/**
 * ニュース一覧を表示する関数
 * 
 * @param array $args 表示オプション
 * @return string HTML
 */
function tenfive_display_news_list($args = []) {
    $defaults = [
        'posts_per_page' => 5,
        'post_type' => 'post',
        'category_name' => 'news',
        'show_excerpt' => true,
        'show_author' => false,
        'show_categories' => false,
        'show_date' => true,
        'show_badge' => true,
        'badge_field' => 'news_type', // カスタムフィールド名
        'link_text' => 'すべてのお知らせを見る',
        'link_url' => '/news/',
        'container_class' => 'news',
        'item_class' => 'news__item',
        'date_format' => 'Y.m.d',
        'excerpt_length' => 100
    ];
    
    $args = wp_parse_args($args, $defaults);
    
    // 投稿を取得
    $posts = get_posts([
        'numberposts' => $args['posts_per_page'],
        'post_type' => $args['post_type'],
        'category_name' => $args['category_name'],
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
    
    if (empty($posts)) {
        return '<p>お知らせはありません。</p>';
    }
    
    ob_start();
    ?>
    <section class="<?php echo esc_attr($args['container_class']); ?>" data-section="news" id="news">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">お知らせ</h2>
                <p class="section__subtitle">News</p>
            </div>
            <div class="news__list">
                <?php foreach ($posts as $post): ?>
                    <?php setup_postdata($post); ?>
                    <?php echo tenfive_render_news_item($post, $args); ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php if ($args['link_text'] && $args['link_url']): ?>
                <div class="news__footer">
                    <a href="<?php echo esc_url($args['link_url']); ?>" class="link-text"><?php echo esc_html($args['link_text']); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * 個別のニュースアイテムをレンダリング
 * 
 * @param WP_Post $post 投稿オブジェクト
 * @param array $args 表示オプション
 * @return string HTML
 */
function tenfive_render_news_item($post, $args = []) {
    $post_id = $post->ID;
    $post_title = get_the_title($post_id);
    $post_excerpt = $args['show_excerpt'] ? get_the_excerpt($post_id) : '';
    $post_url = get_permalink($post_id);
    $post_date = get_the_date($args['date_format'], $post_id);
    $post_author = $args['show_author'] ? get_the_author_meta('display_name', $post->post_author) : '';
    $post_categories = $args['show_categories'] ? get_the_category($post_id) : [];
    
    // バッジの取得
    $badge_text = '';
    $badge_class = '';
    if ($args['show_badge'] && $args['badge_field']) {
        $badge_value = get_post_meta($post_id, $args['badge_field'], true);
        $badge_text = tenfive_get_badge_text($badge_value);
        $badge_class = tenfive_get_badge_class($badge_value);
    }
    
    // 抜粋の長さ調整
    if ($post_excerpt && $args['excerpt_length']) {
        $post_excerpt = wp_trim_words($post_excerpt, $args['excerpt_length'], '...');
    }
    
    ob_start();
    ?>
    <article class="<?php echo esc_attr($args['item_class']); ?> wp-post">
        <div class="news__meta-row">
            <?php if ($args['show_date']): ?>
                <div class="news__date">
                    <time datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo esc_html($post_date); ?></time>
                </div>
            <?php endif; ?>
            
            <?php if ($badge_text): ?>
                <div class="news__badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></div>
            <?php endif; ?>
        </div>
        
        <div class="news__content">
            <?php if ($args['show_author'] || $args['show_categories']): ?>
                <div class="news__meta">
                    <?php if ($post_author): ?>
                        <span class="news__author"><?php echo esc_html($post_author); ?></span>
                    <?php endif; ?>
                    
                    <?php if ($post_categories): ?>
                        <div class="news__categories">
                            <?php foreach ($post_categories as $category): ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="news__category-link">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <h3 class="news__title">
                <a href="<?php echo esc_url($post_url); ?>" class="news__link">
                    <?php echo esc_html($post_title); ?>
                </a>
            </h3>
            
            <?php if ($post_excerpt): ?>
                <p class="news__excerpt"><?php echo esc_html($post_excerpt); ?></p>
            <?php endif; ?>
        </div>
    </article>
    <hr class="news__divider">
    <?php
    return ob_get_clean();
}

/**
 * バッジテキストを取得
 * 
 * @param string $value バッジの値
 * @return string バッジテキスト
 */
function tenfive_get_badge_text($value) {
    $badge_map = [
        'important' => '重要',
        'notice' => 'お知らせ',
        'update' => '更新',
        'event' => 'イベント',
        'recruitment' => '採用',
        'corporate' => 'コーポレート',
        'maintenance' => 'メンテナンス',
        'system' => 'システム',
        'service' => 'サービス'
    ];
    
    return isset($badge_map[$value]) ? $badge_map[$value] : $value;
}

/**
 * バッジクラスを取得
 * 
 * @param string $value バッジの値
 * @return string バッジクラス
 */
function tenfive_get_badge_class($value) {
    $class_map = [
        'important' => 'news__badge--important',
        'notice' => 'news__badge--notice',
        'update' => 'news__badge--update',
        'event' => 'news__badge--event',
        'recruitment' => 'news__badge--recruitment',
        'corporate' => 'news__badge--corporate',
        'maintenance' => 'news__badge--important',
        'system' => 'news__badge--update',
        'service' => 'news__badge--notice'
    ];
    
    return isset($class_map[$value]) ? $class_map[$value] : 'news__badge--notice';
}

/**
 * ニュース用のショートコード
 * 
 * @param array $atts ショートコード属性
 * @return string HTML
 */
function tenfive_news_shortcode($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => 5,
        'category' => 'news',
        'show_excerpt' => 'true',
        'show_author' => 'false',
        'show_categories' => 'false',
        'badge_field' => 'news_type'
    ], $atts);
    
    // 文字列のboolean変換
    $atts['show_excerpt'] = filter_var($atts['show_excerpt'], FILTER_VALIDATE_BOOLEAN);
    $atts['show_author'] = filter_var($atts['show_author'], FILTER_VALIDATE_BOOLEAN);
    $atts['show_categories'] = filter_var($atts['show_categories'], FILTER_VALIDATE_BOOLEAN);
    
    return tenfive_display_news_list($atts);
}
add_shortcode('tenfive_news', 'tenfive_news_shortcode');

/**
 * ニュース用のカスタムフィールドを追加
 */
function tenfive_add_news_meta_boxes() {
    add_meta_box(
        'tenfive_news_type',
        'ニュースタイプ',
        'tenfive_news_type_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'tenfive_add_news_meta_boxes');

/**
 * ニュースタイプのメタボックスコールバック
 */
function tenfive_news_type_callback($post) {
    wp_nonce_field('tenfive_news_type_nonce', 'tenfive_news_type_nonce');
    $value = get_post_meta($post->ID, 'news_type', true);
    
    $options = [
        '' => '選択してください',
        'important' => '重要',
        'notice' => 'お知らせ',
        'update' => '更新',
        'event' => 'イベント',
        'recruitment' => '採用',
        'corporate' => 'コーポレート',
        'maintenance' => 'メンテナンス',
        'system' => 'システム',
        'service' => 'サービス'
    ];
    
    echo '<select name="news_type" id="news_type">';
    foreach ($options as $key => $label) {
        printf('<option value="%s"%s>%s</option>', 
            esc_attr($key), 
            selected($value, $key, false), 
            esc_html($label)
        );
    }
    echo '</select>';
}

/**
 * ニュースタイプの保存
 */
function tenfive_save_news_type($post_id) {
    if (!isset($_POST['tenfive_news_type_nonce']) || 
        !wp_verify_nonce($_POST['tenfive_news_type_nonce'], 'tenfive_news_type_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['news_type'])) {
        update_post_meta($post_id, 'news_type', sanitize_text_field($_POST['news_type']));
    }
}
add_action('save_post', 'tenfive_save_news_type');

/**
 * ニュース用のCSSとJSを読み込み
 */
function tenfive_enqueue_news_assets() {
    wp_enqueue_style('tenfive-news-system', get_template_directory_uri() . '/css/shared-news-system.css', [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'tenfive_enqueue_news_assets');

/**
 * ニュース用のREST APIエンドポイント
 */
function tenfive_register_news_api() {
    register_rest_route('tenfive/v1', '/news', [
        'methods' => 'GET',
        'callback' => 'tenfive_get_news_api',
        'permission_callback' => '__return_true'
    ]);
}
add_action('rest_api_init', 'tenfive_register_news_api');

/**
 * ニュースAPIのレスポンス
 */
function tenfive_get_news_api($request) {
    $posts_per_page = $request->get_param('posts_per_page') ?: 5;
    $category = $request->get_param('category') ?: 'news';
    
    $posts = get_posts([
        'numberposts' => $posts_per_page,
        'category_name' => $category,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
    
    $news_data = [];
    foreach ($posts as $post) {
        $news_data[] = [
            'id' => $post->ID,
            'title' => $post->post_title,
            'excerpt' => get_the_excerpt($post->ID),
            'url' => get_permalink($post->ID),
            'date' => get_the_date('Y.m.d', $post->ID),
            'badge' => get_post_meta($post->ID, 'news_type', true)
        ];
    }
    
    return rest_ensure_response($news_data);
}
