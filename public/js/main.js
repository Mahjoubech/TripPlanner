document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll('.trip-tab');
    const tabContents = document.querySelectorAll('.trip-content');

    function loadTrips(type) {
        const contentDiv = document.getElementById(`${type}-trips-content`);
        if (!contentDiv) {
            console.error(`Content div not found for type: ${type}`);
            return;
        }

        contentDiv.innerHTML = '<div class="flex justify-center items-center h-32"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div></div>';

        fetch(`/organizer/trips/fetch?type=${type}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // Debug log
            if (data.success) {
                contentDiv.innerHTML = data.html;
            } else {
                contentDiv.innerHTML = '<div class="text-center text-red-500 py-4">' + (data.message || 'No trips found') + '</div>';
            }
        })
        .catch(error => {
            console.error('Error loading trips:', error);
            contentDiv.innerHTML = '<div class="text-center text-red-500 py-4">Error loading trips: ' + error.message + '</div>';
        });
    }

    if (tabButtons.length > 0 && tabContents.length > 0) {
        // Load initial trips for the active tab
        const activeTab = document.querySelector('.trip-tab[data-tab]');
        if (activeTab) {
            loadTrips(activeTab.getAttribute('data-tab'));
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const selectedTab = button.getAttribute('data-tab');
                console.log('Selected tab:', selectedTab); // Debug log

                // Update Tab Active Styles
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                button.classList.add('border-blue-600', 'text-blue-600');
                button.classList.remove('border-transparent', 'text-gray-500');

                // Show Correct Content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.scrollTop = 0;
                });

                const activeContent = document.getElementById(`${selectedTab}-trips-content`);
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                    // Load trips for the selected tab
                    loadTrips(selectedTab);
                } else {
                    console.error(`Content div not found for tab: ${selectedTab}`);
                }
            });
        });

        // Add scroll event listeners to handle scrollbar visibility
        tabContents.forEach(content => {
            content.addEventListener('scroll', function() {
                if (this.scrollTop > 0) {
                    this.classList.add('shadow-inner');
                } else {
                    this.classList.remove('shadow-inner');
                }
            });
        });
    }
});