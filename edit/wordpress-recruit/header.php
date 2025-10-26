<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Component -->
<header class="header" data-component="header">
    <div class="container">
        <!-- 左側グループ（ロゴ + ナビゲーション） -->
        <div class="header__left">
            <div class="header__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/common/recruit-logo.svg" alt="<?php bloginfo( 'name' ); ?>" class="header__logo">
                    <?php endif; ?>
                </a>
            </div>

            <nav class="header__nav" id="main-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav__list',
                    'walker'         => new TenFive_Recruit_Walker_Nav_Menu(),
                    'fallback_cb'    => function() {
                        // デフォルトメニュー（メニューが設定されていない場合）
                        echo '<ul class="nav__list">';
                        echo '<li class="nav__item"><a href="' . home_url('/') . '" class="nav__link">ホーム</a></li>';
                        echo '<li class="nav__item" data-dropdown="features">';
                        echo '<button class="nav__link nav__link--dropdown" aria-expanded="false">特徴</button>';
                        echo '<div class="nav__dropdown">';
                        echo '<a href="' . home_url('/in-numbers/') . '" class="dropdown__link">数字で見るテンファイブ</a>';
                        echo '<a href="' . home_url('/industry-structure/') . '" class="dropdown__link">業界構造から見た当社の強み</a>';
                        echo '</div>';
                        echo '</li>';
                        echo '<li class="nav__item" data-dropdown="workstyle">';
                        echo '<button class="nav__link nav__link--dropdown" aria-expanded="false">働き方・キャリアパス</button>';
                        echo '<div class="nav__dropdown">';
                        echo '<a href="' . home_url('/career-path/') . '" class="dropdown__link">キャリアパス</a>';
                        echo '<a href="' . home_url('/schedule/') . '" class="dropdown__link">1週間のスケジュール</a>';
                        echo '<a href="' . home_url('/events/') . '" class="dropdown__link">社内イベント</a>';
                        echo '</div>';
                        echo '</li>';
                        echo '<li class="nav__item" data-dropdown="selection">';
                        echo '<button class="nav__link nav__link--dropdown" aria-expanded="false">選考について</button>';
                        echo '<div class="nav__dropdown">';
                        echo '<a href="' . home_url('/ideal-candidate/') . '" class="dropdown__link">求める人物像</a>';
                        echo '<a href="' . home_url('/new-grad/') . '" class="dropdown__link">新卒採用</a>';
                        echo '<a href="' . home_url('/mid-career/') . '" class="dropdown__link">キャリア採用</a>';
                        echo '<a href="' . home_url('/faq/') . '" class="dropdown__link">よくある質問</a>';
                        echo '</div>';
                        echo '</li>';
                        echo '<li class="nav__item" data-dropdown="company">';
                        echo '<button class="nav__link nav__link--dropdown" aria-expanded="false">会社紹介</button>';
                        echo '<div class="nav__dropdown">';
                        echo '<a href="' . home_url('/company/') . '" class="dropdown__link">会社概要</a>';
                        echo '<a href="' . home_url('/members/') . '" class="dropdown__link">メンバー</a>';
                        echo '<a href="' . home_url('/history/') . '" class="dropdown__link">ヒストリー</a>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ul>';
                    }
                ) );
                ?>

                <!-- コーポレートサイトへのリンク（モバイルナビゲーション内） -->
                <div class="nav__cta">
                    <a href="https://10-5.jp/" class="link-text" target="_blank" rel="noopener">コーポレートサイト</a>
                </div>
            </nav>
        </div>

        <!-- 右側グループ（コーポレートボタン + ハンバーガーメニュー） -->
        <div class="header__right">
            <div class="header__cta">
                <a href="https://10-5.jp/" class="btn btn--primary btn--small" target="_blank" rel="noopener">コーポレートサイト</a>
            </div>

            <!-- ハンバーガーメニューボタン -->
            <button class="header__hamburger" id="hamburger-menu" aria-label="メニューを開く" aria-expanded="false">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </button>
        </div>
    </div>
</header>
