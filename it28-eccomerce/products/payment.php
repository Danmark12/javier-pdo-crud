<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment</title>
</head>
<body>

    <!-- Your HTML content for product display and cart -->

    <button class="btn btn-primary" onclick="makePayment()">Make Payment</button>

    <script>
        let cart = {}; // Assuming you have a cart object with items

        function makePayment() {
            // Calculate total amount based on items in the cart
            let totalAmount = calculateTotalAmount();
            
            // Here you would integrate with a payment gateway API
            // For this example, let's simulate a successful payment
            // Replace the URL with the actual payment gateway endpoint
            fetch('https://your-payment-gateway.com/api/process-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    totalAmount: totalAmount,
                    // Include other necessary payment details
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Payment successful!'); // Display success message
                    clearCart(); // Clear the cart after successful payment
                } else {
                    alert('Payment failed: ' + data.error); // Display error message
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your payment');
            });
        }

        function calculateTotalAmount() {
            // Calculate the total amount based on items in the cart
            let total = 0;
            for (const itemId in cart) {
                // Assuming each item has a price property
                total += cart[itemId].price * cart[itemId].quantity;
            }
            return total;
        }

        function clearCart() {
            // Clear the cart after successful payment
            cart = {};
            // Update the cart display or perform any other necessary actions
        }
    </script>

</body>
</html>
