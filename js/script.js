// Toggle animasi menu jika diperlukan
console.log("JavaScript terhubung!");
// Toggle class active untuk hamburger menu
const navbarNav = document.querySelector('.navbar-nav');
const hamburger = document.querySelector('#hamburger-menu');

// Ketika hamburger menu di klik
hamburger.onclick = () => {
    navbarNav.classList.toggle('active');
};

// Klik di luar hamburger dan navbar untuk menghilangkan menu
document.addEventListener('click', function(e) {
    if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove('active');
    }
});
function toggleDropdown(event) {
    event.stopPropagation(); // Prevent the click from bubbling up
    document.getElementById("dropdownMenu").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('#account') && !event.target.matches('.dropdown-content')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}