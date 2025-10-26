</main>

<?php
// 親固定ページのスラッグを取得（ページ以外や親なしの場合は空）
$parent_slug = '';
if ( is_singular('page') ) {
    global $post;
    if ( $post instanceof WP_Post && $post->post_parent ) {
        $parent = get_post( $post->post_parent );
        if ( $parent ) {
            $parent_slug = $parent->post_name; // 親ページのスラッグ
        }
    }
}
?>
<footer>
  <?php if ( $parent_slug !== 'recruit' ) : ?>
	<div class="footer-recruit">
		<div class="inner">
			<p class="footer-heading">Recruit</p>
			<a href="<?php echo home_url('/recruit/'); ?>" class="footer-button animation fade">採用情報はこちら</a>
		</div>
	</div>
	<?php endif; ?>

    <?php if ( $parent_slug !== 'contact' ) : ?>
	<div class="footer-contact">
		<div class="inner">
			<p class="footer-heading">Contact</p>
			<a href="<?php echo home_url('/contact/'); ?>" class="footer-button animation fade">お問い合わせはこちら</a>
		</div>
	</div>
	<?php endif; ?>

	<div class="footer-main">
		<div class="inner">
			<div class="container">
				<address class="footer-address">
					<a href="<?php echo home_url('/'); ?>" class="footer-logo"><img loading="lazy" src="<?php echo get_theme_file_uri('/img/common/logo.png'); ?>" width="216" height="34" alt="TEN FIVE INC."></a>
					<p>
						テンファイブ株式会社
						<br>〒150-0001 東京都渋谷区神宮前2-13-9　BIRTH神宮前2F(202)
					</p>
				</address>
				<div class="footer-menu">
					<ul class="footer-menu-ul">
						<li class="footer-menu-li"><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/service/'); ?>">事業内容</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/member/'); ?>">メンバー</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/company/'); ?>">会社概要</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/recruit/'); ?>">採用情報</a></li>
					</ul>
					<ul class="footer-menu-ul">
						<li class="footer-menu-li"><a href="<?php echo home_url('/erp/'); ?>">基幹システム開発</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/ai-object-detection/'); ?>">物体検知システム開発</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/nlp/'); ?>">自然言語処理AI開発</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/contact/'); ?>">お問い合わせ</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/privacy/'); ?>">プライバシーポリシー</a></li>
					</ul>
				</div>
			</div>
			<small class="footer-copyright">2009-Latest © TenFive, Inc. All rights reserved. No reproduction or republication without written permission.</small>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<div id="chatbot-container" class="chatbot-container">
        <a href="<?php echo home_url('/contact/'); ?>" class="chatbot-toggle"><img src="https://10-5.jp/wp-content/uploads/2025/02/chatbot-tenfive-seo.png" alt="お問い合わせ"></a>
</div>

</body>
</html>