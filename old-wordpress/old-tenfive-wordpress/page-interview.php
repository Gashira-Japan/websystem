<?php
/*
Template Name: インタビューページ
*/
get_header(); ?>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('/css/recruit.css'); ?>" />
<article id="interview" class="service-article">
	<section class="page-header">

	</section>
	<section>
		<div class="inner">
				<?php global $post; // グローバル変数 $post を使用 ?>
				<h2 class="section-heading">

				<span class="section-heading-japanese" style="text-align:center;">
				<?php the_title(); // タイトルを表示 ?>
				</span>
				</h2>
            <div class="container">
                <?php
                // WordPress ループ
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                  // コンテンツを表示
                  the_content();
                endwhile; endif;
                // WordPress ループ終了
                ?>
              </div>

		</div>
	</section>
</article>

<?php get_footer('recruit'); 