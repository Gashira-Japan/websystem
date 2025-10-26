<?php
if (is_front_page() || is_home()) {
    $ogp_type = 'website';
} else {
    $ogp_type = 'article';
}
?>
<?php
// IDを出力
$basic_id = get_field('basic_id');
// パスワードを出力
$basic_password = get_field('basic_password');

if (!is_home() && !empty($basic_id) && !empty($basic_password)) {
  if (get_post_type() === 'blog-tenfive') {
    $userArray = array("$basic_id" => "$basic_password");
    basic_auth($userArray);
  }
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionElement = document.querySelector('.my-section');
    if (sectionElement) {
        // セクションが見つかった場合の処理
        console.log('セクションが見つかりました');
    } else {
        console.log('セクションが見つかりません');
    }
});
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/partner-lp.js"></script>
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
    <div class="block467">
        <div class="block467__content">
            <div class="block467__header">
                <div class="block467__headerLogo">
                    <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_theme_file_uri('/img/common/logo-tenfive.svg'); ?>" alt="">
                    </a>
                </div>
                <div class="block467__headerMenu">
                    <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'ten-menu' 
                    ) ); 
                    ?>
                </div>
            </div>
        </div>
    </div>    

    <div class="block466">
        <div class="block466__content">
            <div class="block466__body">
                <div class="block466__bodyImage">
                    <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_theme_file_uri('/img/common/logo-tenfive.svg'); ?>" alt="">
                    </a>
                </div>
                <div class="block466__bodyMenu">
                    <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'sp-ten-menu' 
                    ) ); 
                    ?>
                </div>
                <div class="block466__bodyButton">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="header-overlay" class="header-overlay"></div>

<script>
jQuery(function($){
    // ハンバーガーメニューの制御
    $('.block466__bodyButton').on('click', function(){
        $('.block466__bodyButton').toggleClass('block466__bodyButton--open');
        $('.block466__bodyMenu').toggleClass('block466__bodyMenu--open');
    });

    $('.block466__bodyMenu .menu > li').on('click', function(){
        $(this).toggleClass('open');
    });
    $('.block466__bodyMenu .sub-menu > li').on('click', function(){
        $(this).toggleClass('--open');
    });

    // メガメニューの制御
    var $megaMenu = $('.block467__headerMegaMenu.--recruitment');
    var $recruitLink = $('.block467__headerMenu a').filter(function() {
        return $(this).text().trim().includes('採用');
    });
    var $recruitItem = $recruitLink.parent();

    // メガメニューの表示/非表示を制御
    function showMegaMenu() {
        $megaMenu.addClass('--open');
        $recruitItem.addClass('active');
    }

    function hideMegaMenu() {
        $megaMenu.removeClass('--open');
        $recruitItem.removeClass('active');
    }

    // ホバーイベントの設定
    $recruitItem.hover(showMegaMenu, function() {
        setTimeout(function() {
            if (!$megaMenu.is(':hover')) {
                hideMegaMenu();
            }
        }, 100);
    });

    $megaMenu.hover(
        function() { showMegaMenu(); },
        function() { hideMegaMenu(); }
    );
});
</script>    

<main>
    <?php get_template_part('template-parts/breadcrumb'); ?>