<?php 
// Start the session
session_start();

// Check if the username and password are set in the POST request
if(isset($_POST['uname']) && isset($_POST['pass'])){

    // Include database connection file
    include "../db_conn.php";

    // Get the POST data for username and password
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    // Prepare data to pass back in case of an error
    $data = "uname=".$uname;

    // Check if the username is empty and show an error if it is
    if(empty($uname)){
        $em = "User name is required";
        header("Location: ../admin-login.php?error=$em&$data");
        exit;
    } 
    // Check if the password is empty and show an error if it is
    else if(empty($pass)){
        $em = "Password is required";
        header("Location: ../admin-login.php?error=$em&$data");
        exit;
    } else {

        // Prepare SQL query to select the user based on the provided username
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);

        // Check if a user with the provided username exists
        if($stmt->rowCount() == 1){
            // Fetch the user's data
            $user = $stmt->fetch();

            // Get the stored username, password, and ID from the database
            $username =  $user['username'];
            $password =  $user['password'];
            $id =  $user['id'];

            // Check if the username matches the database record
            if($username === $uname){
                // Verify if the password matches using password_verify (safe hashing check)
                if(password_verify($pass, $password)){
                    // Store user session data and redirect to the user page
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['username'] = $username;

                    header("Location: users.php");
                    exit;
                } else {
                    // If the password doesn't match, show an error
                    $em = "Incorrect User name or password";
                    header("Location: ../admin-login.php?error=$em&$data");
                    exit;
                }
            } else {
                // If the username doesn't match, show an error
                $em = "Incorrect User name or password";
                header("Location: ../admin-login.php?error=$em&$data");
                exit;
            }

        } else {
            // If no user found with the provided username, show an error
            $em = "Incorrect User name or password";
            header("Location: ../admin-login.php?error=$em&$data");
            exit;
        }
    }

} else {
    // If POST data is not set, redirect to login page with error
    header("Location: ../login.php?error=error");
    exit;
}
?>
