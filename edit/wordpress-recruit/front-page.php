<?php
/**
 * Template for displaying the front page
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero" data-section="hero">
    <!-- Background Image Slider -->
    <div class="hero__bg-slider">
        <div class="hero__bg-slide hero__bg-slide--active">
            <picture class="hero__bg-picture">
                <source media="(max-width: 1024px)" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-01-sp.jpg">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-01.jpg" alt="Tech × Wealth Well-being - より良い社会と未来の豊かさをデザインする" class="hero__bg-image">
            </picture>
        </div>
        <div class="hero__bg-slide">
            <picture class="hero__bg-picture">
                <source media="(max-width: 1024px)" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-02-sp.jpg">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-02.jpg" alt="人と技術、アイデアと実現をつなげる - 多様性を力に変える" class="hero__bg-image">
            </picture>
        </div>
        <div class="hero__bg-slide">
            <picture class="hero__bg-picture">
                <source media="(max-width: 1024px)" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-03-sp.jpg">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/recruit-mainbg-03.jpg" alt="テンファイブで共に成長 - 確かな技術力と提案力" class="hero__bg-image">
            </picture>
        </div>
    </div>
    
    <div class="container">
        <div class="hero__content">
            <span class="hero__tag">人材採用ページ</span>
            <h1 class="hero__title">
                <span class="hero__title--accent">Tech × Wealth</span><br>
                <span class="hero__title--accent">— </span><span class="hero__title--accent">Creating a Better Life for All</span>
            </h1>
            <p class="hero__subtitle">
                テクノロジーで創る、豊かさが循環する社会
            </p>
            <p class="hero__description">
                テクノロジーを通じて、人と社会、そして未来をつなぐ。豊かさが循環し、誰もが幸福を感じられる社会の実現を目指します。
            </p>
            <div class="hero__scroll">
                <span class="hero__scroll-text">SCROLL</span>
                <div class="hero__scroll-arrow"></div>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news" data-section="news" id="news">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">お知らせ</h2>
            <p class="section__subtitle">News</p>
        </div>
        <div class="news__list">
            <?php
            $news_query = new WP_Query( array(
                'post_type'      => 'news',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            if ( $news_query->have_posts() ) :
                $counter = 0;
                while ( $news_query->have_posts() ) : $news_query->the_post();
                    if ( $counter > 0 ) : ?>
                        <hr class="news__divider">
                    <?php endif; ?>
                    
                    <article class="news__item">
                        <div class="news__meta-row">
                            <div class="news__date">
                                <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                            </div>
                            <?php
                            $terms = get_the_terms( get_the_ID(), 'news_category' );
                            if ( $terms && ! is_wp_error( $terms ) ) :
                                $term = $terms[0];
                                $badge_class = 'news__badge--event'; // デフォルト
                                if ( $term->slug === 'recruitment' ) {
                                    $badge_class = 'news__badge--recruitment';
                                }
                                ?>
                                <div class="news__badge <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $term->name ); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="news__content">
                            <h3 class="news__title">
                                <a href="<?php the_permalink(); ?>" class="news__link">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                    </article>
                    
                    <?php
                    $counter++;
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p>現在お知らせはありません。</p>
            <?php endif; ?>
        </div>
        <div class="news__footer">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="link-text">すべてのお知らせを見る</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" data-section="features" id="features">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">テンファイブの特徴</h2>
            <p class="section__subtitle">Features</p>
        </div>
        <div class="cards-grid cards-grid--3">
            <a href="<?php echo esc_url( home_url( '/in-numbers/' ) ); ?>" class="image-card" aria-label="数字で見るテンファイブの詳細ページへ">
                <div class="image-card__media">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/numbers.png" alt="数字で見るテンファイブ" class="image-card__image">
                </div>
                <div class="image-card__content">
                    <div class="image-card__header">
                        <h3 class="image-card__title">数字で見るテンファイブ</h3>
                    </div>
                    <p class="image-card__description">テンファイブで実際に働くメンバーの声を基に弊社を数字で表現してみました。</p>
                </div>
            </a>
            
            <a href="<?php echo esc_url( home_url( '/industry-structure/' ) ); ?>" class="image-card" aria-label="業界構造から見た強みの詳細ページへ">
                <div class="image-card__media">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home/industry.png" alt="業界構造から見た強み" class="image-card__image">
                </div>
                <div class="image-card__content">
                    <div class="image-card__header">
                        <h3 class="image-card__title">業界構造から見た強み</h3>
                    </div>
                    <p class="image-card__description">業界内でのポジションと独自の強みを分析。競合他社との差別化ポイントと、当社が持つ競争優位性をご説明します。</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Workstyle Section (以下、残りのセクションは同様のパターンで作成） -->
<!-- 実際の静的HTML版の全セクションをそのまま移行 -->

<?php get_footer(); ?>
