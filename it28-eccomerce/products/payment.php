<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .payment-container {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .payment-details {
            display: none;
        }
        .payment-container .payment-details:first-child {
            display: block;
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
        <!-- Payment method selection -->
        <h2>Select Payment Method</h2>
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" onchange="togglePaymentDetails()">
            <option value="credit_card">Credit Card</option>
            <option value="gcash">GCash</option>
            <option value="paypal">PayPal</option>
        </select>

        <!-- Credit Card Payment Details -->
        <div id="credit_card_details" class="payment-details">
            <h2>Credit Card Details</h2>
            <label for="cardholder_name">Cardholder Name</label>
            <input type="text" id="cardholder_name" name="cardholder_name" required>

            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>

            <label for="expiry_date">Expiration Date</label>
            <input type="date" id="expiry_date" name="expiry_date" required>

            <label for="cvv">CVV</label>
            <input type="password" id="cvv" name="cvv" maxlength="3" required>

            <button class="btn btn-primary" onclick="confirmAndRedirectToLogistic()">Pay Now</button>
        </div>

        <!-- GCash Payment Details -->
        <div id="gcash_details" class="payment-details" style="display: none;">
            <h2>GCash Details</h2>
            <p>Please transfer the total amount to the following GCash number:</p>
            <p>GCash Number: 09123456789</p>
            <p>Once payment is made, enter the confirmation code below and click "Confirm Payment":</p>
            <label for="gcash_confirmation_code">Confirmation Code</label>
            <input type="text" id="gcash_confirmation_code" name="gcash_confirmation_code" required>
            <button class="btn btn-primary" onclick="confirmAndRedirectToLogistic()">Confirm Payment</button>
        </div>

        <!-- PayPal Payment Details -->
        <div id="paypal_details" class="payment-details" style="display: none;">
            <h2>PayPal Details</h2>
            <p>Please transfer the total amount to the following PayPal account:</p>
            <p>PayPal Email: danmarkpetalcurin@gmail.com</p>
            <p>Once payment is made, enter the confirmation code below and click "Confirm Payment":</p>
            <label for="paypal_confirmation_code">Confirmation Code</label>
            <input type="text" id="paypal_confirmation_code" name="paypal_confirmation_code" required>
            <button class="btn btn-primary" onclick="confirmAndRedirectToLogistic()">Confirm Payment</button>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 DanDev Shop. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/Index.js"></script>
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
        document.getElementById(`${paymentMethod}_details`).style.display = 'block';
    }

    // Function to confirm payment and redirect to logistic page
    function confirmAndRedirectToLogistic() {
        if (window.confirm('Are you sure you want to proceed with the payment?')) {
            window.location.href = 'logistic.html';
        }
    }
</script>
<script>
    function displayLogisticPage() {
        window.location.href = 'logistic.html';
    }
</script>
</body>
</html>
