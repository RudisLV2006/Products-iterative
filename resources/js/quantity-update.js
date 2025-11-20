document.addEventListener('DOMContentLoaded', function () {
    // Poga + un -
    document.querySelectorAll('.quantity-buttons button').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Novērš formu sūtīšanu

            // Pārliecināmies, ka `data-id` tiek pareizi iegūts
            var form = button.closest('form'); // Atrodam formu, kurā ir poga
            var productId = form ? form.dataset.id : undefined; // Iegūstam `data-id` no formas

            // Ja produkta ID nav definēts, izdrukājam kļūdu
            if (!productId) {
                console.error('Product ID is not defined!');
                return; // Ja nav ID, pārtraucam izpildi
            }

            var action = button.textContent === '+' ? 'increase' : 'decrease';

            // Nosūtām AJAX pieprasījumu uz serveri
            fetch('/product/' + productId + '/' + action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Pārbaudiet, kas tiek atgriezts
                if (data.success) {
                    // Atjaunojam daudzumu tabulā
                    document.querySelector('.quantity[data-id="' + productId + '"]').textContent = data.quantity;
                } else {
                    alert('Kļūda! Daudzums netika atjaunots.');
                }
            })
            .catch(error => {
                console.error('Error:', error); // Logojiet kļūdu
                alert('Kļūda! Mēģiniet vēlreiz.');
            });
        });
    });
});
