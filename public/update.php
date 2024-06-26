<?php
// Include config file
require_once "../db/config.php";

// Define variables and initialize with empty values
$product_id = $product_thumbnail_link = $product_name = $product_description = $product_retail_price = $product_date_added = $product_updated_date = "";
$Pname_err = $Pdescription_err = $Pprice_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $product_id = $_POST["product_id"];
    
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if (empty($input_product_name)) {
        $Pname_err = "Please enter a product name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $input_product_name)) {
        $Pname_err = "Please enter a valid name.";
    } else {
        $product_name = $input_product_name;
    }
    
    // Validate description
    $input_product_description = trim($_POST["product_description"]);
    if (empty($input_product_description)) {
        $Pdescription_err = "Please enter a product description.";     
    } else {
        $product_description = $input_product_description;
    }
    
    // Validate retail_price
    $input_product_retail_price = trim($_POST["product_retail_price"]);
    if (empty($input_product_retail_price)) {
        $Pprice_err = "Please enter the retail price amount.";     
    } elseif (!ctype_digit($input_product_retail_price)) {
        $Pprice_err = "Please enter a positive integer value.";
    } else {
        $product_retail_price = $input_product_retail_price;
    }
    
    // Check input errors before inserting in database
    if (empty($Pname_err) && empty($Pdescription_err) && empty($Pprice_err)) {
       // Prepare an update statement
$sql = "UPDATE products 
SET product_thumbnail_link=:product_thumbnail_link,
    product_name=:product_name,
    product_description=:product_description,
    product_retail_price=:product_retail_price, 
    product_date_added=:product_date_added, 
    product_updated_date=:product_updated_date
WHERE product_id=:product_id";

if ($stmt = $pdo->prepare($sql)) {
// Bind variables to the prepared statement as parameters
$stmt->bindParam(":product_id", $product_id);
$stmt->bindParam(":product_thumbnail_link", $product_thumbnail_link);
$stmt->bindParam(":product_name", $product_name);
$stmt->bindParam(":product_description", $product_description);
$stmt->bindParam(":product_retail_price", $product_retail_price);
$stmt->bindParam(":product_date_added", $product_date_added);
$stmt->bindParam(":product_updated_date", $product_updated_date);

// Set parameters
$product_id = $_POST["product_id"]; // Removed the redundant line
$product_thumbnail_link = $_POST["product_thumbnail_link"];
$product_name = $_POST["product_name"];
$product_description = $_POST["product_description"];
$product_retail_price = $_POST["product_retail_price"];
$product_date_added = $_POST["product_date_added"];
$product_updated_date = date("Y-m-d H:i:s");

// Attempt to execute the prepared statement
if ($stmt->execute()) {
// Records updated successfully. Redirect to landing page
header("location: index.php");
exit();
} else {
echo "Oops! Something went wrong. Please try again later.";
}
}

         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["product_id"]) && !empty(trim($_GET["product_id"]))) {
        // Get URL parameter
        $product_id = trim($_GET["product_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE product_id = :product_id";
        
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
            $param_product_id =  $product_id ;
        
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    // Fetch result row as an associative array
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $product_thumbnail_link = $row["product_thumbnail_link"];
                    $product_name = $row["product_name"];
                    $product_description = $row["product_description"];
                    $product_retail_price = $row["product_retail_price"];
                    $product_date_added = $row["product_date_added"];
                    $product_updated_date = $row["product_updated_date"];

                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location:public/error.php");
                    exit();
                }
                
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: public/error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add a product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                        <label>Product ID</label>
                            <input type="text" name="product_id" class="form-control <?php echo (!empty($Pid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_id; ?>">
                            <span class="invalid-feedback"><?php echo $Pid_err; ?></span>
                        </div>
                        <div class="form-group">
                    
                            <label>Product Thumbnail Link</label>
                            <input type="text" name= "product_thumbnail_link" class="form-control <?php echo (!empty($Plink_err)) ? 'is-invalid' : ''; ?>" value="<?php echo  $product_thumbnail_link?>">
                            <span class="invalid-feedback"><?php echo $Plink_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($Pname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $Pname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_description" class="form-control <?php echo (!empty($Pdescription_err)) ? 'is-invalid' : ''; ?>"><?php echo $product_description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Pdescription_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Retail Price</label>
                            <input type="text" name="product_retail_price" class="form-control <?php echo (!empty($Pprice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_retail_price; ?>">
                            <span class="invalid-feedback"><?php echo $Pprice_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Date Added</label>
                            <input type="date" name="product_date_added" class="form-control <?php echo (!empty($Pdate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_date_added; ?>">
                            <span class="invalid-feedback"><?php echo $Pdate_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Updated Date</label>
                            <input type="date" name="product_updated_date" class="form-control <?php echo (!empty($Pupdated_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_updated_date; ?>">
                            <span class="invalid-feedback"><?php echo $Pupdated_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>