<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
ページネーション
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
$pages  = $args;
$paged  = get_query_var('paged');
$anchor = null;
$range  = 1;

if (!$paged) {
	$paged = 1;
}

if ($pages > 1):
?>
<ul class="page-ul">

	<?php if ($paged > 1): ?>
	<li class="page-li page-prev"><a href="<?php echo get_pagenum_link($paged - 1) . $anchor; ?>"></a></li>
	<?php else: ?>
	<li class="page-li page-prev"></li>
	<?php endif; ?>

	<?php if ($paged > $range + 1): ?>
	<li class="page-li page-first"><a href="<?php echo get_pagenum_link(1); ?>">1</a></li>
	<?php endif; ?>

	<?php if ($paged > $range + 2): ?>
	<li class="page-li page-ellipsis">…</li>
	<?php
	endif;

	for ($i = 1; $i <= $pages; $i++):
		if ($i <= $paged + $range && $i >= $paged - $range):
			if ($paged === $i):
	?>
	<li class="page-li page-current"><?php echo $i; ?></li>
			<?php else: ?>
	<li class="page-li"><a href="<?php echo get_pagenum_link($i) . $anchor; ?>"><?php echo $i; ?></a></li>
	<?php
			endif;
		endif;
	endfor;

	if ($paged + $range + 1 < $pages):
	?>
	<li class="page-li page-ellipsis">…</li>
	<?php endif; ?>

	<?php if ($paged + $range < $pages): ?>
	<li class="page-li page-last"><a href="<?php echo get_pagenum_link($pages); ?>"><?php echo $pages; ?></a></li>
	<?php endif; ?>

	<?php if ($paged < $pages): ?>
	<li class="page-li page-next"><a href="<?php echo get_pagenum_link($paged + 1) . $anchor; ?>"></a></li>
	<?php else: ?>
	<li class="page-li page-next"></li>
	<?php endif; ?>

</ul>
<?php endif; ?>
