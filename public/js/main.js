
document.addEventListener("DOMContentLoaded", function () {
   

    
    const tabButtons = document.querySelectorAll('.trip-tab');
    const tabContents = document.querySelectorAll('.trip-content');

    if (tabButtons.length > 0 && tabContents.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const selectedTab = button.getAttribute('data-tab');

                // Update Tab Active Styles
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent');
                });
                button.classList.add('border-blue-600', 'text-blue-600');
                button.classList.remove('border-transparent');

                // Show Correct Content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                const activeContent = document.getElementById(`${selectedTab}-trips-content`);
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                }
            });
        });
    }
});