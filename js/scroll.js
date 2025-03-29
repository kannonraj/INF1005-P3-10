// Scroll event handler
window.onscroll = function () {
    toggleScrollButton();
};

// Function to toggle the visibility of the scroll button
function toggleScrollButton() {
    const scrollButton = document.getElementById("scrollToTopBtn");

    // Check if the user has scrolled down more than halfway of the page
    if (document.body.scrollTop > window.innerHeight / 2 || document.documentElement.scrollTop > window.innerHeight / 2) {
        scrollButton.classList.add("show"); // Show the button
    } else {
        scrollButton.classList.remove("show"); // Hide the button
    }
}

// Function to scroll to the top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll behavior
    });
}
