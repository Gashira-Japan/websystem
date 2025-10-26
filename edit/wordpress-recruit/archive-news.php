<?php
/**
 * The template for displaying news archive
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<!-- パンくずリスト -->
<nav class="breadcrumb" aria-label="パンくずリスト">
    <div class="container">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb__link">ホーム</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">
                お知らせ
            </li>
        </ol>
    </div>
</nav>

<!-- サブページヒーロー -->
<section class="subpage-hero">
    <div class="container">
        <h1 class="subpage-hero__title">お知らせ</h1>
        <p class="subpage-hero__subtitle">News</p>
    </div>
</section>

<!-- ニュース一覧 -->
<section class="news-list">
    <div class="container">
        <!-- カテゴリーフィルター -->
        <div class="news-list__filter">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>"
               class="news-list__filter-item <?php echo ! is_tax() ? 'news-list__filter-item--active' : ''; ?>">
                すべて
            </a>
            <?php
            $categories = get_terms( array(
                'taxonomy'   => 'news_category',
                'hide_empty' => true,
            ) );
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                foreach ( $categories as $category ) :
                    $is_current = is_tax( 'news_category', $category->slug );
                    ?>
                    <a href="<?php echo esc_url( get_term_link( $category ) ); ?>"
                       class="news-list__filter-item <?php echo $is_current ? 'news-list__filter-item--active' : ''; ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ニュース記事一覧 -->
        <div class="news-list__items">
            <?php if ( have_posts() ) : ?>
                <?php
                $counter = 0;
                while ( have_posts() ) : the_post();
                    if ( $counter > 0 ) : ?>
                        <hr class="news-list__divider">
                    <?php endif; ?>

                    <article class="news-list__item">
                        <div class="news-list__meta-row">
                            <div class="news-list__date">
                                <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                                </time>
                            </div>
                            <?php
                            $terms = get_the_terms( get_the_ID(), 'news_category' );
                            if ( $terms && ! is_wp_error( $terms ) ) :
                                $term = $terms[0];
                                $badge_class = 'news-list__badge--event'; // デフォルト
                                if ( $term->slug === 'recruitment' ) {
                                    $badge_class = 'news-list__badge--recruitment';
                                }
                                ?>
                                <div class="news-list__badge <?php echo esc_attr( $badge_class ); ?>">
                                    <?php echo esc_html( $term->name ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="news-list__content">
                            <h3 class="news-list__title">
                                <a href="<?php the_permalink(); ?>" class="news-list__link">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php if ( has_excerpt() ) : ?>
                                <p class="news-list__excerpt"><?php the_excerpt(); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>

                    <?php
                    $counter++;
                endwhile;
                ?>

                <!-- ページネーション -->
                <div class="news-list__pagination">
                    <?php tenfive_recruit_pagination(); ?>
                </div>

            <?php else : ?>
                <p class="news-list__empty">現在お知らせはありません。</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
