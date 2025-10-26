/* ========================================
   テンファイブ統一ヒーロースライダー機能
   コーポレートサイト・採用サイト共通
   ======================================== */

/**
 * ヒーロー背景スライダー機能の初期化
 * 自動スライドと手動制御を提供
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
    
    // スライドを切り替える関数
    function showSlide(index) {
        console.log('Hero Background Slider - Showing slide:', index);
        // すべてのスライドからactiveクラスを削除
        slides.forEach(slide => {
            slide.classList.remove('hero__bg-slide--active');
        });
        
        // 指定されたスライドにactiveクラスを追加
        slides[index].classList.add('hero__bg-slide--active');
        currentSlide = index;
    }
    
    // 次のスライドに進む
    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        console.log('Hero Background Slider - Next slide called, current:', currentSlide, 'next:', nextIndex);
        showSlide(nextIndex);
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
    
    // 初期化処理
    function init() {
        console.log('Hero Background Slider - Initializing...');
        
        // 最初のスライドを表示
        showSlide(0);
        
        // 画像をプリロード
        preloadImages();
        
        // 自動スライド開始
        startAutoSlide();
        
        // ページが非表示になったら自動スライドを停止
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopAutoSlide();
            } else {
                startAutoSlide();
            }
        });
        
        // ウィンドウがフォーカスを失ったら自動スライドを停止
        window.addEventListener('blur', stopAutoSlide);
        window.addEventListener('focus', startAutoSlide);
        
        console.log('Hero Background Slider - Initialization completed');
    }
    
    // 初期化実行
    init();
    
    // 外部から制御できるように関数を返す
    return {
        showSlide,
        nextSlide,
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
