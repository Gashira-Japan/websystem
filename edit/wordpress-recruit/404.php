<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<main class="main-content">
    <section class="error-404 not-found">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'ページが見つかりません', 'tenfive-recruit' ); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e( 'お探しのページは見つかりませんでした。URLが間違っているか、ページが移動または削除された可能性があります。', 'tenfive-recruit' ); ?></p>

                <div class="error-404__search">
                    <?php get_search_form(); ?>
                </div>

                <div class="error-404__links">
                    <h2>よく閲覧されるページ</h2>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページ</a></li>
                        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>">お知らせ</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/new-grad/' ) ); ?>">新卒採用</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/mid-career/' ) ); ?>">キャリア採用</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
