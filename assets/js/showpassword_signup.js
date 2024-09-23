const passwordInput = document.getElementById('passwordInput');
const confirmPasswordInput = document.getElementById('confirmpasswordInput');
const showPasswordIcon = document.getElementById('showPasswordIcon');
const showConfirmPasswordIcon = document.getElementById('showConfirmPasswordIcon');

showPasswordIcon.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Change the icon depending on the type
    if (type === 'text') {
        showPasswordIcon.src = 'assets/icon/eye-crossed.svg'; // Switch to eye-crossed icon
    } else {
        showPasswordIcon.src = 'assets/icon/eye.svg'; // Switch back to eye icon
    }
});

showConfirmPasswordIcon.addEventListener('click', function() {
    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordInput.setAttribute('type', type);

    // Change the icon depending on the type
    if (type === 'text') {
        showConfirmPasswordIcon.src = 'assets/icon/eye-crossed.svg'; // Switch to eye-crossed icon
    } else {
        showConfirmPasswordIcon.src = 'assets/icon/eye.svg'; // Switch back to eye icon
    }
});
