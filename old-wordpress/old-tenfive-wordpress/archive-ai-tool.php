<?php
$post_type = get_current_post_type();

if ($post_type == 'post') {
	$slug          = POST;
	$taxonomy      = 'category';
	$template_slug = 'template-parts/content-' . $slug. '.php';
} else {
	$slug          = $post_type;
	$taxonomy      = $post_type . '_category';
	$template_slug = 'template-parts/content.php';
}

$archive_link = home_url($slug . '/');

if (preg_match('/^blog/', $slug)) {
	$slug = 'blog';
}

$label      = get_post_type_object($post_type)->labels;
$post_name  = $label->name;
$categories = get_the_terms(get_the_ID(), $taxonomy);

// カテゴリーごとの説明文を定義
$category_descriptions = array(
    'gpts' => '弊社が独自で開発したGPTsをご紹介します。業務効率化やマーケティングリサーチに特化したカスタムGPTsを提供しています。各GPTsの特徴や使用方法、活用事例なども併せてご紹介しています。',
    
    'ai-tools' => '業務効率化やシステム開発に役立つAIツールをご紹介します。要件定義書作成支援や、プログラミング補助ツール、バックオフィス業務の自動化ツールなど、実務で即活用できるAIツールを提供しています。',
    
    'ai-educontent' => 'AI技術の基礎から実践的な活用方法まで、体系的に学べる教育コンテンツを提供しています。初心者の方でも理解しやすいように、ステップバイステップで解説しています。各コンテンツはダウンロード可能なPDF形式でご用意しています。'
);

// ヘッダー部分の前に変数を定義
$current_category = get_queried_object();
$is_category_archive = is_tax('ai-tool_category');
?>
<style>
/* アーカイブページのベーススタイル */
.archive-main {
    min-height: 50vh;
}

/* カードのスタイル */
.post-card {
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.post-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.post-thumbnail {
    position: relative;
    padding-top: 56.25%; /* 16:9 アスペクト比 */
    overflow: hidden;
}

.post-thumbnail img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-card:hover .post-thumbnail img {
    transform: scale(1.05);
}

.post-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* カテゴリータグのスタイル */
.post-categories a {
    transition: all 0.2s ease;
}

.post-categories a:hover {
    background-color: #dbeafe;
    transform: translateY(-1px);
}

/* ページネーションのスタイル */
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0 0.75rem;
    border-radius: 0.375rem;
    background-color: white;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    text-decoration: none;
}

.page-numbers:hover {
    background-color: #f3f4f6;
}

.page-numbers.current {
    background-color: #2563eb;
    color: white;
}

/* レスポンシブ調整 */
@media (max-width: 768px) {
    .post-card {
        margin-bottom: 1.5rem;
    }
    
    .post-title {
        font-size: 1.25rem;
    }
}

/* アニメーション */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.post-card {
    animation: fadeIn 0.5s ease-out forwards;
}

/* カテゴリーバッジのスタイル */
.card-category {
    display: inline-block;
    padding: 0.4rem 1rem;
    background-color: #2563eb; /* 青系の背景色 */
    color: white;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

/* タグのスタイル（既存を修正） */
.card-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: auto;
    padding-top: 1rem;
}

.tag {
    display: inline-block;
    padding: 0.3rem 0.75rem;
    background-color: #f3f4f6; /* グレー系の背景色 */
    color: #4b5563;
    border-radius: 4px;
    font-size: 0.875rem;
}

/* カードコンテンツ全体の調整 */
.card-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* カードの他の要素との間隔調整 */
.card-title {
    margin-top: 0.5rem;
    margin-bottom: 1rem;
}

