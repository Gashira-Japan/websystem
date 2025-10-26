<?php
$post_type = get_current_post_type();

if ($post_type == 'post') {
	$slug          = POST;
	$taxonomy      = 'category';
	$param_name    = 'category_name';
	$template_slug = 'template-parts/content-' . $slug. '.php';
} else {
	$slug          = $post_type;
	$taxonomy      = $post_type . '_category';
	$param_name    = $post_type . '_category';
	$template_slug = 'template-parts/content.php';
}

if (preg_match('/^blog/', $slug)) {
	$slug = 'blog';
}

$label            = get_post_type_object($post_type)->labels;
$post_name        = $label->name;
$heading_english  = $slug;
$heading_japanese = $post_name;
$category         = get_queried_object();
$category_slug    = $category && isset($category->slug) ? $category->slug : '';
$category_name    = $category && isset($category->name) ? $category->name : '';

if ($category_slug && $category_slug != 'uncategorized') {
	$heading_english  = $category_slug;
	$heading_japanese = $category_name;
}

$posts_per_page = 12;
$sticky_posts   = get_option('sticky_posts');
?>

<?php get_header(); ?>

<article class="<?php echo $slug; ?>-article post <?php echo $slug; ?>-post">
	<section class="page-header">

	</section>
	<section class="<?php echo $slug; ?>-archive archive">
		<div class="inner">
			<h2 class="section-heading">
				<span class="section-heading-english"><?php echo $heading_english; ?></span>
				<span class="section-heading-japanese"><?php echo $heading_japanese; ?></span>
			</h2>
		<?php if (have_posts()): ?>

			<ul class="post-ul <?php echo $slug; ?>-post-ul">
				<?php
				if (!is_paged() && $sticky_posts):
					$query = new WP_Query(array('post_status' => 'publish', 'posts_per_page' => -1, 'paged' => $paged, 'post_type' => $post_type, $param_name => $category_slug, 'post__in' => $sticky_posts));

					while ($query->have_posts()):
						$query->the_post();
						require($template_slug);
					endwhile;
				endif;

				$query = new WP_Query(array('post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'paged' => $paged, 'post_type' => $post_type, $param_name => $category_slug, 'post__not_in' => $sticky_posts));

				while ($query->have_posts()):
					$query->the_post();
					require($template_slug);
				endwhile;
				?>

				<li class="post-li <?php echo $slug; ?>-post-li spacer"></li>
			</ul>
			<?php
			get_template_part('template-parts/pagination', null, $query->max_num_pages);
			wp_reset_postdata();
			?>


		<?php elseif( is_archive('recruit') ) : ?><!--拠点のパーマリンク設定-->
		<p>現在表示する情報はありません。</p>
		<?php else: ?>

			<p>ページが見つかりませんでした。</p>
		<?php endif; ?>

		</div>
	</section>
</article>

<?php get_footer(); ?>
