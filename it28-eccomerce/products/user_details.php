<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1569466896816-3359bfbd1078') no-repeat center center fixed; /* Fruity background image */
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .card {
            border: none; /* No border for card */
            border-radius: 20px; /* Rounded corners */
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            width: 80%; /* 80% of the viewport width */
            max-width: 600px; /* Maximum width for the card */
            padding: 30px; /* Add padding for content */
        }
        .card-header {
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            color: #333; /* Dark text color */
            border-radius: 20px 20px 0 0; /* Rounded corners only at the top */
            padding: 20px;
            font-size: 1.5rem;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff; /* Blue button */
            border-color: #007bff; /* Blue border */
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Darker blue border on hover */
        }
        input[type="text"],
        input[type="email"],
        textarea {
            border-radius: 10px; /* Rounded corners for input fields */
            border: 1px solid #ccc; /* Light grey border */
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        textarea {
            resize: none; /* Disable resizing of textarea */
            height: 100px; /* Set height for textarea */
        }
        .arrow {
            position: relative;
        }
        .arrow::before,
        .arrow::after {
            content: '';
            position: absolute;
            top: -10px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: transparent;
            transition: background-color 0.3s ease;
            pointer-events: none; /* Prevent hover events from triggering */
        }
        .arrow::before {
            left: -20px;
        }
        .arrow::after {
            right: -20px;
        }
        .arrow:hover::before,
        .arrow:hover::after {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
        }
    </style>
</head>
<body>

<div id="userDetailsForm" class="container">
    <div class="card">
        <div class="card-header">
            <div class="arrow">
                User Details <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        <div class="card-body">
            <form action="save_user_details.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required autocomplete="address"></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" id="contact" name="contact" required autocomplete="tel">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
                </div>
                
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
</div>

<script>
    function displayUserDetailsForm() {
        console.log("Displaying User Details Form");
        document.getElementById('userDetailsForm').style.display = 'block';
    }

    function addToCartAndShow(p_id, p_price) {
        console.log("Product ID:", p_id); // Log the product ID
        addToCart(p_id, p_price);
        displayUserDetailsForm(); // Display the user details form
        displayShowCard(); // Call the function to display the show card
    }

    function addToCart(p_id, p_price) {
        // Your addToCart logic here
        console.log("Added to cart: ", p_id, p_price);
    }

    function displayShowCard() {
        // Your displayShowCard logic here
        console.log("Show card displayed");
    }
</script>

</body>
</html>
<!-- ------------ -->