.card-excerpt {
    margin-bottom: 1.5rem;
}
</style>
<?php get_header(); ?>
<div class="ai-tools-archive">
    <!-- ヘッダー部分 -->
    <div class="archive-header">
        <h1 class="section-heading">
            <span class="section-heading-english">AI TOOLS</span>
            <span class="section-heading-japanese">
                <?php
                if ($is_category_archive && $current_category) {
                    echo esc_html($current_category->name . '一覧');
                } else {
                    echo 'AIツール・GPTs一覧';
                }
                ?>
            </span>
        </h1>
        <div class="archive-description">
            <?php
            if ($is_category_archive && $current_category) {
                // カテゴリーアーカイブページの場合は、そのカテゴリーの説明文を表示
                $category_description = term_description($current_category->term_id, 'ai-tool_category');
                if (!empty($category_description)) {
                    echo wp_kses_post($category_description);
                } elseif (isset($category_descriptions[$current_category->slug])) {
                    // カテゴリーの説明文が空の場合は、デフォルトの説明文を表示
                    echo '<p>' . esc_html($category_descriptions[$current_category->slug]) . '</p>';
                } else {
                    // どちらも設定されていない場合は全体の説明文を表示
                    ?>
                    <p>弊社が独自で活用、開発したAI,GPTsのご紹介ページです。マーケティングリサーチに便利なツールや日々のバックオフィス業務効率化、システム開発における要件定義書作成、プログラミングの補助ツールまで継続的に更新していきます。</p>
                    <?php
                }
            } else {
                // トップページの場合はデフォルトの説明文を表示
                ?>
                <p>弊社が独自で活用、開発したAI,GPTsのご紹介ページです。マーケティングリサーチに便利なツールや日々のバックオフィス業務効率化、システム開発における要件定義書作成、プログラミングの補助ツールまで継続的に更新していきます。</p>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- カテゴリーごとのセクション -->
    <div class="category-sections">
        <?php
        // カテゴリーアーカイブページの場合は、そのカテゴリーのみを表示
        if ($is_category_archive) {
            $category_order = array(
                $current_category->slug => $current_category->name
            );
        } else {
            // トップページの場合は全カテゴリーを表示
            $category_order = array(
                'gpts' => 'GPTs',
                'ai-tools' => 'AI Tools',
                'ai-educontent' => 'AI教育コンテンツ'
            );
        }

        foreach ($category_order as $slug => $name) :
            $category = get_term_by('slug', $slug, 'ai-tool_category');
            if ($category) :
                $args = array(
                    'post_type' => 'ai-tool',
                    'posts_per_page' => $is_category_archive ? -1 : 3, // カテゴリーページでは全記事表示
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'ai-tool_category',
                            'field' => 'slug',
                            'terms' => $slug
                        )
                    )
                );
                
                $query = new WP_Query($args);
                
                if ($query->have_posts()) :
        ?>
                    <section class="category-section" id="<?php echo esc_attr($slug); ?>">
                        <h2 class="category-heading"><?php echo esc_html($name); ?></h2>
                        <div class="cards-grid">
                            <?php
                            while ($query->have_posts()) : $query->the_post();
                                $tags = get_the_terms(get_the_ID(), 'ai-tool_tag');
                                $tag_slugs = array();
                                if ($tags) {
                                    foreach ($tags as $tag) {
                                        $tag_slugs[] = $tag->slug;
                                    }
                                }
                            ?>
                                <a href="<?php the_permalink(); ?>"><article class="card" data-tags="<?php echo esc_attr(implode(' ', $tag_slugs)); ?>">
                                    <div class="card-inner">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-image">
                                                <?php the_post_thumbnail('large', array('class' => 'card-img')); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="card-content">
                                            <!-- <div class="card-category">
                                                <?php echo esc_html($name); ?>
                                            </div> -->
                                            
                                            <h2 class="card-title">
                                                
                                                    <?php the_title(); ?>
                                                
                                            </h2>
                                            
                                            <div class="card-excerpt">
                                                <?php echo wp_trim_words(get_the_excerpt(), 60); ?>
                                            </div>

                                            <?php if ($tags && !is_wp_error($tags)) : ?>
                                                <div class="card-tags">
                                                    <?php foreach ($tags as $tag) : ?>
                                                        <span class="tag"><?php echo esc_html($tag->name); ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="card-meta">
                                                <span class="meta-separator">投稿者</span>
                                                <span class="meta-author"><?php echo get_the_author(); ?></span>
                                                <span class="meta-separator">日付</span>
                                                <span class="meta-date"><?php echo get_the_date('Y.m.d'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </article></a>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php if (!$is_category_archive) : ?>
                            <div class="category-more">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="more-link">
                                    <?php echo esc_html($name); ?>をもっと見る
                                </a>
                            </div>
                        <?php endif; ?>
                    </section>
        <?php
                endif;
                wp_reset_postdata();
            endif;
        endforeach;
        ?>
    </div>

    <!-- ページネーション -->
    <?php if ($query->max_num_pages > 1) : ?>
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '?paged=%#%',
                'current' => max(1, $paged),
                'total' => $query->max_num_pages,
                'prev_text' => '前へ',
                'next_text' => '次へ',
                'type' => 'list',
                'mid_size' => 2,
            ));
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>
</div>

