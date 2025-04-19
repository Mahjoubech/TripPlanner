
document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Toast notification function
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

    // Show and hide loading spinner
    function showLoading() {
        const spinner = document.getElementById('loading-spinner');
        spinner.classList.remove('hidden');
        spinner.classList.add('flex');
    }

    function hideLoading() {
        const spinner = document.getElementById('loading-spinner');
        spinner.classList.remove('flex');
        spinner.classList.add('hidden');
    }

    // AJAX form submission
    document.querySelectorAll('form[data-ajax="true"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            // Clear previous errors
            form.querySelectorAll('.error-message').forEach(el => el.remove());
            form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));

            const formData = new FormData(form);

            const requestOptions = {
                method: form.getAttribute('method') || 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: formData
            };

            submitBtn.disabled = true;
            submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i>Processing...`;

            fetch(form.getAttribute('action'), requestOptions)
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw errorData;
                        });
                    }
                    return response.json();
                })
                .then(response => {
                    if (response.message) {
                        showToast(response.message, 'success');
                    }

                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }

                    // Trigger success event
                    const successEvent = new CustomEvent('ajaxSuccess', { detail: response });
                    form.dispatchEvent(successEvent);
                })
                .catch(error => {
                    if (error.errors) {
                        Object.keys(error.errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                                const errorMessage = document.createElement('span');
                                errorMessage.className = 'error-message text-red-500 text-sm';
                                errorMessage.textContent = error.errors[field][0];
                                input.parentNode.insertBefore(errorMessage, input.nextSibling);
                            }
                        });
                        showToast('Please check the form for errors', 'error');
                    } else {
                        showToast(error.message || 'An error occurred', 'error');
                    }

                    // Trigger error event
                    const errorEvent = new CustomEvent('ajaxError', { detail: error });
                    form.dispatchEvent(errorEvent);
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
        });
    });


    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const responsiveNav = document.getElementById('responsive-nav');

    mobileMenuButton?.addEventListener('click', function () {
        console.log("Menu button clicked");
        responsiveNav.classList.toggle('hidden');
    });

    const tabButtons = document.querySelectorAll('.trip-tab');
    const tabContents = document.querySelectorAll('.trip-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const selectedTab = button.getAttribute('data-tab');

            // Update tab active styles
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-600', 'text-blue-600');
                btn.classList.add('border-transparent');
            });
            button.classList.add('border-blue-600', 'text-blue-600');
            button.classList.remove('border-transparent');

            // Show correct content
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            const activeContent = document.getElementById(`${selectedTab}-trips-content`);
            if (activeContent) {
                activeContent.classList.remove('hidden');
            }
        });
    });
});