// Main application JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Ticket date validation
    const dateInput = document.getElementById('visit-date');
    if (dateInput) {
        // Set minimum date to today
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');

        dateInput.min = `${yyyy}-${mm}-${dd}`;

        // Optional: Set maximum date (e.g., 3 months from now)
        const maxDate = new Date();
        maxDate.setMonth(maxDate.getMonth() + 3);
        const maxYyyy = maxDate.getFullYear();
        const maxMm = String(maxDate.getMonth() + 1).padStart(2, '0');
        const maxDd = String(maxDate.getDate()).padStart(2, '0');

        dateInput.max = `${maxYyyy}-${maxMm}-${maxDd}`;
    }

    // Mobile menu toggle functionality could be added here if needed
});

// Ticket quantity functions
function increaseQuantity(element) {
    const input = element.previousElementSibling;
    input.value = parseInt(input.value) + 1;
    updateTotals();
}

function decreaseQuantity(element) {
    const input = element.nextElementSibling;
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
        updateTotals();
    }
}

function updateTotals() {
    const tickets = document.querySelectorAll('.ticket-item');
    let subtotal = 0;

    tickets.forEach(ticket => {
        const priceText = ticket.querySelector('.ticket-price').textContent;
        const price = parseInt(priceText.replace('Rp ', '').replace('.', ''));
        const quantity = parseInt(ticket.querySelector('.quantity-input').value);
        subtotal += price * quantity;
    });

    const subtotalElement = document.querySelector('.subtotal span:last-child');
    const totalElement = document.querySelector('.total span:last-child');

    if (subtotalElement && totalElement) {
        subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
        totalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    }
}
