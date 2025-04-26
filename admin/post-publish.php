<?php  
session_start();  // Start the session to check if the admin is logged in

// Check if the admin is logged in and if the 'post_id' and 'publish' parameters are set
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['username']) && 
    isset($_GET['post_id']) && 
    isset($_GET['publish'])) {
  
  include_once("../db_conn.php");  // Include the database connection file

  $post_id = $_GET['post_id'];  // Get the 'post_id' from the URL
  $publish = $_GET['publish'];  // Get the 'publish' value (1 or 0) from the URL

  // If 'publish' is 1, update the post to be published
  if ($publish) {
      $sql = "UPDATE post SET publish=1 WHERE post_id=?";  // SQL query to set the post as published
      $stmt = $conn->prepare($sql);  // Prepare the SQL query
      $stmt->execute([$post_id]);  // Execute the query with the post ID
      $sm = "Successfully publish!";  // Success message for publishing
      header("Location: post.php?success=$sm");  // Redirect to the post page with success message
      exit;  // Exit to prevent further execution
  } else {
      // If 'publish' is 0, update the post to be unpublished
      $sql = "UPDATE post SET publish=0";  // SQL query to set the post as unpublished
      $stmt = $conn->prepare($sql);  // Prepare the SQL query
      $stmt->execute();  // Execute the query
      $sm = "Successfully unpublish!";  // Success message for unpublishing
      header("Location: post.php?success=$sm");  // Redirect to the post page with success message
      exit;  // Exit to prevent further execution
  }

} else {
    // If the admin is not logged in, redirect to the login page
    header("Location: ../admin-login.php");  // Redirect to the login page
    exit;  // Exit to prevent further execution
}
