
export function submitSignupForm(data) {
    return fetch('/wp-json/edb/v1/signup', { // Replace with the actual endpoint path if needed
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                return { success: true, message: 'Thank you for signing up! Your registration has been received.' };
            } else {
                return { success: false, message: data.message || 'An error occurred during signup.' };
            }
        })
        .catch(error => {
            return { success: false, message: error.message || 'An error occurred while connecting to the server.' };
        });
}
