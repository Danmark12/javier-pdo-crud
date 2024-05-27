<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Include Bootstrap CSS and Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Inline CSS for styling -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .navbar-brand img {
            width: 40px;
        }
        .payment-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .payment-details {
            display: none;
        }
        .payment-container .payment-details:first-child {
            display: block;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary, .btn-success {
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }
        .footer p {
            margin: 0;
            color: #6c757d;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Bootstrap
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container mt-5">
    <div class="card payment-container">
        <!-- User Details Section -->
        <h2>User Details</h2>
        <div class="form-group">
            <label for="user_name">Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required>
        </div>
        <div class="form-group">
            <label for="user_address">Address</label>
            <textarea class="form-control" id="user_address" name="user_address" rows="3" required></textarea>
        </div>
        <hr>

        <!-- Payment method selection -->
        <h2>Select Payment Method</h2>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select class="form-control" id="payment_method" name="payment_method" onchange="togglePaymentDetails()">
                <option value="credit_card">Credit Card</option>
                <option value="gcash">GCash</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        <!-- Credit Card Payment Details -->
         <div id="credit_card_details" class="payment-details">
            <h3>Credit Card Details</h3>
            <div class="form-group">
                <label for="cardholder_name">Cardholder Name</label>
                <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" required>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiration Date</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="password" class="form-control" id="cvv" name="cvv" maxlength="3" required>
            </div>
            <button class="btn btn-primary" onclick="confirmPayment()">Pay Now</button>
        </div>
    </div>


        <!-- GCash Payment Details -->
        <div id="gcash_details" class="payment-details" style="display: none;">
            <h3>GCash Details</h3>
            <p>Please transfer the total amount to the following GCash number:</p>
            <p>GCash Number: 09123456789</p>
            <p>Once payment is made, enter the confirmation code below and click "Confirm Payment":</p>
            <div class="form-group">
                <label for="gcash_confirmation_code">Confirmation Code</label>
                <input type="text" class="form-control" id="gcash_confirmation_code" name="gcash_confirmation_code" required>
            </div>
            <button class="btn btn-primary" onclick="confirmPayment()">Confirm Payment</button>
        </div>

        <!-- PayPal Payment Details -->
        <div id="paypal_details" class="payment-details" style="display: none;">
            <h3>PayPal Details</h3>
            <p>Please transfer the total amount to the following PayPal account:</p>
            <p>PayPal Email: danmarkpetalcurin@gmail.com</p>
            <p>Once payment is made, enter the confirmation code below and click "Confirm Payment":</p>
            <div class="form-group">
                <label for="paypal_confirmation_code">Confirmation Code</label>
                <input type="text" class="form-control" id="paypal_confirmation_code" name="paypal_confirmation_code" required>
            </div>
            <button class="btn btn-primary" onclick="confirmPayment()">Confirm Payment</button>
        </div>

        <!-- Success Message -->
        <div id="success_message" class="payment-details" style="display: none;">
            <h3>Payment Successful!</h3>
            <p>Your payment has been processed successfully.</p>
            <button class="btn btn-primary" onclick="returnToIndex()">Back to Home</button>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 DanDev Shop. All rights reserved.</p>
    </div>
</footer>

<script>
    // Function to toggle display of payment details based on selected payment method
    function togglePaymentDetails() {
        const paymentMethod = document.getElementById('payment_method').value;
        const paymentDetails = document.querySelectorAll('.payment-details');

        // Hide all payment details sections
        paymentDetails.forEach(details => {
            details.style.display = 'none';
        });

        // Show payment details section based on selected payment method
        document
        // Show payment details section based on selected payment method
        document.getElementById(`${paymentMethod}_details`).style.display = 'block';
    }

    // Function to confirm payment and show success message
    function confirmPayment() {
        // Get user details
        const userName = document.getElementById('user_name').value;
        const userAddress = document.getElementById('user_address').value;

        // Check if user details are provided
        if (!userName || !userAddress) {
            alert('Please provide your name and address.');
            return;
        }

        // Get selected payment method
        const paymentMethod = document.getElementById('payment_method').value;

        // Get payment data based on selected payment method
        let paymentData = {
            userName: userName,
            userAddress: userAddress,
            paymentMethod: paymentMethod
        };

        if (paymentMethod === 'credit_card') {
            paymentData = {
                ...paymentData,
                cardNumber: document.getElementById('card_number').value,
                cardHolderName: document.getElementById('cardholder_name').value,
                expiryDate: document.getElementById('expiry_date').value,
                cvv: document.getElementById('cvv').value
            };
        } else if (paymentMethod === 'gcash') {
            paymentData = {
                ...paymentData,
                gcashConfirmationCode: document.getElementById('gcash_confirmation_code').value
            };
        } else if (paymentMethod === 'paypal') {
            paymentData = {
                ...paymentData,
                paypalConfirmationCode: document.getElementById('paypal_confirmation_code').value
            };
        }

        // Send payment data to server for processing
        fetch('process_payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => {
            if (response.ok) {
                // Payment successful, show success message
                showSuccessMessage();
            } else {
                // Payment failed, display error message
                alert('Payment failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing the payment.');
        });
    }

    // Function to show success message
    function showSuccessMessage() {
        // Hide all payment details sections
        const paymentDetails = document.querySelectorAll('.payment-details');
        paymentDetails.forEach(details => {
            details.style.display = 'none';
        });

        // Show success message
        document.getElementById('success_message').style.display = 'block';
    }

    // Function to return to the index page
    function returnToIndex() {
        window.location.href = '../index.php';
    }
</script>
<!-- ------------------------------------------ -->
</body>
</html>
