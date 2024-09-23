// Show the loading screen initially
document.getElementById('loadingScreen').style.display = 'flex';

// Hide the loading screen once the page has fully loaded
window.addEventListener('load', function() {
    document.getElementById('loadingScreen').classList.add('hidden');
});