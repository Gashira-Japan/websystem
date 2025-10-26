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

<?php get_header();?>

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
<div class="search-bg single-recruit">
<div class="contents">
    <div class="contents-inn">
                <div class="d-img-BOX">
                    <figure>
						<img src="<?php the_field('main_image01'); ?>" alt="募集要項1">
                    </figure>
                    <figure>
						<img src="<?php the_field('main_image02'); ?>" alt="募集要項2">
                    </figure>
                </div>
            <p class="sub-copy"><?php the_field('main_image_text'); ?></p>
            <div class="b-contents">
                <h2 class="tit-type-d font-bold"><span>募集要項</span></h2>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">職種</h3></dt>
                        <dd class="d-con-txt"><?php the_field('job_type'); ?></dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">雇用形態</h3></dt>
                        <dd class="d-con-txt"><?php the_field('employment_type'); ?></dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">仕事内容</h3></dt>
						<dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'work_detail', true)); ?></dd>
						
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">給与</h3></dt>
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'salary', true)); ?></dd>
                        <!-- <dd class="d-con-txt"><?php the_field('salary'); ?></dd> -->
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">勤務地</h3></dt>
                        <dd class="d-con-txt">
                        <?php the_field('address'); ?>
                        </a>
                    </dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">交通手段</h3></dt>
                        <dd class="d-con-txt"><?php the_field('traffic'); ?></dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">勤務曜日・時間</h3></dt>
                        <dd class="d-con-txt"><?php the_field('work_hours'); ?></dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">資格・経験</h3></dt>
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'eligibility', true)); ?></dd>
                        <!-- <dd class="d-con-txt"><?php the_field('eligibility'); ?></dd> -->
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">休日・休暇</h3></dt>
                        <dd class="d-con-txt"><?php the_field('holiday'); ?></dd>
                    </dl>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">待遇・諸手当</h3></dt>
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'treatment', true)); ?></dd>
                        <!-- <dd class="d-con-txt"><?php the_field('treatment'); ?></dd> -->
                    </dl>
                                        <?php
                    $remarks = get_post_meta($post->ID, 'remarks', true);
                    if (!empty($remarks)): ?>
                    <dl class="d-con-l">
                        <dt class="d-con-ttl"><h3 class="font-bold">備考</h3></dt>
                        <dd class="d-con-txt"><?php echo nl2br($remarks); ?></dd>
                    </dl>
                    <?php endif; ?>
            </div><!--//.b-contents-->
    </div><!-- contents-inn" -->




<div class="oubo-bg">
    <div class="oubo-wrap oubo-btn-box">
         <!-- <div class="oubo-btn"><a class="font-bold oubo_link icon arrow01 dec01" href="/entry??jobs=<?php the_title(); ?>" target="_blank" rel="nofollow">応募する</a></div> -->
         <div class="oubo-btn">
            <a class="font-bold oubo_link icon arrow01 dec01" href="#cf-recruit" onclick="gtag('event', 'recruitment-entry', {'event_category': 'link','event_label': 'recruitment','value': '1'});" rel="nofollow">応募する</a>
<!--             <a class="font-bold oubo_link icon arrow01 dec01" href="https://docs.google.com/forms/d/e/1FAIpQLSfBfWqe_O5-8MeNIKAvRd10HnX8HjyDcJQEQez0X0yE8le99g/formrestricted" target="_blank" rel="nofollow">応募する</a> -->
        </div>
    </div>
</div><!-- oubo-bg -->