<style>
/* ベーススタイル */
.ai-tools-archive {
    max-width: 1200px;
    margin: 80px auto 0;
    padding: 2rem 1rem;
}

/* カードグリッドのレスポンシブ設定 */
.cards-grid {
    display: grid;
    gap: 2rem;
    margin-bottom: 3rem;
    /* スマートフォン用デフォルト: 1列 */
    grid-template-columns: 1fr;
}

/* タブレット用: 2列 */
@media (min-width: 768px) {
    .cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* PC用: 3列 */
@media (min-width: 1024px) {
    .cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* カードスタイル */
.card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    height: 100%;
    animation: fadeIn 0.5s ease-out forwards;
}

.card-inner {
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
}

.card:hover .card-inner {
    transform: translateY(-4px);
}

.card-image {
    position: relative;
    padding-top: 56.25%; /* 16:9 アスペクト比 */
    overflow: hidden;
}

.card-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.card:hover .card-img {
    transform: scale(1.05);
}

.card-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* タグスタイル */
.tag-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin: 3rem 0;
    justify-content: center;
}

.tag-btn {
    padding: 0.5rem 1.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 2rem;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.tag-btn.active {
    background: #2563eb;
    color: white;
}

.card-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: auto;
    padding-top: 1rem;
}

.tag {
    padding: 0.25rem 0.75rem;
    background: #f3f4f6;
    border-radius: 1rem;
    font-size: 1rem;
    color: #4b5563;
}

/* ページネーション */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

.pagination .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    margin: 0 0.25rem;
    padding: 0 0.75rem;
    border-radius: 0.375rem;
    background: white;
    color: #374151;
    text-decoration: none;
    transition: all 0.2s ease;
}

.pagination .current {
    background: #2563eb;
    color: white;
}

.pagination a:hover {
    background: #f3f4f6;
}

/* アニメーション */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* No posts message */
.no-posts {
    text-align: center;
    grid-column: 1 / -1;
    padding: 2rem;
    color: #666;
}

/* カテゴリーセクションのスタイル */
.category-section {
    margin-bottom: 4rem;
    padding: 2rem 0;
}

.category-heading {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid #2563eb;
    color: #1e40af;
}

.category-more {
    text-align: center;
    margin-top: 2rem;
}

.more-link {
    display: inline-block;
    padding: 0.75rem 2rem;
    background-color: #2563eb;
    color: white;
    border-radius: 2rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.more-link:hover {
    background-color: #1e40af;
    transform: translateY(-2px);
}

/* カードグリッドの調整 */
.cards-grid {
    display: grid;
    gap: 2rem;
    margin-bottom: 2rem;
}

@media (min-width: 768px) {
    .cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 767px) {
    .cards-grid {
        grid-template-columns: repeat(1, 1fr);
    }
    
    .category-heading {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tagButtons = document.querySelectorAll('.tag-btn');
    const cards = document.querySelectorAll('.card');

    tagButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            tagButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const selectedTag = this.dataset.tag;

            // Filter cards
            cards.forEach(card => {
                if (selectedTag === 'all') {
                    card.style.display = '';
                } else {
                    const cardTags = card.dataset.tags.split(' ');
                    card.style.display = cardTags.includes(selectedTag) ? '' : 'none';
                }
            });
        });
    });
});
</script>


<?php get_footer(); ?>
