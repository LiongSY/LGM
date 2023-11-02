document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector(".carousel");
    const images = document.querySelectorAll(".carousel img");
    const logoCarousel = document.querySelector(".logo-carousel");
    const logoImages = document.querySelectorAll(".logo-carousel img");
    let currentIndex = 0;
    const slideInterval = 5000; // 5 seconds

    function nextSlide() {
        images[currentIndex].style.transform = "translateX(-100%)";
        logoImages[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].style.transform = "translateX(0)";
        logoImages[currentIndex].classList.add("active");
    }

    // Initialize the first image as active
    images[currentIndex].style.transform = "translateX(0)";
    logoImages[currentIndex].classList.add("active");

    setInterval(nextSlide, slideInterval);
});
