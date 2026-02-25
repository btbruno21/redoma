function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('active');
    document.querySelector('.hamburger').classList.toggle('active');
}

function closeMenu() {
    document.getElementById('navLinks').classList.remove('active');
    document.querySelector('.hamburger').classList.remove('active');
}