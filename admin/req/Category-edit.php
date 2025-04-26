<?php 
// Start the session to access session variables
session_start();

// Check if the admin session is active (i.e., 'admin_id' and 'username' are set)
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    // Check if the 'category' and 'id' fields are set in the POST data
    if(isset($_POST['category']) && isset($_POST['id'])){
      
      // Include the database connection file
      include "../../db_conn.php";

      // Retrieve the 'category' and 'id' values from the form
      $category = $_POST['category'];  // New category name
      $id = $_POST['id'];  // ID of the category to update

      // Validate the input field to ensure the category is not empty
      if(empty($category)){
         $em = "Category is required"; 
         header("Location: ../category-edit.php?error=$em&id=$id");  // Redirect with error message
         exit;
      }
    
      // Prepare the SQL query to update the category in the database
      $sql = "UPDATE category SET category=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$category, $id]);
    
      // Check if the update was successful
      if ($res) {
          // If successful, redirect to the category edit page with a success message
          $sm = "Successfully edited!"; 
          header("Location: ../category-edit.php?success=$sm&category=$category&id=$id");  // Redirect with success message
          exit;
      }else {
        // If an error occurs, redirect to the category edit page with an error message
        $em = "Unknown error occurred"; 
        header("Location: ../category-edit.php?error=$em&id=$id");  // Redirect with error message
        exit;
      }

    // If the 'category' or 'id' fields are not set, redirect back to the category edit page
    }else {
        header("Location: ../category-edit.php");
        exit;
    }

// If the admin session is not active, redirect to the login page
}else {
    header("Location: ../admin-login.php");
    exit;
}  
