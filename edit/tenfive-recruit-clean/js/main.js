/**
 * テンファイブ採用サイト - メインJavaScript
 * デザインシステムに基づいたインタラクティブ機能
 */

// DOM読み込み完了後に実行
document.addEventListener('DOMContentLoaded', function() {
    // スムーススクロール
    initSmoothScroll();
    
    // ヘッダーのスクロール効果
    initHeaderScroll();
    
    // アニメーション
    initScrollAnimations();
    
    // モバイルメニュー
    initMobileMenu();
    
    // 選考セクションのタブ機能
    initSelectionTabs();
    
    // レスポンシブ画像切り替え
    initResponsiveImages();
    
    // フォーカス管理
    initFocusManagement();
});

/**
 * スムーススクロール機能
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}


/**
 * 選考セクションのタブ機能
 */
function initSelectionTabs() {
    const tabButtons = document.querySelectorAll('.selection__tab-button');
    const tabPanels = document.querySelectorAll('.selection__tab-panel');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // 全タブボタンからアクティブクラスを削除
            tabButtons.forEach(btn => btn.classList.remove('selection__tab-button--active'));
            // 全パネルを非表示
            tabPanels.forEach(panel => panel.classList.remove('selection__tab-panel--active'));
            
            // クリックされたボタンをアクティブに
            this.classList.add('selection__tab-button--active');
            // 対応するパネルを表示
            const targetPanel = document.getElementById(targetTab);
            if (targetPanel) {
                targetPanel.classList.add('selection__tab-panel--active');
            }
        });
    });
}

/**
 * ヘッダーのスクロール効果
 */
function initHeaderScroll() {
    const header = document.querySelector('.header');
    let lastScrollY = window.scrollY;
    
    window.addEventListener('scroll', function() {
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > 100) {
            header.classList.add('header--scrolled');
        } else {
            header.classList.remove('header--scrolled');
        }
        
        // スクロール方向に応じたヘッダーの表示/非表示
        if (currentScrollY > lastScrollY && currentScrollY > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollY = currentScrollY;
    });
}

/**
 * スクロールアニメーション
 */
function initScrollAnimations() {
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
    const animateElements = document.querySelectorAll('.feature-card, .workstyle-card, .job-card, .section__header');
    animateElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * グローバルナビゲーション - デザイン庁ベストプラクティス準拠
 */
function initMobileMenu() {
    const hamburgerButton = document.getElementById('hamburger-menu');
    const nav = document.getElementById('main-navigation');
    const navItems = document.querySelectorAll('.nav__item[data-dropdown]');
    
    if (!hamburgerButton || !nav) return;
    
    // ハンバーガーメニューのクリックイベント
    hamburgerButton.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        this.setAttribute('aria-expanded', !isExpanded);
        nav.classList.toggle('active');
        
        // メニューが開いている間はスクロールを無効化
        document.body.style.overflow = !isExpanded ? 'hidden' : '';
        
        
        // アクセシビリティ: フォーカス管理
        if (!isExpanded) {
            const firstLink = nav.querySelector('.nav__link');
            if (firstLink) firstLink.focus();
        }
    });
    
    // グローバルナビゲーションの状態管理
    navItems.forEach(item => {
        const dropdown = item.querySelector('.nav__dropdown');
        const link = item.querySelector('.nav__link');
        
        if (dropdown) {
            // マウスイベント（デスクトップ）
            item.addEventListener('mouseenter', function() {
                if (window.innerWidth >= 1024) {
                    // 他のドロップダウンを閉じる
                    navItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('nav__item--active');
                            otherItem.querySelector('.nav__link').classList.remove('nav__link--active');
                        }
                    });
                    
                    item.classList.add('nav__item--active');
                    link.classList.add('nav__link--active');
                }
            });
            
            item.addEventListener('mouseleave', function() {
                if (window.innerWidth >= 1024) {
                    item.classList.remove('nav__item--active');
                    link.classList.remove('nav__link--active');
                }
            });
            
            // クリックイベント（モバイル・タブレット）
            link.addEventListener('click', function(e) {
                if (window.innerWidth < 1024) {
                    e.preventDefault();
                    const isActive = item.classList.contains('active');
                    
                    // 他のドロップダウンを閉じる
                    navItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                            const otherLink = otherItem.querySelector('.nav__link--dropdown');
                            if (otherLink) {
                                otherLink.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });
                    
                    // 現在のアイテムの状態を切り替え
                    if (isActive) {
                        item.classList.remove('active');
                        link.setAttribute('aria-expanded', 'false');
                    } else {
                        item.classList.add('active');
                        link.setAttribute('aria-expanded', 'true');
                    }
                }
            });
            
            // キーボードナビゲーション
            link.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const isActive = item.classList.contains('nav__item--active') || item.classList.contains('active');
                    
                    if (isActive) {
                        item.classList.remove('nav__item--active', 'active');
                        link.classList.remove('nav__link--active');
                        link.setAttribute('aria-expanded', 'false');
                    } else {
                        // 他のドロップダウンを閉じる
                        navItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                otherItem.classList.remove('nav__item--active', 'active');
                                const otherLink = otherItem.querySelector('.nav__link--dropdown');
                                if (otherLink) {
                                    otherLink.classList.remove('nav__link--active');
                                    otherLink.setAttribute('aria-expanded', 'false');
                                }
                            }
                        });
                        
                        item.classList.add(window.innerWidth >= 1024 ? 'nav__item--active' : 'active');
                        link.classList.add('nav__link--active');
                        link.setAttribute('aria-expanded', 'true');
                    }
                }
                
                if (e.key === 'Escape') {
                    item.classList.remove('nav__item--active', 'active');
                    link.classList.remove('nav__link--active');
                    link.setAttribute('aria-expanded', 'false');
                    link.focus();
                }
            });
        }
    });
    
    // 現在のページの判定とカレント状態の設定
    function setCurrentPage() {
        const currentPath = window.location.pathname;
        const currentPage = currentPath.split('/').pop() || 'index.html';
        
        navItems.forEach(item => {
            const link = item.querySelector('.nav__link');
            const href = link.getAttribute('href');
            
            // カレント状態の判定
            if (href && (currentPath.includes(href) || currentPage.includes(href.replace('/', '')))) {
                item.classList.add('nav__item--current');
                link.classList.add('nav__link--current');
            } else {
                item.classList.remove('nav__item--current');
                link.classList.remove('nav__link--current');
            }
        });
    }
    
    // ページ読み込み時にカレント状態を設定
    setCurrentPage();
    
    // ページ遷移時にカレント状態を更新
    window.addEventListener('popstate', setCurrentPage);
    
    // メニュー外をクリックしたら閉じる
    document.addEventListener('click', function(e) {
        if (!hamburgerButton.contains(e.target) && !nav.contains(e.target)) {
            hamburgerButton.setAttribute('aria-expanded', 'false');
            nav.classList.remove('active');
            document.body.style.overflow = '';
            
            // ドロップダウンも閉じる
            navItems.forEach(item => {
                item.classList.remove('active', 'nav__item--active');
                item.querySelector('.nav__link').classList.remove('nav__link--active');
            });
        }
    });
    
    // リサイズ時にメニューをリセット
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            hamburgerButton.setAttribute('aria-expanded', 'false');
            nav.classList.remove('active');
            document.body.style.overflow = '';
            navItems.forEach(item => {
                item.classList.remove('active', 'nav__item--active');
                item.querySelector('.nav__link').classList.remove('nav__link--active');
            });
        }
    });
    
    // ESCキーでメニューを閉じる
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && nav.classList.contains('active')) {
            hamburgerButton.setAttribute('aria-expanded', 'false');
            nav.classList.remove('active');
            document.body.style.overflow = '';
            hamburgerButton.focus();
        }
    });
}

