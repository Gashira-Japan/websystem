<?php
function add_article_schema() {
    if (is_single()) {
        global $post;
        $author = get_the_author_meta('display_name', $post->post_author);
        $publish_date = get_the_date('c', $post->ID);
        $modified_date = get_the_modified_date('c', $post->ID);
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $url = get_permalink($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full');

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => $url
            ),
            'headline' => $title,
            'description' => $description,
            'image' => array(
                '@type' => 'ImageObject',
                'url' => $image,
                'height' => 800,
                'width' => 1200
            ),
            'author' => array(
                '@type' => 'Person',
                'name' => $author
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => 'TenFive, Inc.',
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => 'https://10-5.jp/wp-content/themes/tenfive/img/common/logo.png',
                    'width' => 600,
                    'height' => 60
                )
            ),
            'datePublished' => $publish_date,
            'dateModified' => $modified_date
        );

        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'add_article_schema');
?>

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

<style>
.single {
    display: flex;
    width: 1120px;
    margin: 0 auto;
}

.blog-single .inner {
    max-width: none;
    flex-basis: 80%;
}

ul.sidebar {
    flex-basis: 20%;
}

ul.sidebar li {
    margin-bottom: 30px;
}
@media(max-width:1150px){
	.single {
		width: auto;
		margin: 0 10px;
	}
}
	
@media(max-width:768px){
.single {
    display: block;
}

ul.sidebar {
    padding: 0 5.4%;
    margin-top: 76px;
}		
}
	
p.wp-block-tag-cloud a {
    padding: 5px 20px;
    color: #fff;
    background-color: #333;
    margin-bottom: 5px;
    border-radius: 20px;
}	
	
</style>

<article class="<?php echo $slug; ?>-article post <?php echo $slug; ?>-post">
	<section class="page-header">

	</section>
	<section class="<?php echo $slug; ?>-single single">
		<div class="inner">
	<?php if (have_posts()): ?>
		<?php while (have_posts()): the_post(); ?>

			<div class="post-info">
				<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>

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
			<div>
				<img src="https://10-5.jp/wp-content/uploads/2025/09/blog-recruit-banner-yoko.webp" alt="採用情報 長谷川 横バージョン">
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
		
		<?php if(is_active_sidebar('sidebar')){?>
		  <ul class="sidebar">
			<?php dynamic_sidebar('sidebar');?>
		  </ul>
		<?php } ?>
		
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
				<span class="section-heading-japanese">関連記事</span>
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
