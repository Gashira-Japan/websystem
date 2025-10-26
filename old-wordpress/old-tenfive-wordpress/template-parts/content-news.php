<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
お知らせ
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
?>
<li class="post-li <?php echo $slug; ?>-post-li animation fade-left">
	<a href="<?php the_permalink(); ?>">
		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
		<h3 class="heading"><?php the_title(); ?></h3>
	</a>
</li>