/**
 * フォーカス管理
 */
function initFocusManagement() {
    // キーボードナビゲーション
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });
    
    // フォーカス可視性のスタイル
    const focusStyle = document.createElement('style');
    focusStyle.textContent = `
        .keyboard-navigation *:focus {
            outline: 2px solid var(--color-primary-500) !important;
            outline-offset: 2px !important;
        }
        
        .nav--open {
            display: block !important;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: var(--color-neutral-white);
            border-top: 1px solid var(--color-neutral-200);
            box-shadow: var(--shadow-lg);
            padding: var(--spacing-4);
        }
        
        .nav--open .nav__list {
            flex-direction: column;
            gap: var(--spacing-4);
        }
        
        .nav--open .nav__link {
            display: block;
            padding: var(--spacing-3) 0;
            border-bottom: 1px solid var(--color-neutral-200);
        }
    `;
    document.head.appendChild(focusStyle);
}

/**
 * ユーティリティ関数
 */

// デバウンス関数
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
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

// 要素がビューポート内にあるかチェック
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// パフォーマンス最適化
const optimizedScrollHandler = throttle(function() {
    // スクロールイベントの処理
}, 16); // 60fps

window.addEventListener('scroll', optimizedScrollHandler);

// リサイズイベントの最適化
const optimizedResizeHandler = debounce(function() {
    // リサイズイベントの処理
}, 250);

window.addEventListener('resize', optimizedResizeHandler);

/**
 * レスポンシブ画像切り替え機能
 * デバイス別に最適な画像を表示
 */
function initResponsiveImages() {
    const teamMembersImages = document.querySelectorAll('img[data-src="team-members"]');
    const careerPathImages = document.querySelectorAll('img[data-src="career-path"]');
    
    if (teamMembersImages.length === 0 && careerPathImages.length === 0) return;
    
    // 画像切り替え関数
    function updateImages() {
        const width = window.innerWidth;
        
        // メンバー画像の切り替え
        teamMembersImages.forEach(img => {
            let newSrc;
            
            if (width <= 768) {
                // モバイル
                newSrc = 'assets/images/team-members-sp.jpg';
            } else if (width <= 1024) {
                // タブレット
                newSrc = 'assets/images/team-members-tab.jpg';
            } else {
                // PC
                newSrc = 'assets/images/team-members-pc.jpg';
            }
            
            // 画像が変更される場合のみ更新
            if (img.src !== newSrc) {
                img.src = newSrc;
            }
        });
        
        // キャリアパス画像の切り替え
        careerPathImages.forEach(img => {
            let newSrc;
            
            if (width <= 768) {
                // モバイル
                newSrc = 'assets/images/career-path-sp.jpg';
            } else if (width <= 1024) {
                // タブレット
                newSrc = 'assets/images/career-path-tab.jpg';
            } else {
                // PC
                newSrc = 'assets/images/career-path-pc.jpg';
            }
            
            // 画像が変更される場合のみ更新
            if (img.src !== newSrc) {
                img.src = newSrc;
            }
        });
    }
    
    // 初期化
    updateImages();
    
    // リサイズ時に画像を更新
    window.addEventListener('resize', debounce(updateImages, 250));
}
