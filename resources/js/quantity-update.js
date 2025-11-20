// Select all quantity buttons (increase and decrease forms)
document.querySelectorAll(".quantity-buttons form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(form); // Create FormData object from the form

        // Send the form data via fetch
        fetch(form.action, {
            method: "POST",
            body: formData, // FormData includes the CSRF token automatically
        })
            .then((response) => response.json())
            .then((data) => {
                // Handle the response (e.g., update quantity displayed in the UI)
                if (data.success) {
                    const quantitySpan = document.querySelector(
                        '.quantity[data-id="' + form.dataset.id + '"]'
                    );
                    quantitySpan.textContent = data.quantity; // Update the displayed quantity
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
