let slideIndex = 0;

function updateSlider() {
    const slider = document.querySelector('.slider');
    const totalSlides = document.querySelectorAll('.partenaire').length;
    const visibleSlides = 3;

    if (slideIndex > totalSlides - visibleSlides) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = totalSlides - visibleSlides;
    }

    slider.style.transform = `translateX(-${slideIndex * (100 / visibleSlides)}%)`;
}

function prevSlide() {
    slideIndex--;
    updateSlider();
}

function nextSlide() {
    slideIndex++;
    updateSlider();
}