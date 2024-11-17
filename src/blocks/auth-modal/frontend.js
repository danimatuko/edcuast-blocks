import { submitSignupForm, submitSigninForm } from './formHandler';

document.addEventListener('DOMContentLoaded', () => {
    const modalTriggers = document.querySelectorAll('.open-modal');
    const modal = document.querySelector('.wp-block-udemy-plus-auth-modal');
    const closeButton = document.querySelector('.modal-btn-close');
    const tabs = document.querySelectorAll(".tabs a");
    const signinForm = document.querySelector("#signin-tab");
    const signupForm = document.querySelector("#signup-tab");

    const openModal = () => {
        if (modal) {
            modal.style.display = 'block';
            modal.setAttribute('aria-hidden', 'false');
            closeButton.focus();
        }
    };

    const closeModal = () => {
        if (modal) {
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');
            modalTriggers[0]?.focus();
        }
    };

    modalTriggers.forEach(trigger => trigger.addEventListener('click', openModal));
    closeButton?.addEventListener('click', closeModal);

    const highlightActiveTab = (tab) => {
        tabs.forEach(t => t.classList.remove('active-tab'));
        tab.classList.add('active-tab');
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', e => {
            e.preventDefault();
            highlightActiveTab(e.target);
            const activeTab = e.target.getAttribute('href');
            signinForm.style.display = activeTab === '#signin-tab' ? 'block' : 'none';
            signupForm.style.display = activeTab === '#signup-tab' ? 'block' : 'none';
        });
    });

    // Function to show success or error messages
    const showMessage = (message, isSuccess = true) => {
        const signupStatusDiv = document.querySelector('#auth-status');
        const messageHTML = `
            <div class="mb-4 text-white p-5 ${isSuccess ? 'bg-green-500' : 'bg-red-500'} rounded">
                 ${message}
            </div>
        `;
        signupStatusDiv.innerHTML = messageHTML;
    };

    // Handle signup form submission
    signupForm?.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the form from submitting normally

        // Extract form data
        const data = {
            email: document.getElementById('su-email').value,
            username: document.getElementById('su-name').value,
            password: document.getElementById('su-password').value
        };

        // Call the form handling function with the extracted data
        submitSignupForm(data)
            .then(response => {
                // Show success message if the response indicates success
                showMessage(response.message, response.success);

                // Reset the form if signup was successful
                if (response.success) {
                    signupForm.reset();
                    location.reload();
                }
            })
            .catch(error => {
                // Display an error message if the request fails
                showMessage(error.message || 'An unexpected error occurred.', false);
            });
    });


    // Handle signup form submission
    signinForm?.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the form from submitting normally

        // Extract form data
        const data = {
            username: document.getElementById('si-email').value,
            password: document.getElementById('si-password').value
        };

        // Call the form handling function with the extracted data
        submitSigninForm(data)
            .then(response => {
                // Show success message if the response indicates success
                showMessage(response.message, response.success);

                // Reset the form if signup was successful
                if (response.success) {
                    signinForm.reset();
                    location.reload();
                }
            })
            .catch(error => {
                // Display an error message if the request fails
                showMessage(error.message || 'An unexpected error occurred.', false);
            });
    });

});

