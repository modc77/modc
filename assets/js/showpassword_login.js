const passwordInput = document.getElementById('passwordInput');
const showPasswordIcon = document.getElementById('showPasswordIcon');

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
