<?php
/* if(!is_home() && is_page(array(563,558,569,572,567,562))) {
    $userArray = array(
        "admin" => "105"
    );
    basic_auth($userArray);
} */


if (is_front_page() || is_home()) {
	$ogp_type = 'website';
} else {
	$ogp_type = 'article';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# <?php echo $ogp_type; ?>: https://ogp.me/ns/<?php echo $ogp_type; ?>#">
<meta charset="utf-8">
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M2XB9L5');</script>
<!-- End Google Tag Manager -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no, address=no, email=no">
<link rel="icon" href="<?php echo get_theme_file_uri('/img/common/favicon.ico'); ?>">
<link rel="apple-touch-icon" href="<?php echo get_theme_file_uri('/img/common/apple-touch-icon.png'); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="<?php echo get_theme_file_uri('/css/recruit.css'); ?>" />

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M2XB9L5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="loader">
	<ul class="loader-ul">
		<li class="loader-li"></li>
		<li class="loader-li"></li>
		<li class="loader-li"></li>
	</ul>
</div>

<header>
	<div class="inner header-inner">
		<a href="<?php echo home_url('/recruit/'); ?>" class="header-logo"><img src="<?php echo get_theme_file_uri('/img/common/logo.png"'); ?>" width="216" height="34" alt="TEN FIVE INC.採用サイト"></a>
		<nav class="header-nav">
			<div class="header-nav-inner">
				<ul class="header-menu-ul">
<!-- 					<li class="header-menu-li"><a href="<?php echo home_url('/recruit/'); ?>" class="header-menu-link">採用TOP</a></li> -->
					<li class="header-menu-li"><a href="<?php echo home_url('/new-grad/'); ?>" class="header-menu-link">新卒採用</a></li>
					<li class="header-menu-li"><a href="<?php echo home_url('/mid-career/'); ?>" class="header-menu-link">中途採用</a></li>
					<li class="header-menu-li"><a href="<?php echo home_url('/message/'); ?>" class="header-menu-link">代表メッセージ</a></li>
					<li class="header-menu-li"><a href="<?php echo home_url('/in-numbers/'); ?>" class="header-menu-link">数字で見るテンファイブ</a></li>
					<li class="header-menu-li"><a href="<?php echo home_url('/history/'); ?>" class="header-menu-link">ヒストリー</a></li>
				</ul>
				<div class="header-contact">
					<!-- <a href="tel:0123-456-7890" class="header-tel">
						<span class="header-tel-number">
							<svg class="header-tel-icon" xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 14.714"><path d="M90.212,26.578c2.726,5.2,5.788,5.731,6.678,5.264l.232-.122-2.085-3.975-.233.12c-.718.377-1.435-.711-2.353-2.462s-1.406-2.959-.689-3.336l.232-.123L89.909,17.97l-.232.122C88.786,18.559,87.486,21.383,90.212,26.578Zm8.171,4.481c.344-.18.155-.576-.041-.949l-1.4-2.67c-.151-.287-.4-.449-.6-.343-.126.066-.421.206-.8.394l2.081,3.967Zm-5.114-9.818c.2-.105.209-.4.059-.69s-1.4-2.67-1.4-2.67c-.2-.373-.413-.753-.758-.572l-.761.4,2.081,3.967C92.86,21.47,93.142,21.307,93.269,21.241Z" transform="translate(-88.574 -17.262)"/></svg>
							<span>0123-456-7890</span>
						</span>
						<p class="header-tel-hour">平日00:00～00:00</p>
					</a> -->
					<a href="<?php echo home_url('/contact/'); ?>" class="header-mail">お問い合わせ</a>
				</div>
			</div>
		</nav>
		<div id="header-toggle" class="header-toggle">
			<span class="header-toggle-bar"></span>
			<span class="header-toggle-bar"></span>
			<span class="header-toggle-bar"></span>
		</div>
	</div>
</header>
<div id="header-overlay" class="header-overlay"></div>

<main>
	<?php get_template_part('template-parts/breadcrumb'); ?>
