<?php 
// Start the session to access session variables
session_start();

// Check if the admin session is active (i.e., 'admin_id' and 'username' are set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    // Check if the 'category' field is set in the POST data
    if(isset($_POST['category'])){
      
      // Include the database connection file
      include "../../db_conn.php";

      // Retrieve the 'category' value from the form
      $category = $_POST['category'];

      // Validate the input field to ensure the category is not empty
      if(empty($category)){
         $em = "Category is required"; 
         header("Location: ../category-add.php?error=$em");  // Redirect with error message
         exit;
      }
    
      // Prepare the SQL query to insert the new category into the database
      $sql = "INSERT INTO category(category) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$category]);
    
      // Check if the insertion was successful
      if ($res) {
          // If successful, redirect to the category page with a success message
          $sm = "Successfully Created!"; 
          header("Location: ../category-add.php?success=$sm");  // Redirect with success message
          exit;
      }else {
        // If an error occurs, redirect to the category page with an error message
        $em = "Unknown error occurred"; 
        header("Location: ../category-add.php?error=$em");  // Redirect with error message
        exit;
      }

    // If the 'category' field is not set, redirect to the category page
    }else {
        header("Location: ../category-add.php");
        exit;
    }

// If the admin session is not active, redirect to the login page
}else {
    header("Location: ../admin-login.php");
    exit;
}  
