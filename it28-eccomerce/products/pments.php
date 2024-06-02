<?php
// Establish database connection
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "dan_tbl"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $payment_method = $_POST["payment_method"];
    $cardholder_name = $_POST["cardholder_name"];
    $card_number = $_POST["card_number"];
    $expiry_date = $_POST["expiry_date"];
    $cvv = $_POST["cvv"];
    $amount = $_POST["amount"];
    $status = $_POST["status"];
    $shopping_cart = json_decode($_POST["shopping_cart"], true); // Decode the JSON string to PHP array

    // Prepare shopping cart data for database insertion
    $shopping_cart_json = $conn->real_escape_string(json_encode($shopping_cart));

    // Insert data into database
    $sql = "INSERT INTO UserPayments (payment_method, cardholder_name, card_number, expiry_date, cvv, amount, status, shopping_cart)
            VALUES ('$payment_method', '$cardholder_name', '$card_number', '$expiry_date', '$cvv', $amount, '$status', '$shopping_cart_json')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        // Handle database insertion error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!-- ------------ -->