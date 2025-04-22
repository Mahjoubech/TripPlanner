// Profile AJAX Handler
class ProfileHandler {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        this.loadRecentActivities();
        this.loadUpcomingTrips();

        setInterval(() => this.loadRecentActivities(), 30000); // Refresh every 30 seconds
        setInterval(() => this.loadUpcomingTrips(), 60000); // Refresh every minute
    }

    async loadRecentActivities() {
        try {
            const response = await fetch('/api/profile/activities', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            this.updateActivitiesSection(data);
        } catch (error) {
            console.error('Error loading activities:', error);
        }
    }

    async loadUpcomingTrips() {
        try {
            const response = await fetch('/api/profile/trips', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            this.updateTripsSection(data);
        } catch (error) {
            console.error('Error loading trips:', error);
        }
    }

    updateActivitiesSection(activities) {
        const activitiesContainer = document.getElementById('recent-activities');
        if (!activitiesContainer) return;

        if (activities.length === 0) {
            activitiesContainer.innerHTML = '<p class="text-gray-500">No recent activity</p>';
            return;
        }

        const activitiesHTML = activities.map(activity => `
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-history text-blue-500"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">${activity.description}</p>
                    <p class="text-xs text-gray-400">${activity.created_at}</p>
                </div>
            </div>
        `).join('');

        activitiesContainer.innerHTML = activitiesHTML;
    }

    updateTripsSection(trips) {
        const tripsContainer = document.getElementById('upcoming-trips');
        if (!tripsContainer) return;

        if (trips.length === 0) {
            tripsContainer.innerHTML = '<p class="text-gray-500">No upcoming trips</p>';
            return;
        }

        const tripsHTML = trips.map(trip => `
            <div class="border rounded-lg p-4">
                <h3 class="font-medium">${trip.destination}</h3>
                <p class="text-sm text-gray-600">${trip.start_date} - ${trip.end_date}</p>
            </div>
        `).join('');

        tripsContainer.innerHTML = tripsHTML;
    }
}

// Initialize the profile handler when the document is ready
document.addEventListener('DOMContentLoaded', () => {
    new ProfileHandler();
}); 