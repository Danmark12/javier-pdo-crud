<?php
// Process delete operation after confirmation
if(isset($_GET["product_id"]) && !empty($_GET["product_id"])){
    // Include config file
    require_once "../db/config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM products WHERE product_id = :product_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":product_id", $param_product_id);
        
        // Set parameters
        $param_product_id = trim($_GET["product_id"]);
        
        // Attempt to execute the prepared statement
        try {
            if($stmt->execute()){
                // Records deleted successfully. Redirect to landing page
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // No product_id provided, redirect to error page
    header("location: ../public/error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                        <input type="hidden" name="product_id" value="<?php echo trim($_GET["product_id"]); ?>"/>
                            <p>Are you sure you want to delete this product record?</p>
                            <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../public/welcome.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
