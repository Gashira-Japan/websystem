/* ========================================
   テンファイブ統一ヒーロースライダー機能
   コーポレートサイト・採用サイト共通
   ======================================== */

/**
 * ヒーロー背景スライダー機能の初期化
 * 自動スライドと手動制御を提供
 * モバイル最適化：タッチスワイプ対応、GPUアクセラレーション
 */
function initHeroBackgroundSlider() {
    console.log('Hero Background Slider - Function called');
    const slider = document.querySelector('.hero__bg-slider');
    const slides = document.querySelectorAll('.hero__bg-slide');

    console.log('Hero Background Slider - Slider found:', !!slider);
    console.log('Hero Background Slider - Slides found:', slides.length);
    console.log('Hero Background Slider - Slider element:', slider);
    console.log('Hero Background Slider - Slides elements:', slides);

    if (!slider || slides.length === 0) {
        console.log('Hero Background Slider - Initialization failed: missing elements');
        return;
    }

    let currentSlide = 0;
    const totalSlides = slides.length;
    const slideInterval = 5000; // 5秒間隔

    // タッチイベント用の変数
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    let isSwiping = false;
    const minSwipeDistance = 50; // 最小スワイプ距離（ピクセル）

    // スライドを切り替える関数（requestAnimationFrameで最適化）
    function showSlide(index) {
        console.log('Hero Background Slider - Showing slide:', index);

        // requestAnimationFrameでスムーズなアニメーション
        requestAnimationFrame(() => {
            // すべてのスライドからactiveクラスを削除
            slides.forEach(slide => {
                slide.classList.remove('hero__bg-slide--active');
            });

            // 指定されたスライドにactiveクラスを追加
            slides[index].classList.add('hero__bg-slide--active');
            currentSlide = index;
        });
    }

    // 次のスライドに進む
    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        console.log('Hero Background Slider - Next slide called, current:', currentSlide, 'next:', nextIndex);
        showSlide(nextIndex);
    }

    // 前のスライドに戻る
    function prevSlide() {
        const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
        console.log('Hero Background Slider - Previous slide called, current:', currentSlide, 'prev:', prevIndex);
        showSlide(prevIndex);
    }

    // タッチスタートイベント
    function handleTouchStart(event) {
        touchStartX = event.touches[0].clientX;
        touchStartY = event.touches[0].clientY;
        isSwiping = true;

        // タッチ中は自動スライドを一時停止
        stopAutoSlide();
    }

    // タッチムーブイベント
    function handleTouchMove(event) {
        if (!isSwiping) return;

        touchEndX = event.touches[0].clientX;
        touchEndY = event.touches[0].clientY;

        // 縦スクロールと横スワイプを区別
        const deltaX = Math.abs(touchEndX - touchStartX);
        const deltaY = Math.abs(touchEndY - touchStartY);

        // 横方向のスワイプが優勢な場合、デフォルトの挙動を防止
        if (deltaX > deltaY && deltaX > 10) {
            event.preventDefault();
        }
    }

    // タッチエンドイベント
    function handleTouchEnd() {
        if (!isSwiping) return;

        const deltaX = touchEndX - touchStartX;
        const deltaY = Math.abs(touchEndY - touchStartY);

        // 横方向のスワイプが優勢で、最小距離を超えている場合
        if (Math.abs(deltaX) > minSwipeDistance && Math.abs(deltaX) > deltaY) {
            if (deltaX > 0) {
                // 右にスワイプ：前のスライド
                prevSlide();
            } else {
                // 左にスワイプ：次のスライド
                nextSlide();
            }
        }

        isSwiping = false;

        // 自動スライドを再開
        startAutoSlide();
    }

    // 自動スライド開始
    function startAutoSlide() {
        // 既存のインターバルをクリア
        if (window.heroSliderInterval) {
            clearInterval(window.heroSliderInterval);
        }

        // 新しいインターバルを設定
        window.heroSliderInterval = setInterval(nextSlide, slideInterval);
        console.log('Hero Background Slider - Auto slide started');
    }

    // 自動スライド停止
    function stopAutoSlide() {
        if (window.heroSliderInterval) {
            clearInterval(window.heroSliderInterval);
            window.heroSliderInterval = null;
            console.log('Hero Background Slider - Auto slide stopped');
        }
    }

    // 画像のプリロード
    function preloadImages() {
        const images = slider.querySelectorAll('.hero__bg-image');
        images.forEach((img, index) => {
            const image = new Image();
            image.onload = () => {
                console.log(`Hero Background Slider - Image ${index + 1} preloaded`);
            };
            image.onerror = () => {
                console.warn(`Hero Background Slider - Failed to preload image ${index + 1}`);
            };
            image.src = img.src;
        });
    }

    // Intersection Observer でパフォーマンス最適化
    function setupIntersectionObserver() {
        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // スライダーが画面内に入ったら自動スライド開始
                    startAutoSlide();
                } else {
                    // スライダーが画面外に出たら自動スライド停止
                    stopAutoSlide();
                }
            });
        }, options);

        observer.observe(slider);
    }

    // 初期化処理
    function init() {
        console.log('Hero Background Slider - Initializing...');

        // 最初のスライドを表示
        showSlide(0);

        // 画像をプリロード
        preloadImages();

        // タッチイベントリスナーの追加（passive: false でスクロール防止を可能に）
        slider.addEventListener('touchstart', handleTouchStart, { passive: true });
        slider.addEventListener('touchmove', handleTouchMove, { passive: false });
        slider.addEventListener('touchend', handleTouchEnd, { passive: true });

        // Intersection Observer のセットアップ
        if ('IntersectionObserver' in window) {
            setupIntersectionObserver();
        } else {
            // Intersection Observer がサポートされていない場合は通常の自動スライド
            startAutoSlide();
        }

        // ページが非表示になったら自動スライドを停止
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopAutoSlide();
            } else {
                if ('IntersectionObserver' in window) {
                    // Intersection Observer がある場合は、それに任せる
                } else {
                    startAutoSlide();
                }
            }
        });

        // ウィンドウがフォーカスを失ったら自動スライドを停止
        window.addEventListener('blur', stopAutoSlide);
        window.addEventListener('focus', () => {
            if (!document.hidden && !('IntersectionObserver' in window)) {
                startAutoSlide();
            }
        });

        console.log('Hero Background Slider - Initialization completed');
    }

    // 初期化実行
    init();

    // 外部から制御できるように関数を返す
    return {
        showSlide,
        nextSlide,
        prevSlide,
        startAutoSlide,
        stopAutoSlide,
        getCurrentSlide: () => currentSlide,
        getTotalSlides: () => totalSlides
    };
}

// DOMContentLoadedイベントで初期化
document.addEventListener('DOMContentLoaded', () => {
    // ヒーロースライダーが存在する場合のみ初期化
    if (document.querySelector('.hero__bg-slider')) {
        window.heroSlider = initHeroBackgroundSlider();
    }
});

// グローバルに公開（必要に応じて）
window.initHeroBackgroundSlider = initHeroBackgroundSlider;
