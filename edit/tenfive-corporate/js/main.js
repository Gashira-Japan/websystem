/* ========================================
   テンファイブコーポレートサイト - メインJavaScript
   ======================================== */

(function() {
    'use strict';

    // DOM読み込み完了後に実行
    document.addEventListener('DOMContentLoaded', function() {
        initNavigation();
        initScrollEffects();
        initAnimations();
        initAccessibility();
        initBlogSlider();
        initCurriculumSlider();
        initCaseStudiesSlider();
        initHeroBackgroundSlider();
    });

    /* ========================================
       ナビゲーション機能
       ======================================== */
    function initNavigation() {
        const hamburger = document.getElementById('hamburger-menu');
        const nav = document.getElementById('main-navigation');
        
        if (!hamburger || !nav) return;

        // ハンバーガーメニューの開閉
        hamburger.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            
            if (!isExpanded) {
                nav.classList.add('nav--open');
                document.body.classList.add('nav-open');
            } else {
                nav.classList.remove('nav--open');
                document.body.classList.remove('nav-open');
            }
        });

        // メニュー外クリックで閉じる
        document.addEventListener('click', function(e) {
            if (!hamburger.contains(e.target) && !nav.contains(e.target)) {
                hamburger.setAttribute('aria-expanded', 'false');
                nav.classList.remove('nav--open');
                document.body.classList.remove('nav-open');
            }
        });

        // リンククリックでメニューを閉じる
        const navLinks = nav.querySelectorAll('.nav__link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburger.setAttribute('aria-expanded', 'false');
                nav.classList.remove('nav--open');
                document.body.classList.remove('nav-open');
            });
        });

        // スムーススクロール
        initSmoothScroll();
    }

    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // 空のハッシュや同じページのハッシュでない場合は処理しない
                if (href === '#' || href === '#top') return;
                
                e.preventDefault();
                
                const target = document.querySelector(href);
                if (!target) return;
                
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            });
        });
    }

    /* ========================================
       スクロール効果
       ======================================== */
    function initScrollEffects() {
        // ヘッダーのスクロール効果
        const header = document.querySelector('.header');
        if (!header) return;

        let lastScrollTop = 0;
        let ticking = false;

        function updateHeader() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('header--scrolled');
            } else {
                header.classList.remove('header--scrolled');
            }

            // スクロール方向によるヘッダーの表示/非表示
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.classList.add('header--hidden');
            } else {
                header.classList.remove('header--hidden');
            }
            
            lastScrollTop = scrollTop;
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });

        // Intersection Observer for animations
        initIntersectionObserver();
    }

    function initIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // アニメーション対象要素を監視
        const animateElements = document.querySelectorAll(
            '.tech-blog__item, .case-study, .pickup-item, .curriculum-item, .glossary-item, .member, .strength-item'
        );
        
        animateElements.forEach(el => {
            observer.observe(el);
        });
    }

    /* ========================================
       アニメーション
       ======================================== */
    function initAnimations() {
        // ヒーローセクションのアニメーション
        const hero = document.querySelector('.hero');
        if (hero) {
            setTimeout(() => {
                hero.classList.add('hero--animated');
            }, 300);
        }

        // カードホバー効果の強化（strength-itemは除外）
        const cards = document.querySelectorAll('.card, .tech-blog__item, .case-study, .pickup-item, .member');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }

    /* ========================================
       アクセシビリティ
       ======================================== */
    function initAccessibility() {
        // キーボードナビゲーション
        document.addEventListener('keydown', function(e) {
            // ESCキーでモーダルやメニューを閉じる
            if (e.key === 'Escape') {
                const hamburger = document.getElementById('hamburger-menu');
                if (hamburger && hamburger.getAttribute('aria-expanded') === 'true') {
                    hamburger.click();
                }
            }
        });

        // フォーカス管理
        const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        
        // モーダル内でのフォーカストラップ
        function trapFocus(element) {
            const focusableContent = element.querySelectorAll(focusableElements);
            const firstFocusableElement = focusableContent[0];
            const lastFocusableElement = focusableContent[focusableContent.length - 1];

            element.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusableElement) {
                            lastFocusableElement.focus();
                            e.preventDefault();
                        }
                    } else {
                        if (document.activeElement === lastFocusableElement) {
                            firstFocusableElement.focus();
                            e.preventDefault();
                        }
                    }
                }
            });
        }

        // スキップリンク
        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.focus();
                    target.scrollIntoView();
                }
            });
        }
    }

    /* ========================================
       ユーティリティ関数
       ======================================== */
    
    // デバウンス関数
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // スロットル関数
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /* ========================================
       エラーハンドリング
       ======================================== */
    
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        // 本番環境ではエラー追跡サービスに送信
    });

    /* ========================================
       ブログスライダー機能
       ======================================== */
    function initBlogSlider() {
        const slider = document.getElementById('blogSlider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dots = document.querySelectorAll('.blog-slider__dot');
        
        if (!slider || !prevBtn || !nextBtn) return;
        
        let currentSlide = 0;
        let cardsPerSlide = getCardsPerSlide();
        const totalCards = slider.children.length;
        let maxSlides = Math.ceil(totalCards / cardsPerSlide);
        
        // 表示カード数を取得
        function getCardsPerSlide() {
            return window.innerWidth <= 768 ? 1 : 2;
        }
        
        // スライダー更新
        function updateSlider() {
            // よりシンプルで確実な計算
            const cardWidth = 350; // 固定値を使用
            const gap = 24; // var(--spacing-6)
            const slideWidth = (cardWidth + gap) * cardsPerSlide;
            
            // 基本的な移動距離計算
            const translateX = -currentSlide * slideWidth;
            
            // デバッグ用ログ（開発環境のみ）
            if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                console.log('Slider Debug:', {
                    currentSlide,
                    cardsPerSlide,
                    slideWidth,
                    translateX,
                    totalCards,
                    maxSlides
                });
            }
            
            slider.style.transform = `translateX(${translateX}px)`;
            
            // ボタンの状態更新
            prevBtn.disabled = currentSlide === 0;
            nextBtn.disabled = currentSlide >= maxSlides - 1;
            
            // ドットの状態更新（動的に取得）
            const currentDots = document.querySelectorAll('#sliderDots .blog-slider__dot');
            currentDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
        
        // ドットを更新
        function updateDots() {
            const dotsContainer = document.getElementById('sliderDots');
            if (!dotsContainer) return;
            
            // 既存のドットをクリア
            dotsContainer.innerHTML = '';
            
            // 新しいドットを生成
            for (let i = 0; i < maxSlides; i++) {
                const dot = document.createElement('div');
                dot.className = 'blog-slider__dot';
                if (i === currentSlide) dot.classList.add('active');
                dot.setAttribute('data-slide', i);
                
                // ドットクリックイベント
                dot.addEventListener('click', () => {
                    moveToSlide(i);
                });
                
                dotsContainer.appendChild(dot);
            }
            
            // ドット生成後にスライダー状態を更新
            updateSlider();
        }
        
        // スライダーをリセット
        function resetSlider() {
            cardsPerSlide = getCardsPerSlide();
            maxSlides = Math.ceil(totalCards / cardsPerSlide);
            currentSlide = Math.min(currentSlide, maxSlides - 1);
            updateDots();
            updateSlider();
        }
        
        // スライダー移動（デバウンス付き）
        let isAnimating = false;
        
        function moveToSlide(targetSlide) {
            if (isAnimating) return;
            
            isAnimating = true;
            currentSlide = Math.max(0, Math.min(maxSlides - 1, targetSlide));
            
            // 移動前に再度計算を実行
            cardsPerSlide = getCardsPerSlide();
            maxSlides = Math.ceil(totalCards / cardsPerSlide);
            
            updateSlider();
            
            setTimeout(() => {
                isAnimating = false;
            }, 300); // CSS transition時間と同期
        }
        
        // 前へ
        prevBtn.addEventListener('click', () => {
            if (currentSlide > 0) {
                moveToSlide(currentSlide - 1);
            }
        });
        
        // 次へ
        nextBtn.addEventListener('click', () => {
            if (currentSlide < maxSlides - 1) {
                moveToSlide(currentSlide + 1);
            }
        });
        
        // 初期ドット設定（静的ドットが存在する場合）
        const initialDots = document.querySelectorAll('.blog-slider__dot');
        initialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                moveToSlide(index);
            });
        });
        
        // レスポンシブ対応
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                resetSlider();
            }, 250);
        });
        
        // 初期化（画像読み込み完了を待つ）
        function initializeSlider() {
            updateDots();
            updateSlider();
        }
        
        // 画像読み込み完了を待つ
        const images = slider.querySelectorAll('img');
        let loadedImages = 0;
        
        if (images.length === 0) {
            // 画像がない場合は即座に初期化
            initializeSlider();
        } else {
            images.forEach(img => {
                if (img.complete) {
                    loadedImages++;
                } else {
                    img.addEventListener('load', () => {
                        loadedImages++;
                        if (loadedImages === images.length) {
                            initializeSlider();
                        }
                    });
                }
            });
            
            // タイムアウトで確実に初期化
            setTimeout(() => {
                if (loadedImages < images.length) {
                    console.log('Images not fully loaded, initializing anyway');
                    initializeSlider();
                }
            }, 1000);
        }
        
        // フリック操作（タッチデバイス用）
        let startX = 0;
        let startY = 0;
        let isDragging = false;
        let touchStartTime = 0;
        
        slider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            touchStartTime = Date.now();
            isDragging = true;
        }, { passive: true });
        
        slider.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            // タブレットでも確実に動作するようにpassiveを削除
        }, { passive: true });
        
        slider.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const deltaX = startX - endX;
            const deltaY = startY - endY;
            const touchDuration = Date.now() - touchStartTime;
            
            // 水平方向のスワイプが垂直方向より大きい場合のみ処理
            // タブレット対応：より短い距離でも反応するように調整
            const maxTouchDuration = 500; // タッチ時間の上限
            if (Math.abs(deltaX) > Math.abs(deltaY) && 
                Math.abs(deltaX) > 30 && 
                touchDuration < maxTouchDuration) {
                if (deltaX > 0 && currentSlide < maxSlides - 1) {
                    // 左スワイプ（次へ）
                    moveToSlide(currentSlide + 1);
                } else if (deltaX < 0 && currentSlide > 0) {
                    // 右スワイプ（前へ）
                    moveToSlide(currentSlide - 1);
                }
            }
            
            isDragging = false;
        }, { passive: true });
    }

    /* ========================================
       アカデミースライダー機能
       ======================================== */
    function initCurriculumSlider() {
        const slider = document.getElementById('curriculumSlider');
        const prevBtn = document.getElementById('curriculumPrevBtn');
        const nextBtn = document.getElementById('curriculumNextBtn');
        const dots = document.querySelectorAll('#curriculumSliderDots .blog-slider__dot');
        
        if (!slider || !prevBtn || !nextBtn) return;
        
        let currentSlide = 0;
        let cardsPerSlide = getCardsPerSlide();
        const totalCards = slider.children.length;
        let maxSlides = Math.ceil(totalCards / cardsPerSlide);
        
        // 表示カード数を取得
        function getCardsPerSlide() {
            return window.innerWidth <= 768 ? 1 : 2;
        }
        
        // スライダー更新
        function updateSlider() {
            // よりシンプルで確実な計算
            const cardWidth = 350; // 固定値を使用
            const gap = 24; // var(--spacing-6)
            const slideWidth = (cardWidth + gap) * cardsPerSlide;
            
            // 基本的な移動距離計算
            const translateX = -currentSlide * slideWidth;
            
            // デバッグ用ログ（開発環境のみ）
            if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                console.log('Curriculum Slider Debug:', {
                    currentSlide,
                    cardsPerSlide,
                    slideWidth,
                    translateX,
                    totalCards,
                    maxSlides
                });
            }
            
            slider.style.transform = `translateX(${translateX}px)`;
            
            // ボタンの状態更新
            prevBtn.disabled = currentSlide === 0;
            nextBtn.disabled = currentSlide >= maxSlides - 1;
            
            // ドットの状態更新（動的に取得）
            const currentDots = document.querySelectorAll('#curriculumSliderDots .blog-slider__dot');
            currentDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
        
        // ドットを更新
        function updateDots() {
            const dotsContainer = document.getElementById('curriculumSliderDots');
            if (!dotsContainer) return;
            
            // 既存のドットをクリア
            dotsContainer.innerHTML = '';
            
            // 新しいドットを生成
            for (let i = 0; i < maxSlides; i++) {
                const dot = document.createElement('div');
                dot.className = 'blog-slider__dot';
                if (i === currentSlide) dot.classList.add('active');
                dot.setAttribute('data-slide', i);
                
                // ドットクリックイベント
                dot.addEventListener('click', () => {
                    moveToSlide(i);
                });
                
                dotsContainer.appendChild(dot);
            }
            
            // ドット生成後にスライダー状態を更新
            updateSlider();
        }
        
        // スライダーをリセット
        function resetSlider() {
            cardsPerSlide = getCardsPerSlide();
            maxSlides = Math.ceil(totalCards / cardsPerSlide);
            currentSlide = Math.min(currentSlide, maxSlides - 1);
            updateDots();
            updateSlider();
        }
        
        // スライダー移動（デバウンス付き）
        let isAnimating = false;
        
        function moveToSlide(targetSlide) {
            if (isAnimating) return;
            
            isAnimating = true;
            currentSlide = Math.max(0, Math.min(maxSlides - 1, targetSlide));
            
            // 移動前に再度計算を実行
            cardsPerSlide = getCardsPerSlide();
            maxSlides = Math.ceil(totalCards / cardsPerSlide);
            
            updateSlider();
            
            setTimeout(() => {
                isAnimating = false;
            }, 300); // CSS transition時間と同期
        }
        
        // 前へ
        prevBtn.addEventListener('click', () => {
            if (currentSlide > 0) {
                moveToSlide(currentSlide - 1);
            }
        });
        
        // 次へ
        nextBtn.addEventListener('click', () => {
            if (currentSlide < maxSlides - 1) {
                moveToSlide(currentSlide + 1);
            }
        });
        
        // 初期ドット設定（静的ドットが存在する場合）
        const initialDots = document.querySelectorAll('#curriculumSliderDots .blog-slider__dot');
        initialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                moveToSlide(index);
            });
        });
        
        // レスポンシブ対応
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                resetSlider();
            }, 250);
        });
        
        // 初期化（画像読み込み完了を待つ）
        function initializeSlider() {
            updateDots(); // updateDots内でupdateSliderが呼ばれる
        }
        
        // 画像読み込み完了を待つ
        const images = slider.querySelectorAll('img');
        let loadedImages = 0;
        
        if (images.length === 0) {
            // 画像がない場合は即座に初期化
            initializeSlider();
        } else {
            images.forEach(img => {
                if (img.complete) {
                    loadedImages++;
                } else {
                    img.addEventListener('load', () => {
                        loadedImages++;
                        if (loadedImages === images.length) {
                            initializeSlider();
                        }
                    });
                }
            });
            
            // タイムアウトで確実に初期化
            setTimeout(() => {
                if (loadedImages < images.length) {
                    console.log('Curriculum images not fully loaded, initializing anyway');
                    initializeSlider();
                }
            }, 1000);
        }
        
        // フリック操作（タッチデバイス用）
        let startX = 0;
        let startY = 0;
        let isDragging = false;
        let touchStartTime = 0;
        
        slider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            touchStartTime = Date.now();
            isDragging = true;
        }, { passive: true });
        
        slider.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            // タブレットでも確実に動作するようにpassiveを削除
        }, { passive: true });
        
        slider.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const deltaX = startX - endX;
            const deltaY = startY - endY;
            const touchDuration = Date.now() - touchStartTime;
            
            // 水平方向のスワイプが垂直方向より大きい場合のみ処理
            // タブレット対応：より短い距離でも反応するように調整
            const maxTouchDuration = 500; // タッチ時間の上限
            if (Math.abs(deltaX) > Math.abs(deltaY) && 
                Math.abs(deltaX) > 30 && 
                touchDuration < maxTouchDuration) {
                if (deltaX > 0 && currentSlide < maxSlides - 1) {
                    // 左スワイプ（次へ）
                    moveToSlide(currentSlide + 1);
                } else if (deltaX < 0 && currentSlide > 0) {
                    // 右スワイプ（前へ）
                    moveToSlide(currentSlide - 1);
                }
            }
            
            isDragging = false;
        }, { passive: true });
    }


    /* ========================================
       ヒーロー背景スライダー機能は shared-hero-slider.js で管理
       ======================================== */

    // 未処理のPromise拒否をキャッチ
    window.addEventListener('unhandledrejection', function(e) {
        console.error('Unhandled Promise Rejection:', e.reason);
        // 本番環境ではエラー追跡サービスに送信
    });

    /* ========================================
       実績スライダー機能
       ======================================== */
    function initCaseStudiesSlider() {
        const slider = document.getElementById('case-studies-slider');
        const track = document.getElementById('case-studies-track');
        const controls = document.getElementById('case-studies-controls');
        const indicators = document.getElementById('case-studies-indicators');
        const prevBtn = document.getElementById('case-studies-prev');
        const nextBtn = document.getElementById('case-studies-next');
        
        console.log('Case Studies Slider Init:', { slider, track, controls, indicators, prevBtn, nextBtn });
        
        if (!slider || !track) {
            console.log('Case Studies Slider: Required elements not found');
            return;
        }
        
        const slides = track.querySelectorAll('.case-studies__slide');
        const slideCount = slides.length;
        
        // コンテンツ数に応じた表示制御
        const isMobile = window.innerWidth < 768;
        if (slideCount < 3 && !isMobile) {
            // デスクトップで2個以下の場合はスライダー機能を無効化
            track.style.transform = 'none';
            track.style.gap = 'var(--spacing-xl)';
            
            // デスクトップでは2列表示
            slides.forEach(slide => {
                slide.style.flex = '0 0 50%';
            });
            
            return; // スライダー機能は実行しない
        }
        
        // スマホでは2個でもスライダー機能を有効化
        if (slideCount < 2) {
            console.log('Not enough slides for slider');
            return;
        }
        
        // スライダー機能を有効化
        let currentSlide = 0;
        const slidesPerView = isMobile ? 1 : 2;
        const maxSlide = Math.ceil(slideCount / slidesPerView) - 1;
        
        // スライダーコントロールを表示
        if (controls) controls.style.display = 'flex';
        if (indicators) indicators.style.display = 'flex';
        
        // インジケーターを生成
        if (indicators) {
            indicators.innerHTML = '';
            for (let i = 0; i <= maxSlide; i++) {
                const indicator = document.createElement('button');
                indicator.className = 'case-studies__indicator';
                if (i === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => goToSlide(i));
                indicators.appendChild(indicator);
            }
        }
        
        // スライド移動関数
        function goToSlide(slideIndex) {
            currentSlide = Math.max(0, Math.min(slideIndex, maxSlide));
            const translateX = -currentSlide * (100 / slidesPerView);
            track.style.transform = `translateX(${translateX}%)`;
            
            // インジケーター更新
            if (indicators) {
                const indicatorBtns = indicators.querySelectorAll('.case-studies__indicator');
                indicatorBtns.forEach((btn, index) => {
                    btn.classList.toggle('active', index === currentSlide);
                });
            }
            
            // ボタンの状態更新
            if (prevBtn) prevBtn.disabled = currentSlide === 0;
            if (nextBtn) nextBtn.disabled = currentSlide === maxSlide;
        }
        
        // 前へボタン
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentSlide > 0) goToSlide(currentSlide - 1);
            });
        }
        
        // 次へボタン
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (currentSlide < maxSlide) goToSlide(currentSlide + 1);
            });
        }
        
        // フリック操作（タッチデバイス用）
        let startX = 0;
        let startY = 0;
        let isDragging = false;
        let touchStartTime = 0;
        
        console.log('Adding touch events to track:', track);
        
        track.addEventListener('touchstart', (e) => {
            console.log('Touch start:', e.touches[0].clientX, e.touches[0].clientY);
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            isDragging = true;
        }, { passive: true });
        
        track.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            console.log('Touch move:', e.touches[0].clientX, e.touches[0].clientY);
            e.preventDefault();
        }, { passive: false });
        
        track.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const deltaX = startX - endX;
            const deltaY = startY - endY;
            
            console.log('Touch end:', { endX, endY, deltaX, deltaY, currentSlide, maxSlide });
            
            // 水平方向のスワイプが垂直方向より大きい場合のみ処理
            // タブレット対応：より短い距離でも反応するように調整
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 30) {
                console.log('Valid swipe detected:', deltaX > 0 ? 'left swipe (next)' : 'right swipe (prev)');
                if (deltaX > 0 && currentSlide < maxSlide) {
                    // 左スワイプ（次へ）
                    console.log('Going to next slide');
                    goToSlide(currentSlide + 1);
                } else if (deltaX < 0 && currentSlide > 0) {
                    // 右スワイプ（前へ）
                    console.log('Going to prev slide');
                    goToSlide(currentSlide - 1);
                }
            }
            
            isDragging = false;
        }, { passive: true });
        
        // レスポンシブ対応
        function handleResize() {
            const newIsMobile = window.innerWidth < 768;
            const newSlidesPerView = newIsMobile ? 1 : 2;
            const newMaxSlide = Math.ceil(slideCount / newSlidesPerView) - 1;
            
            if (newIsMobile !== isMobile) {
                currentSlide = Math.min(currentSlide, newMaxSlide);
                goToSlide(currentSlide);
                
                // インジケーター再生成
                if (indicators) {
                    indicators.innerHTML = '';
                    for (let i = 0; i <= newMaxSlide; i++) {
                        const indicator = document.createElement('button');
                        indicator.className = 'case-studies__indicator';
                        if (i === currentSlide) indicator.classList.add('active');
                        indicator.addEventListener('click', () => goToSlide(i));
                        indicators.appendChild(indicator);
                    }
                }
            }
        }
        
        window.addEventListener('resize', handleResize);
        
        // 初期状態設定
        goToSlide(0);
    }

})();

