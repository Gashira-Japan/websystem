<?php
/**
 * The template for displaying search results pages
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<main class="main-content">
    <section class="search-results">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query */
                    printf( esc_html__( '検索結果: %s', 'tenfive-recruit' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header>

            <?php if ( have_posts() ) : ?>

                <div class="search-results__list">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result__item' ); ?>>
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                    <span class="post-type"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
                                </div>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php tenfive_recruit_pagination(); ?>

            <?php else : ?>

                <div class="no-results">
                    <p><?php esc_html_e( '検索結果が見つかりませんでした。別のキーワードで再度お試しください。', 'tenfive-recruit' ); ?></p>
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
