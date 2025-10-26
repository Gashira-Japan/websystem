<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
投稿
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
$post_type = $args;

if ($post_type == 'post') {
	$slug          = POST;
	$taxonomy      = 'category';
	$template_slug = 'content-' . $slug . '.php';
} else {
	$slug          = $post_type;
	$taxonomy      = $post_type . '_category';
	$template_slug = 'content.php';
}

$archive_link = home_url($slug . '/');

if (preg_match('/^blog/', $slug)) {
	$slug = 'blog';
}

$class          = get_post(get_the_ID())->post_name . '-' . $slug;
$label          = get_post_type_object($post_type)->labels;
$post_name      = $label->name;
$query          = new WP_Query(array('post_status' => 'publish', 'post_type' => $post_type));
$posts_per_page = 3;
$sticky_posts   = get_option('sticky_posts');
$count          = 0;

if ($query->have_posts()):
?>
	<section class="<?php echo $class; ?> post <?php echo $slug; ?>-post">
		<div class="inner">
			<h2 class="section-heading">
				<span class="section-heading-english"><?php echo $slug; ?></span>
				<span class="section-heading-japanese"><?php echo $post_name; ?></span>
			</h2>
			<ul class="post-ul <?php echo $slug; ?>-post-ul">
				<?php
				if ($sticky_posts):
					$query = new WP_Query(array('post_status' => 'publish', 'posts_per_page' => -1, 'post_type' => $post_type, 'post__in' => $sticky_posts));

					while ($query->have_posts()):
						if ($count >= $posts_per_page) {
							break;
						}

						$query->the_post();
						require($template_slug);
						$count++;
					endwhile;
				endif;

				$query = new WP_Query(array('post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'post_type' => $post_type, 'post__not_in' => $sticky_posts));

				while ($query->have_posts()):
					if ($count >= $posts_per_page) {
						break;
					}

					$query->the_post();
					require($template_slug);
					$count++;
				endwhile;

				wp_reset_postdata();
				?>

				<li class="post-li <?php echo $slug; ?>-post-li spacer"></li>
			</ul>
			<a href="<?php echo $archive_link; ?>" class="button">すべて見る</a>
		</div>
	</section>
<?php endif; ?>
