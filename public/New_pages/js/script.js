const bannerSlides = document.querySelectorAll('.banner-slide');
let currentSlide = 0;

function showSlide(n) {
    bannerSlides[currentSlide].classList.remove('active');
    currentSlide = (n + bannerSlides.length) % bannerSlides.length;
    bannerSlides[currentSlide].classList.add('active');
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

window.onload=function(){

    showSlide(0);
}
setInterval(nextSlide, 5000);




// Sélectionner l'icône du menu et la sidebar
const menuIcon = document.getElementById('menu-icon');
const sidebar = document.getElementById('sidebar');

// Ajouter un événement de clic à l'icône du menu
menuIcon.addEventListener('click', () => {
    // Vérifier si la sidebar est visible
    if (sidebar.style.left === '0px') {
        // Si oui, la cacher
        sidebar.style.left = '-250px';
        document.querySelector('.main-content').style.marginLeft = '0';
    } else {
        // Sinon, la montrer
        sidebar.style.left = '0';
        document.querySelector('.main-content').style.marginLeft = '250px';
    }
});
