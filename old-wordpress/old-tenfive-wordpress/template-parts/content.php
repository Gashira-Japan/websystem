<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
投稿
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
$categories = get_the_terms(get_the_ID(), $taxonomy);
$image = '';

if (has_post_thumbnail()) {
	$image = ' style="background-image: url(' . get_the_post_thumbnail_url(get_the_ID(), 'medium_large') . ');"';
}
?>
<li class="post-li <?php echo $slug; ?>-post-li animation fade-up">
	<a href="<?php the_permalink(); ?>">
		<div class="image-outer"><div class="image"<?php echo $image; ?>></div></div>
		<div class="post-info">
			<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>

		<?php if (is_array($categories)): ?>
			<div class="categories">
			<?php foreach ($categories as $category): ?>

				<?php if ($category->slug != 'uncategorized'): ?>
				<span class="category"><?php echo $category->name; ?></span>
				<?php endif; ?>

			<?php endforeach; ?>
			</div>
		<?php endif; ?>

		</div>
		<h3 class="heading"><?php the_title(); ?></h3>
		<div class="post-content">
			<?php the_excerpt(); ?>
		</div>
	</a>
</li>
