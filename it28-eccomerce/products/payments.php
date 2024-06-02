<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Payment</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                transition: 0.3s;
                width: 100%;
                border-radius: 5px;
                background-color: #f6f6f6;
                margin-top: 20px;
            }
            .card-header {
                background-color: #007bff;
                color: white;
                padding: 10px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }
            .card-body {
                padding: 20px;
            }
        </style>
    </head>
    <body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Shopping Details
                    </div>
                    <div class="card-body">
                        <!-- Display the shopping cart information here -->
                        <div id="cartContainer">
                            <h3>Shopping Cart</h3>
                            <div id="cartItems">
                                <!-- Cart items will be displayed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <form id="paymentForm" action="pments.php" method="POST">
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                            </div>
                            
                            <div id="creditCardFields">
                                <div class="form-group">
                                    <label for="cardholder_name">Cardholder Name</label>
                                    <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="card_number">Card Number</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number" required>
                                </div>
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                                </div>
                            </div>

                            <input type="hidden" name="amount" value="1000"> <!-- Example amount, replace with your actual amount logic -->
                            <input type="hidden" name="status" value="Pending">
                            <input type="hidden" name="udetails_id" value="123"> <!-- Example user ID, replace with your actual user ID logic -->
                            <input type="hidden" name="shopping_cart" value="[]"> <!-- Example cart data, replace with your actual cart data logic -->

                            <button type="submit" class="btn btn-primary" id="submitPaymentBtn">Submit Payment</button>
                        </form>
                        <!-- Success message -->
                        <div id="successMessage" style="display: none;" class="alert alert-success" role="alert">
                            Payment Successful!
                        </div>
                        <!-- Button to go back to homepage -->
                        
                        <button id="goToHomeBtn" style="display: none;" class="btn btn-primary" onclick="goToHome()">Go Back to Homepage</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Retrieve cart data from localStorage
    const cartData = localStorage.getItem('cart');
    if (cartData) {
        const cart = JSON.parse(cartData);
        displayCart(cart);
    }

    function displayCart(cart) {
        const cartItems = document.getElementById('cartItems');
        let showCardHTML = '';
        let totalAmount = 0;
        for (const item of Object.values(cart)) {
            showCardHTML += `<p>Quantity: ${item.quantity}, Price: ₱${item.price}, Total Price: ₱${item.totalPrice}</p>`;
            totalAmount += item.totalPrice;
        }
        showCardHTML += `<p>Total Amount: ₱${totalAmount}</p>`;
        cartItems.innerHTML = showCardHTML;
    }

    // Add event listener to submit payment button
    document.getElementById('submitPaymentBtn').addEventListener('click', function(event) {
        // Prevent form submission
        event.preventDefault();

        // Get the form element
        const form = document.getElementById('paymentForm');

        // Create a new FormData object from the form
        const formData = new FormData(form);

        // Add the cart data from localStorage to the formData object
        const cartData = localStorage.getItem('cart');
        if (cartData) {
            formData.append('shopping_cart', cartData);
        }

        // Send an asynchronous POST request to the server
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Display success message
                document.getElementById('successMessage').style.display = 'block';

                // Hide payment form
                form.style.display = 'none';

                // Show button to go back to homepage
                document.getElementById('goToHomeBtn').style.display = 'block';
            } else {
                // If there is an error, alert the user
                alert('Payment Failed. Please try again.');
            }
        })
        .catch(error => {
            // If there is an error, alert the user
            alert('An error occurred. Please try again later.');
            console.error('Error:', error);
        });
    });

    // Function to go back to homepage
    function goToHome() {
        console.log("Button clicked. Redirecting to homepage...");
        window.location.href = '../index.php'; // Replace 'index.php' with your actual home product page URL
    }
</script>


    </body>
    </html>
<!-- ------------------------------------ -->