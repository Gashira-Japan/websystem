document.addEventListener('DOMContentLoaded', function() {
    // GSAPの初期化
    gsap.registerPlugin(ScrollTrigger);

    // ヒーローセクションのアニメーション
    gsap.from('.hero-content', {
        duration: 1,
        y: 30,
        opacity: 0,
        ease: 'power3.out'
    });

    // 統計カードのアニメーション
    gsap.from('.stat-card', {
        scrollTrigger: {
            trigger: '.stats-grid',
            start: 'top center+=100'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2,
        ease: 'power3.out'
    });

    // サポートカードのアニメーション
    gsap.from('.support-card', {
        scrollTrigger: {
            trigger: '.support-grid',
            start: 'top center+=100'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.3,
        ease: 'power3.out'
    });

    // タブ切り替え
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // アクティブなタブボタンを設定
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // タブコンテンツの切り替え
            const targetId = button.getAttribute('data-tab');
            tabContents.forEach(content => {
                content.classList.add('hidden');
                if (content.id === `${targetId}-form`) {
                    content.classList.remove('hidden');
                    // コンテンツ表示時のアニメーション
                    gsap.from(content, {
                        duration: 0.5,
                        y: 20,
                        opacity: 0,
                        ease: 'power2.out'
                    });
                }
            });
        });
    });

    // スクロールアニメーション（フェードアップ）
    gsap.utils.toArray('.animate-fade-up').forEach(element => {
        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top center+=100',
                toggleActions: 'play none none reverse'
            },
            duration: 0.8,
            y: 30,
            opacity: 0,
            ease: 'power3.out'
        });
    });
});

// ヒーローメニューパーティクル
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("particleCanvas");
    const ctx = canvas.getContext("2d");
    const particles = [];
    const colors = "rgba(0, 102, 179, 0.5)";
    const dpr = window.devicePixelRatio || 1;
    let animationFrameId; // アニメーションフレームIDを保持

    // デバイスの画面幅と高さに合わせてキャンバスをリサイズ
    function resizeCanvas() {
        canvas.width = window.innerWidth * dpr;
        canvas.height = window.innerHeight * dpr;
        ctx.scale(dpr, dpr);
        initParticles(); // パーティクルの初期化
    }

    // パーティクルの初期化
    function initParticles() {
        particles.length = 0; // 既存のパーティクルをクリア
        for (let i = 0; i < 100; i++) {
            particles.push({
                x: Math.random() * canvas.width / dpr,
                y: Math.random() * canvas.height / dpr,
                vx: (Math.random() - 0.5) * 1,
                vy: (Math.random() - 0.5) * 1,
                size: Math.random() * 5 + 1,
            });
        }
    }

    // パーティクルの更新
    function updateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach((p) => {
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > canvas.width / dpr) p.vx *= -1;
            if (p.y < 0 || p.y > canvas.height / dpr) p.vy *= -1;
            ctx.fillStyle = colors;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
        });
        animationFrameId = requestAnimationFrame(updateParticles);
    }

    // 初期描画とリサイズイベント設定
    function startAnimation() {
        if (animationFrameId) cancelAnimationFrame(animationFrameId); // 重複を防ぐ
        resizeCanvas();
        updateParticles();
    }

    startAnimation();
    window.addEventListener("resize", startAnimation);
});
