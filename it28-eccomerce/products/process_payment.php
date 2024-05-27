<?php
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "dan_tbl"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the payment data from the request
$data = json_decode(file_get_contents('php://input'), true);

$user_name = $data['userName'];
$user_address = $data['userAddress'];
$payment_method = $data['paymentMethod'];
$cardholder_name = isset($data['cardHolderName']) ? $data['cardHolderName'] : null;
$card_number = isset($data['cardNumber']) ? $data['cardNumber'] : null;
$expiry_date = isset($data['expiryDate']) ? $data['expiryDate'] : null;
$cvv = isset($data['cvv']) ? $data['cvv'] : null;
$confirmation_code = null;

if ($payment_method === 'gcash') {
    $confirmation_code = $data['gcashConfirmationCode'];
} elseif ($payment_method === 'paypal') {
    $confirmation_code = $data['paypalConfirmationCode'];
}

// Insert payment details into the database
$sql = "INSERT INTO payments (user_name, user_address, payment_method, cardholder_name, card_number, expiry_date, cvv, confirmation_code) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $user_name, $user_address, $payment_method, $cardholder_name, $card_number, $expiry_date, $cvv, $confirmation_code);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "Payment processed successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error processing payment: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
