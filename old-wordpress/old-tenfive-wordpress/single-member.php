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
?>

<?php get_header(); ?>

<article class="<?php echo $slug; ?>-article post <?php echo $slug; ?>-post">
	<section class="page-header">

	</section>
	<section class="<?php echo $slug; ?>-single single">
		<div class="inner">
	<?php if (have_posts()): ?>
		<?php while (have_posts()): the_post(); ?>

			<div class="post-info">


			<?php if (is_array($categories)): ?>
				<div class="categories">
				<?php foreach ($categories as $category): ?>

					<?php if ($category->slug != 'uncategorized'): ?>
					<a href="<?php echo get_term_link($category); ?>" class="category"><?php echo $category->name; ?></a>
					<?php endif; ?>

				<?php endforeach; ?>
				</div>
			<?php endif; ?>

			</div>
			<h1 class="section-heading"><?php the_title(); ?></h1>
			<?php the_post_thumbnail('large', array('class' => 'animation fade-up')); ?>

			<div class="post-content">
				<?php the_content(); ?>
			</div>

			<?php if (!is_attachment()): ?>
			<dl class="sns-dl">
				<dt class="sns-dt">SHARE</dt>
				<dd class="sns-dd"><a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label" data-hatena-bookmark-lang="ja"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" width="20" height="20" alt=""></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></dd>
				<dd class="sns-dd"><iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&width=90&layout=button&action=like&size=small&share=false&height=65&appId" width="80" height="20" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></dd>
				<dd class="sns-dd"><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></dd>
			</dl>

			<?php if (in_array(get_parent_slug(), array('blog-soeno', 'blog-saito'))): ?>
			<div class="post-author">
				<h2 class="section-heading">この記事の著者</h2>
				<p class="name"><?php the_author_meta('nickname'); ?></p>
				<?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
				<p><?php the_author_meta('description'); ?></p>
			</div>
			<?php endif; ?>

<!--
			<ul class="post-nav-ul">
				<li class="post-nav-li post-nav-prev"><?php previous_post_link('%link', '前へ'); ?></li>
				<li class="post-nav-li post-nav-list"><a href="<?php echo $archive_link; ?>" class="button">一覧</a></li>
				<li class="post-nav-li post-nav-next"><?php next_post_link('%link', '次へ'); ?></li>
			</ul>
-->
			<?php endif; ?>

		<?php endwhile; ?>
	<?php else: ?>
			<p>ページが見つかりませんでした。</p>
	<?php endif; ?>

		</div>
	</section>

	<?php
	$posts_per_page = 3;
	$query = new WP_Query(array('post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'post_type' => $post_type, 'post__not_in' => array(get_the_ID())));

	if ($query->have_posts()):
	?>
	<section class="<?php echo $slug; ?>-other">
		<div class="inner">
			<h2 class="section-heading">
				<span class="section-heading-english"><?php echo $slug; ?></span>
				<span class="section-heading-japanese">メンバー</span>
			</h2>
			<ul class="post-ul <?php echo $slug; ?>-post-ul">
				<?php
				while ($query->have_posts()):
					$query->the_post();
					require($template_slug);
				endwhile;

				wp_reset_postdata();
				?>

				<li class="post-li <?php echo $slug; ?>-post-li spacer"></li>
			</ul>
			<a href="<?php echo $archive_link; ?>" class="button">すべて見る</a>
		</div>
	</section>
	<?php endif; ?>

</article>

<?php get_footer(); ?>
