// Smooth Scroll to Top
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Show "Back to Top" button on scroll
window.onscroll = function() {
    document.getElementById("topBtn").style.display = window.scrollY > 300 ? "block" : "none";
};

