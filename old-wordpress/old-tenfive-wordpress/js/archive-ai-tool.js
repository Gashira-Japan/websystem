<script>
document.addEventListener('DOMContentLoaded', function() {
    const tagButtons = document.querySelectorAll('.tag-btn');
    const cards = document.querySelectorAll('.card');

    tagButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            tagButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const selectedTag = this.dataset.tag;

            // Filter cards
            cards.forEach(card => {
                if (selectedTag === 'all') {
                    card.style.display = '';
                } else {
                    const cardTags = card.dataset.tags.split(' ');
                    card.style.display = cardTags.includes(selectedTag) ? '' : 'none';
                }
            });
        });
    });
});
</script>
