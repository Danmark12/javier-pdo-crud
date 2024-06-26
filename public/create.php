<?php
// Include config file
require_once "../db/config.php";
 
// Define variables and initialize with empty values
// $name = $address = $salary = "";
// $name_err = $address_err = $salary_err = "";
$product_id = $product_thumbnail_link = $product_name = $product_description = $product_retail_price = $product_date_added = $product_updated_date = "";
$Pid_err = $Plink_err = $Pname_err = $Pdescription_err = $Pprice_err = $Pdate_err = $Pupdated_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// validate id
    if (isset($_POST["product_id"])) {
        $input_product_id = trim($_POST["product_id"]);
        if (empty($input_product_id)) {
            $Pid_err = "Please enter the id";
        } elseif (!ctype_digit($input_product_id)) {
            $Pid_err = "Please enter a positive integer value.";
        } else {
            $Pid = $input_product_id;
        }
    } else {
        $product_id_err = "ID is required";
    }
    // link
    if (isset($_POST["product_thumbnail_link"])) {
        $input_product_thumbnail_link = trim($_POST["product_thumbnail_link"]);
        if (empty($input_product_thumbnail_link)) {
            $Plink_err = "Please enter a link.";
        } elseif (!filter_var($input_product_thumbnail_link, FILTER_VALIDATE_URL)) {
            $Plink_err = "Please enter a valid URL.";
        } else {
            $Plink = $input_product_thumbnail_link;
        }
    } else {
        $Plink_err = "Link is required";
    }

    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if(empty($input_product_name)){
        $Pname_err = "Please enter a product name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $input_product_name)) {
        $Pname_err = "Please enter a valid name.";
    } else {
        $product_name = $input_product_name;
    }
    
    // Validate product description
    $input_product_description = trim($_POST["product_description"]);
    if(empty($input_product_description)){
        $Pdescription_err = "Please enter a product description.";
    } else {
        $product_description = $input_product_description;
    }
    // Validate product retail price
    $input_product_retail_price = trim($_POST["product_retail_price"]);
    if(empty($input_product_retail_price)){
        $Pprice_err = "Please enter the product retail price.";     
    } elseif(!ctype_digit($input_product_retail_price)){
        $Pprice_err = "Please enter a valid product retail price.";
    } else{
        $product_retail_price = $input_product_retail_price;
    }
    // date added
    if (isset($_POST["product_date_added"])) {
        $input_product_date_added = trim($_POST["product_date_added"]);
        if (empty($input_product_date_added)) {
            $Pdate_err = "Please enter a date-added.";
        } else {
            $product_date_added = $input_product_date_added;
        }
    } else {
        $Pdate_err = "Date added is required";
    }

    // updated
    if (isset($_POST["product_updated_date"])) {
        $input_product_updated_date = trim($_POST["product_updated_date"]);
        if (empty($input_product_updated_date)) {
            $Pupdated_err = "Please enter an updated date.";
        } else {
            $Pupdated = $input_product_updated_date;
        }
    } else {
        $Pupdated_err = "Updated date is required";
    }
    
    // Check input errors before inserting in database
    if(empty($Pname) && empty($Pdescription) && empty($Pprice)){
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_id, product_thumbnail_link, product_name, product_description, product_retail_price, product_date_added, product_updated_date) 
        VALUES (:product_id, :product_thumbnail_link, :product_name, :product_description, :product_retail_price, :product_date_added, :product_updated_date)";

 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            // $stmt->bindParam(":name", $param_name);
            // $stmt->bindParam(":address", $param_address);
            // $stmt->bindParam(":salary", $param_salary);
            $stmt->bindParam(":product_id", $param_product_id);
            $stmt->bindParam(":product_thumbnail_link", $param_product_thumbnail_link);
            $stmt->bindParam(":product_name", $param_product_name);
            $stmt->bindParam(":product_description", $param_product_description);
            $stmt->bindParam(":product_retail_price", $param_product_retail_price);
            $stmt->bindParam(":product_date_added", $param_product_date_added);
            $stmt->bindParam(":product_updated_date", $param_product_updated_date);
            
            
            // Set parameters
            // $param_name = $name;
            // $param_address = $address;
            // $param_salary = $salary;
            
            $param_product_id = $product_id;
            $param_product_thumbnail_link = $product_thumbnail_link;
            $param_product_name = $product_name;
            $param_product_description = $product_description;
            $param_product_retail_price = $product_retail_price;
            $param_product_date_added = $product_date_added;
            $param_product_updated_date = $product_updated_date;            
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
      
    
         
        // Close statement
        unset($stmt);
    }
 
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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