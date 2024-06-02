<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../admin/public/user/welcome.php");
    exit;
}

// Include config file
require_once "../admin/db/config.php";

// Define variables and initialize with empty values
$u_username = $u_password = "";
$u_username_err = $u_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["u_username"]))){
        $u_username_err = "Please enter username.";
    } else{
        $u_username = trim($_POST["u_username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["u_password"]))){
        $u_password_err = "Please enter your password.";
    } else{
        $u_password = trim($_POST["u_password"]);
    }

    // Validate credentials
    if(empty($u_username_err) && empty($u_password_err)){
        // Prepare a select statement
        $sql = "SELECT u_id, u_username, u_password FROM users WHERE u_username = :u_username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":u_username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = $u_username;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $u_id = $row["u_id"];
                        $u_username = $row["u_username"];
                        $hashed_password = $row["u_password"];
                        if(password_verify($u_password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["u_id"] = $u_id;
                            $_SESSION["u_username"] = $u_username;

                            // Redirect user to welcome page
                            header("location: ../admin/public/user/welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $u_password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $u_username_err = "No account found with that username.";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($u_username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="u_username" class="form-control" value="<?php echo $u_username; ?>">
                <span class="help-block"><?php echo $u_username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($u_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="u_password" class="form-control">
                <span class="help-block"><?php echo $u_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="../admin/public/user/register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
