let slideIndex = 0;

function updateSlider() {
    const slider = document.querySelector('.slider');
    const totalSlides = document.querySelectorAll('.partenaire').length;
    let visibleSlides = 3; // Par défaut, affiche 3 éléments sur PC

    // Ajuster le nombre d'éléments visibles sur mobile
    if (window.innerWidth <= 768) {
        visibleSlides = 1;
    }

    console.log("slideIndex avant ajustement:", slideIndex);
    console.log("visibleSlides:", visibleSlides);
    console.log("totalSlides:", totalSlides);

    // Logique pour PC
    if (visibleSlides === 3) {
        if (slideIndex > totalSlides - visibleSlides) {
            slideIndex = 0;
        } else if (slideIndex < 0) {
            slideIndex = totalSlides - visibleSlides;
        }
        slider.style.transform = `translateX(-${slideIndex * (100 / visibleSlides)}%)`;
    }
    // Logique pour mobile
    else {
        if (slideIndex >= totalSlides) {
            slideIndex = 0;
        } else if (slideIndex < 0) {
            slideIndex = totalSlides - 1;
        }
        slider.style.transform = `translateX(-${slideIndex * 100/3}%)`; //c'est la le décalage random
    }

    console.log("slideIndex après ajustement:", slideIndex);
    console.log("Transformation appliquée:", slider.style.transform);
}

function prevSlide() {
    if (window.innerWidth <= 768) {
        slideIndex--;
    } else {
        slideIndex -= 3;
    }
    updateSlider();
}

function nextSlide() {
    if (window.innerWidth <= 768) {
        slideIndex++;
    } else {
        slideIndex += 3;
    }
    updateSlider();
}

// Initialiser le slider au chargement de la page
window.addEventListener('load', () => {
    updateSlider();
});

// Mettre à jour le slider lors du redimensionnement de la fenêtre
window.addEventListener('resize', () => {
    updateSlider();
});
