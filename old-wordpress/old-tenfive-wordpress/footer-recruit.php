</main>
<?php if (get_parent_slug() === 'entry'): ?>
<?php endif; ?>
<footer>
	<?php if (get_parent_slug() != 'contact'): ?>
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
						<br>〒150-0001　東京都渋谷区神宮前2-13-9　BIRTH神宮前2F(202)
					</p>
				</address>
				<div class="footer-menu">
					<ul class="footer-menu-ul">
						<li class="footer-menu-li"><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/service/'); ?>">事業内容</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/member/'); ?>">メンバー</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/company/'); ?>">会社情報</a></li>
					</ul>
					<ul class="footer-menu-ul">
						<li class="footer-menu-li"><a href="<?php echo home_url('/recruit/'); ?>">採用情報</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/in-numbers/'); ?>">数字で見るテンファイブ</a></li>
						<li class="footer-menu-li"><a href="<?php echo home_url('/history/'); ?>">ヒストリー</a></li>						
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
<script>
var swiper = new Swiper('.swiper-container', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>

</body>
</html>