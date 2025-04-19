@if (session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast("{{ session('message') }}", "{{ session('type', 'success') }}");
        });
    </script>
@endif

<div id="toast-container" class="fixed top-5 right-5 z-50"> </div>

<script>

    function showToast(message, type = 'success') {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-times-circle',
            warning: 'fa-exclamation-circle',
            info: 'fa-info-circle'
        };

        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };

        const toast = document.createElement('div');
        toast.className = `toast flex items-center p-4 mb-3 text-white rounded-lg shadow-lg ${colors[type]}`;
        toast.innerHTML = `<i class="fas ${icons[type]} mr-2"></i><span>${message}</span>`;

        const toastContainer = document.getElementById('toast-container');
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }   

</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">