<div class="contents-inn">
    <div class="b-contents work-info">
        <h2 class="tit-type-d font-bold"><span>お仕事情報</span></h2>
        <ul>
            <li>
                <figure>
                <img src="<?php the_field('job-detaile-image01'); ?>" alt="仕事内容詳細1">
                </figure>
                <div class="text-box">
                    <div class="text-wrap">
                        <label class="more-btn arrow05 PcHdn" for="read-more01"></label>
                        <div class="text-item">
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'job-detaile-text01', true)); ?></dd>
					</div>
                    </div>
                </div>
            </li>
            <li>
                <figure>
                <img src="<?php the_field('job-detaile-image02'); ?>" alt="仕事内容詳細2">
                </figure>
                <div class="text-box">
                    <div class="text-wrap">
                        <label class="more-btn arrow05 PcHdn" for="read-more02"></label>
                        <div class="text-item">
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'job-detaile-text02', true)); ?></dd>
						</div>
                    </div>
                </div>
            </li>
            <li>
                <figure>
                <img src="<?php the_field('job-detaile-image03'); ?>" alt="仕事内容詳細3">
                </figure>
                <div class="text-box">
                    <div class="text-wrap">
                        <label class="more-btn arrow05 PcHdn" for="read-more02"></label>
                        <div class="text-item">
                        <dd class="d-con-txt"><?php echo nl2br(get_post_meta($post->ID, 'job-detaile-text03', true)); ?></dd>
						</div>
                    </div>
                </div>
            </li>
        </ul>
    </div><!--//.b-contents-->
</div><!-- contents-inn" -->
    <div class="contents-inn">
            <div class="b-contents">
                <h2 class="tit-type-d font-bold"><span>応募方法</span></h2>
					<dl class="d-con-l">
						<dt class="d-con-ttl"><h3 class="font-bold">応募方法</h3></dt>
						<dd class="d-con-txt"><?php the_field('application'); ?></dd>
					</dl>
                    <dl class="d-con-l">
                    <dt class="d-con-ttl"><h3 class="font-bold">応募後のプロセス</h3></dt>
                    <dd class="d-con-txt"><?php the_field('process'); ?></dd>
				</dl>
				<dl class="d-con-l">
                    <dt class="d-con-ttl"><h3 class="font-bold">担当者</h3></dt>
                    <dd class="d-con-txt"><?php the_field('recruiter'); ?></dd>
                </dl>
        </div>  
    </div><!--contents-inn-->
		<!-- <div class="oubo-bg">
    <div class="oubo-wrap oubo-btn-box">
         <div class="oubo-btn"><a class="font-bold oubo_link icon arrow01 dec01" href="/entry??jobs=<?php the_title(); ?>" target="_blank" rel="nofollow">応募する</a></div>
    </div>
</div> -->
<!-- <div class="oubo-bg">
    <div class="oubo-wrap oubo-btn-box">
         <div class="oubo-btn"><a class="font-bold oubo_link icon arrow01 dec01" href="https://forms.gle/2L63JL8AFKUKyj2AA" target="_blank" rel="nofollow">応募する</a></div>
    </div>
</div> -->
			<!-- oubo-bg -->
    <div id="cf-recruit" class="contents-inn">
        <h2 class="tit-type-d font-bold"><span>求人に応募する</span></h2>
        <div class="cf-recruit">
        <dt class="required font-bold">応募職種<span>【必須】</span></dt>
	<dd><?php the_field('job_type'); ?></dd>
        <?php echo do_shortcode('[contact-form-7 id="dc1159d" title="求人応募"]'); ?>
        </div>
    </div>
</div><!-- search-bg -->
</div><!-- contents-BOX -->
<!-- 情報をコンタクトページへ渡す為のコード -->
<?php
$job_type = get_field('job_type');
 ?>
</div>

			<!-- <?php if (!is_attachment()): ?>
			<dl class="sns-dl">
				<dt class="sns-dt">SHARE</dt>
				<dd class="sns-dd"><a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label" data-hatena-bookmark-lang="ja"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" width="20" height="20" alt=""></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></dd>
				<dd class="sns-dd"><iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&width=90&layout=button&action=like&size=small&share=false&height=65&appId" width="80" height="20" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></dd>
				<dd class="sns-dd"><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></dd>
			</dl> -->

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
			<p>現在求人は募集しておりません。</p>
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
