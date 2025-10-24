<?php get_header(); ?>

<article class="notfound-article">
	<section class="page-header">
		<div class="inner">
			<h1 class="page-heading">Not found</h1>
		</div>
	</section>
	<section>
		<div class="inner">
			<h2 class="section-heading">404 Not found</h2>
			<p class="align-center">お探しのページは見つかりません。</p>
			<a href="<?php echo home_url('/'); ?>" class="button"><?php echo get_post(get_page_by_path('home'))->post_title; ?></a>
		</div>
	</section>
</article>

<?php get_footer(); ?>
