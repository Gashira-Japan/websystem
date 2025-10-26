<?php
/**
 * The template for displaying single news posts
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- パンくずリスト -->
<nav class="breadcrumb" aria-label="パンくずリスト">
    <div class="container">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb__link">ホーム</a>
            </li>
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="breadcrumb__link">お知らせ</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">
                <?php the_title(); ?>
            </li>
        </ol>
    </div>
</nav>

<!-- ニュース詳細コンテンツ -->
<article class="news-detail">
    <div class="container">
        <!-- ニュース記事ヘッダー -->
        <header class="news-detail__header">
            <div class="news-detail__meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="news-detail__date">
                    <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                </time>
                <?php
                $terms = get_the_terms( get_the_ID(), 'news_category' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                    foreach ( $terms as $term ) :
                        $badge_class = 'news-detail__category--event'; // デフォルト
                        if ( $term->slug === 'recruitment' ) {
                            $badge_class = 'news-detail__category--recruitment';
                        }
                        ?>
                        <span class="news-detail__category <?php echo esc_attr( $badge_class ); ?>">
                            <?php echo esc_html( $term->name ); ?>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <h1 class="news-detail__title"><?php the_title(); ?></h1>
        </header>

        <!-- アイキャッチ画像 -->
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="news-detail__thumbnail">
            <?php the_post_thumbnail( 'news-large', array( 'class' => 'news-detail__image' ) ); ?>
        </div>
        <?php endif; ?>

        <!-- ニュース記事本文 -->
        <div class="news-detail__content">
            <?php the_content(); ?>
        </div>

        <!-- タグ -->
        <?php
        $tags = get_the_terms( get_the_ID(), 'news_tag' );
        if ( $tags && ! is_wp_error( $tags ) ) : ?>
        <div class="news-detail__tags">
            <h3 class="news-detail__tags-title">タグ:</h3>
            <ul class="news-detail__tags-list">
                <?php foreach ( $tags as $tag ) : ?>
                <li class="news-detail__tag-item">
                    <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" class="news-detail__tag-link">
                        #<?php echo esc_html( $tag->name ); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- ナビゲーション（前の記事・次の記事） -->
        <nav class="news-detail__nav">
            <div class="news-detail__nav-links">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>

                <?php if ( $prev_post ) : ?>
                <div class="news-detail__nav-item news-detail__nav-item--prev">
                    <span class="news-detail__nav-label">前の記事</span>
                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="news-detail__nav-link">
                        <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if ( $next_post ) : ?>
                <div class="news-detail__nav-item news-detail__nav-item--next">
                    <span class="news-detail__nav-label">次の記事</span>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="news-detail__nav-link">
                        <?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </nav>

        <!-- 一覧へ戻るボタン -->
        <div class="news-detail__back">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="btn btn--outline">
                お知らせ一覧へ戻る
            </a>
        </div>
    </div>
</article>

<?php endwhile; ?>

<?php
get_footer();
