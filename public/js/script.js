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


$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});

function incrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

    if (!isNaN(currentVal)) {
        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(0);
    }
}


