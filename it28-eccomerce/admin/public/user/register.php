<?php
// Include config file
require_once "../../db/config.php";

// Define variables and initialize with empty values
$u_username = $u_password = $confirm_password = "";
$u_username_err = $u_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["u_username"]))){
        $u_username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT u_id FROM users WHERE u_username = :u_username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":u_username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["u_username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $u_username_err = "This username is already taken.";
                } else{
                    $u_username = trim($_POST["u_username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["u_password"]))){
        $u_password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["u_password"])) < 6){
        $u_password_err = "Password must have at least 6 characters.";
    } else{
        $u_password = trim($_POST["u_password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($u_password_err) && ($u_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($u_username_err) && empty($u_password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (u_username, u_password) VALUES (:u_username, :u_password)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":u_username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":u_password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_username = $u_username;
            $param_password = password_hash($u_password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: ../../index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($u_username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="u_username" class="form-control" value="<?php echo $u_username; ?>">
                <span class="help-block"><?php echo $u_username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($u_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="u_password" class="form-control" value="<?php echo $u_password; ?>">
                <span class="help-block"><?php echo $u_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="../../index.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
