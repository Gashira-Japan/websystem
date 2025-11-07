/**
 * ヒーローセクション背景画像スライダー
 * 新卒・中途採用ページ用（レスポンシブ対応）
 */

class HeroSlider {
    constructor(container) {
        this.container = container;
        this.slides = container.querySelectorAll('[data-slide]');
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.interval = null;
        this.duration = 5000; // 5秒間隔
        this.isMobile = window.innerWidth <= 768;
        
        this.init();
    }
    
    init() {
        if (this.totalSlides <= 1) return;
        
        this.startSlider();
        this.addEventListeners();
        this.handleResize();
    }
    
    startSlider() {
        this.interval = setInterval(() => {
            this.nextSlide();
        }, this.duration);
    }
    
    stopSlider() {
        if (this.interval) {
            clearInterval(this.interval);
            this.interval = null;
        }
    }
    
    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlides();
    }
    
    goToSlide(index) {
        this.currentSlide = index;
        this.updateSlides();
    }
    
    updateSlides() {
        this.slides.forEach((slide, index) => {
            const isActive = index === this.currentSlide;
            // 新卒・中途採用ページ用
            slide.classList.toggle('hero-new-grad__slide--active', isActive);
            slide.classList.toggle('hero-mid-career__slide--active', isActive);
            // 採用トップページ用
            slide.classList.toggle('hero__bg-slide--active', isActive);
        });
    }
    
    addEventListeners() {
        // ホバー時にスライダーを一時停止
        this.container.addEventListener('mouseenter', () => {
            this.stopSlider();
        });
        
        this.container.addEventListener('mouseleave', () => {
            this.startSlider();
        });
        
        // ページが非表示になった時にスライダーを停止
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.stopSlider();
            } else {
                this.startSlider();
            }
        });
        
        // リサイズ時にレスポンシブ画像を更新
        window.addEventListener('resize', () => {
            this.handleResize();
        });
    }
    
    handleResize() {
        const wasMobile = this.isMobile;
        this.isMobile = window.innerWidth <= 768;
        
        // モバイル/デスクトップの切り替え時に画像を更新
        if (wasMobile !== this.isMobile) {
            this.updateResponsiveImages();
        }
    }
    
    updateResponsiveImages() {
        this.slides.forEach(slide => {
            const picture = slide.querySelector('picture');
            if (picture) {
                // picture要素の再読み込みを強制
                const sources = picture.querySelectorAll('source');
                const img = picture.querySelector('img');
                
                sources.forEach(source => {
                    const currentSrc = source.srcset;
                    source.srcset = '';
                    source.srcset = currentSrc;
                });
                
                if (img) {
                    const currentSrc = img.src;
                    img.src = '';
                    img.src = currentSrc;
                }
            }
        });
    }
    
    destroy() {
        this.stopSlider();
    }
}

// 新卒採用ページのスライダー初期化
document.addEventListener('DOMContentLoaded', () => {
    const newGradHero = document.querySelector('.hero-new-grad');
    const midCareerHero = document.querySelector('.hero-mid-career');
    
    if (newGradHero) {
        new HeroSlider(newGradHero);
    }
    
    if (midCareerHero) {
        new HeroSlider(midCareerHero);
    }
    
    // 採用トップページのスライダー初期化
    const heroSlider = document.querySelector('.hero__bg-slider');
    if (heroSlider) {
        // data-slide属性がない場合は追加
        const slides = heroSlider.querySelectorAll('.hero__bg-slide');
        slides.forEach((slide, index) => {
            if (!slide.hasAttribute('data-slide')) {
                slide.setAttribute('data-slide', index.toString());
            }
        });
        new HeroSlider(heroSlider.closest('.hero') || heroSlider);
    }
});
