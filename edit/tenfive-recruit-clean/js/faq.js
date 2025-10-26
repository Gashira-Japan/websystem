/**
 * FAQ アコーディオン機能
 */

document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    console.log('FAQ初期化:', faqQuestions.length + '個のFAQアイテムが見つかりました');
    
    faqQuestions.forEach((question, index) => {
        question.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            const answer = this.nextElementSibling;
            const icon = this.querySelector('.faq-question__icon');
            
            console.log(`FAQ ${index + 1} クリック:`, isExpanded ? '開く→閉じる' : '閉じる→開く');
            
            // 全てのFAQアイテムを閉じる
            faqQuestions.forEach(q => {
                q.setAttribute('aria-expanded', 'false');
                q.nextElementSibling.setAttribute('aria-hidden', 'true');
                q.nextElementSibling.style.maxHeight = '0';
                const qIcon = q.querySelector('.faq-question__icon');
                if (qIcon) {
                    qIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            // クリックされたアイテムが閉じていた場合は開く
            if (!isExpanded) {
                this.setAttribute('aria-expanded', 'true');
                answer.setAttribute('aria-hidden', 'false');
                // コンテンツの高さを計算してアニメーション
                answer.style.maxHeight = answer.scrollHeight + 'px';
                if (icon) {
                    icon.style.transform = 'rotate(45deg)';
                }
                console.log(`FAQ ${index + 1} を開きました。高さ:`, answer.scrollHeight + 'px');
            }
        });
    });
});
