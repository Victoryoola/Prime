document.addEventListener('DOMContentLoaded', function () {
    // Check if there is an 'error' or 'success' parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('error')) {
        // Display SweetAlert with error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: urlParams.get('error'),
        });
    }

    if (urlParams.has('success')) {
        // Display SweetAlert with success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: urlParams.get('success'),
        });
    }
});