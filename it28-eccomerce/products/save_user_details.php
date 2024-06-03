<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'u593341949_dev_javier');
// define('DB_PASSWORD', '20221069Javier');
// define('DB_NAME', 'u593341949_db_javier');


$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL root password
$dbname = "dan_tbl"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// try{
//     $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e){
//     die("ERROR: Could not connect. " . $e->getMessage());
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO user_details (udetails_name, udetails_address, udetails_contact, udetails_email) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $address, $contact, $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the last inserted ID
        $udetails_id = $stmt->insert_id;

        // Store the udetails_id in the session
        $_SESSION['udetails_id'] = $udetails_id;

        // Redirect to the next page (for example, payment.php)
        header("Location: payments.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!-- ---------- -->