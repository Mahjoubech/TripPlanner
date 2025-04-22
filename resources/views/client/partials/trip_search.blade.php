<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="p-4">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-3 h-5 w-5 text-gray-400"></i>
            <input type="text" 
                   id="tripSearch" 
                   placeholder="Search for trips..." 
                   class="pl-10 w-full rounded-md border border-gray-300 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                   onkeyup="searchTrips(this.value)">
        </div>
       
    </div>
</div>

@push('scripts')
<script>
function searchTrips(query) {
    const tripCards = document.querySelectorAll('.trip-card');
    const searchTerm = query.toLowerCase();

    tripCards.forEach(card => {
        const title = card.querySelector('.trip-title').textContent.toLowerCase();
        const description = card.querySelector('.trip-description').textContent.toLowerCase();
        const location = card.querySelector('.trip-location').textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm) || location.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterTrips(status) {
    const buttons = document.querySelectorAll('.filter-button');
    buttons.forEach(btn => {
        btn.classList.remove('text-blue-600', 'bg-blue-50');
        btn.classList.add('text-gray-600', 'bg-gray-50');
    });

    const activeButton = event.target;
    activeButton.classList.remove('text-gray-600', 'bg-gray-50');
    activeButton.classList.add('text-blue-600', 'bg-blue-50');

    // Show loading state
    const tripContainer = document.getElementById('tripContainer');
    tripContainer.innerHTML = '<div class="flex justify-center items-center h-32"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';

    // Fetch trips based on status
    fetch(`/client/trips/fetch?type=${status}`, {
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
        if (data.success) {
            tripContainer.innerHTML = data.html;
        } else {
            tripContainer.innerHTML = `<div class="text-center text-gray-500">${data.message}</div>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        tripContainer.innerHTML = '<div class="text-center text-red-500">Error loading trips</div>';
    });
}
</script>
@endpush