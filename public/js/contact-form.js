document.addEventListener('DOMContentLoaded', function() {
    const dateButton = document.getElementById('dateButton');
    const dateInput = document.getElementById('dateInput');
    
    // Function to trigger date selection from the hidden input
    function triggerDateSelection() {
        dateInput.showPicker();
        console.log("input clicked");
    }
    
    // Function to update button text with selected date value
    function updateButtonText() {
        dateButton.textContent = dateInput.value;
        dateButton.classList.add('font-semibold');
    }
    
    // Event listener for button click to trigger date selection
    dateButton.addEventListener('click', function() {
        triggerDateSelection();
    });
    
    // Event listener for input change to update button text
    dateInput.addEventListener('change', function() {
        updateButtonText();
    });
});