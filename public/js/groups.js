document.getElementById("myForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent form submission
    document.getElementById("popup").style.display = "block";
});

document.getElementById("closePopupBtn").addEventListener("click", function() {
    document.getElementById("popup").style.display = "none";
});
