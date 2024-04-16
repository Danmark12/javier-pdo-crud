<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
// $name = $address = $salary = "";
// $name_err = $address_err = $salary_err = "";
$product_id = $product_thumbnail_links = $product_name = $product_description = $product_retail_price = $product_date_added = $product_updated_date = "";
$Pname_err = $Pdescription_err = $Pprice_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if(empty($input_product_name)){
        $Pname_err = "Please enter a product name.";
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
    
    
    // Check input errors before inserting in database
    if(empty($Pname) && empty($Pdescription) && empty($Pprice)){
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, product_description, product_retail_price) VALUES (:product_name, :product_description, :product_retail_price)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            // $stmt->bindParam(":name", $param_name);
            // $stmt->bindParam(":address", $param_address);
            // $stmt->bindParam(":salary", $param_salary);
            $stmt->bindParam(":product_id", $param_product_id);
            $stmt->bindParam(":product_thumbnail_links", $param_product_thumbnail_links);
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
            $param_product_thumbnail_links = $product_thumbnail_links;
            $param_product_name = $product_name;
            $param_product_description = $product_description;
            $param_product_retail_price = $product_retail_price;
            $param_product_date_added = $product_date_added;
            $param_product_updated_date = $product_updated_date;
            
            // Attempt to execute the prepared statement
        //     if($stmt->execute()){
        //         // Records created successfully. Redirect to landing page
        //         header("location: index.php");
        //         exit();
        //     } else{
        //         echo "Oops! Something went wrong. Please try again later.";
        //     }
        // }
        if($stmt->execute()){
            // Records created successfully. Redirect to landing page
            header("location: index.php");
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
                            <input type="text" name="product_id" class="form-control" value="<?php echo $product_id; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Thumbnail Links</label>
                            <input type="text" name="product_thumbnail_links" class="form-control" value="<?php echo $product_thumbnail_links; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($Pname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $Pname;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_description" class="form-control <?php echo (!empty($Pdescription_err)) ? 'is-invalid' : ''; ?>"><?php echo $product_description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Retail Price</label>
                            <input type="text" name="product_retail_price" class="form-control <?php echo (!empty($Pprice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_retail_price; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Date Added</label>
                            <input type="text" name="product_date_added" class="form-control" value="<?php echo $product_date_added; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Updated Date</label>
                            <input type="text" name="product_updated_date" class="form-control" value="<?php echo $product_updated_date; ?>">
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