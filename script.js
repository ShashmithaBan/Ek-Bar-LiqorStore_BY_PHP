document.addEventListener("DOMContentLoaded", function () {
    // Hide the preloader after 2 or 3 seconds
    setTimeout(function () {
        var preloader = document.getElementById("preloader");
        var header = document.getElementById("main-content");
        var navContainer = document.querySelector(".nav-container");

        // Check if the preloader, header, and navContainer elements exist
        if (preloader && header && navContainer) {
            preloader.style.opacity = "0";
            preloader.style.transition = "opacity 1s";

            // After the transition, hide the preloader
            setTimeout(function () {
                preloader.style.display = "none";
                
                // Show the header and navContainer
                header.style.display = "block";
                navContainer.style.display = "block";
            }, 500); // 1s transition time
        }
    }, 4000); // Adjust the time according to your needs
});