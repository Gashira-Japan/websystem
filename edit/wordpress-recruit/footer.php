<!-- Footer Component -->
<footer class="footer" data-component="footer">
    <div class="container">
        <div class="footer__content">
            <div class="footer__brand">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/common/tenfive-logo-txt-wh.svg" alt="<?php bloginfo( 'name' ); ?>" class="footer__logo">
            </div>
            <div class="footer__links">
                <div class="footer__section">
                    <h4 class="footer__title">採用情報</h4>
                    <ul class="footer__list">
                        <li><a href="<?php echo esc_url( home_url( '/new-grad/' ) ); ?>" class="footer__link">新卒採用</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/mid-career/' ) ); ?>" class="footer__link">キャリア採用</a></li>
                    </ul>
                </div>
                <div class="footer__section">
                    <h4 class="footer__title">会社情報</h4>
                    <ul class="footer__list">
                        <li><a href="<?php echo esc_url( home_url( '/company/' ) ); ?>" class="footer__link">会社概要</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/members/' ) ); ?>" class="footer__link">メンバー</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/history/' ) ); ?>" class="footer__link">ヒストリー</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <p class="footer__copyright">© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
