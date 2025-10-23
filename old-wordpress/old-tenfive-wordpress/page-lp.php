<?php
/*
 * Template Name: LPテンプレート
 */

get_header(); // ヘッダーの読み込み

// lp.cssを読み込む。正しいパスに書き換える必要があります。
wp_enqueue_style('lp-style', get_stylesheet_directory_uri() . '/css/lp.css');
?>

<!-- ここから固定ページのコンテンツが表示されます -->
<main id="main-content">
  <?php
    while ( have_posts() ) : the_post();
      the_content(); // 固定ページのコンテンツを表示
    endwhile;
  ?>
</main>

<?php get_footer(); // フッターの読み込み ?>
