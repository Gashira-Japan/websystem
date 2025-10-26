/**
 * TOC (Table of Contents) 機能のためのJavaScript
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // 目次の「もっと見る」ボタンの処理
        $('#toc-show-more-btn').on('click', function() {
            const $button = $(this);
            const $hiddenItems = $('.toc-hidden');
            
            if ($hiddenItems.is(':visible')) {
                // 非表示にする
                $hiddenItems.slideUp(300);
                $button.text(tocParams.showMoreText); // 「もっと見る」に戻す
                $button.removeClass('toc-hide-items');
            } else {
                // 表示する
                $hiddenItems.slideDown(300);
                $button.text(tocParams.showLessText); // 「閉じる」に変更
                $button.addClass('toc-hide-items');
            }
        });

        // スムーズスクロール
        $('.toc-item a').on('click', function(e) {
            e.preventDefault();
            
            const targetId = $(this).attr('href');
            const $target = $(targetId);
            
            if ($target.length) {
                // ヘッダーの高さを考慮してスクロール位置を調整
                const headerHeight = $('.page-header').outerHeight() || 0;
                const scrollPosition = $target.offset().top - headerHeight - 20; // 20pxの余白を追加
                
                $('html, body').animate({
                    scrollTop: scrollPosition
                }, 600, 'swing'); // スクロール速度を調整
            }
        });

        // スクロール時の目次ハイライト処理
        $(window).on('scroll', function() {
            highlightTocOnScroll();
        });

        // 初期表示時のハイライト
        highlightTocOnScroll();
    });

    /**
     * スクロール位置に基づいて目次をハイライトする
     */
    function highlightTocOnScroll() {
        const scrollPosition = $(window).scrollTop();
        const headerHeight = $('.page-header').outerHeight() || 0;
        
        // 見出し要素を取得
        const $headings = $('h2[id], h3[id], h4[id]');
        
        // 現在表示されている見出しを特定
        let currentHeadingId = '';
        
        $headings.each(function() {
            const headingTop = $(this).offset().top - headerHeight - 50; // 50pxの余白を追加
            
            if (scrollPosition >= headingTop) {
                currentHeadingId = '#' + $(this).attr('id');
            } else {
                return false; // ループを抜ける
            }
        });
        
        // 目次のハイライトを更新
        if (currentHeadingId) {
            $('.toc-item a').removeClass('active');
            $('.toc-item a[href="' + currentHeadingId + '"]').addClass('active');
        }
    }

})(jQuery); 