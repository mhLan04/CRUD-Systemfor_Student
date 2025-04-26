<?php 
// Start the session
session_start();

// Check if the user is an authenticated admin
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

    // Check if all required POST data and file are set
    if(isset($_POST['title']) && 
       isset($_FILES['cover']) && 
       isset($_POST['text'])  &&
       isset($_POST['post_id']) &&
       isset($_POST['cover_url']) ){

      // Include database connection
      include "../../db_conn.php";
      
      // Get POST data
      $title = $_POST['title'];
      $text = $_POST['text'];
      $post_id = $_POST['post_id'];
      $cu = $_POST['cover_url'];

      // Check if title is empty and show error
      if(empty($title)){
         $em = "Title is required"; 
         header("Location: ../post-edit.php?error=$em&post_id=$post_id");
         exit;
      } 

      // Get the uploaded image file's name
      $image_name = $_FILES['cover']['name'];

      // If the cover image URL is not 'default.jpg' and a new image is uploaded
      if($cu != "default.jpg" && $image_name != ""){
           $clocation = "../../upload/blog/".$cu;

           // Delete the old image file if exists
           if (!unlink($clocation)) {
               // Handle error if deletion fails
           }
      }

      // Check if a new image is uploaded
      if($image_name != ""){

           // Get image details (size, temporary name, and error)
           $image_size = $_FILES['cover']['size'];
           $image_temp = $_FILES['cover']['tmp_name'];
           $error = $_FILES['cover']['error']; 

           // Check if there are no errors with the image upload
           if ($error === 0) {
               // Check if the image is too large
               if ($image_size > 130000) {
                   $em = "Sorry, your file is too large."; 
                    header("Location: ../post-edit.php?error=$em&post_id=$post_id");
                    exit;
               } else {
                  // Get the file extension of the uploaded image
                  $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                  $image_ex = strtolower($image_ex);

                  // Define allowed image extensions
                  $allowed_exs = array('jpg', 'jpeg', 'png');

                  // Check if the uploaded file is an allowed image type
                  if (in_array($image_ex, $allowed_exs )) {
                      // Create a unique name for the image and upload it
                      $new_image_name = uniqid("COVER-", true).'.'.$image_ex;
                      $image_path = '../../upload/blog/'.$new_image_name;
                      move_uploaded_file($image_temp, $image_path);

                      // Update the post data in the database, including the new image URL
                      $sql = "UPDATE post SET post_title=?, post_text=?,cover_url=? WHERE post_id=?";
                      $stmt = $conn->prepare($sql);
                      $res = $stmt->execute([$title, $text, $new_image_name, $post_id]);
                  } else {
                    // Show error if the uploaded file type is not allowed
                    $em = "You can't upload files of this type"; 
                    header("Location: ../post-add.php?error=$em&post_id=$post_id");
                    exit;
                  }
               }
           }
      } else {
          // If no new image is uploaded, update only the title and text
          $sql = "UPDATE post SET post_title=?, post_text=? WHERE post_id=?";
          $stmt = $conn->prepare($sql);
          $res = $stmt->execute([$title, $text, $post_id]);
      }
      
      // If the database update is successful, redirect with a success message
     if ($res) {
          $sm = "Successfully Created!"; 
          header("Location: ../post-edit.php?success=$sm&post_id=$post_id");
          exit;
      } else {
        // If there's an unknown error, show an error message
        $em = "Unknown error occurred"; 
        header("Location: ../post-edit.php?error=$em&post_id=$post_id");
        exit;
      }

    } else {
        // If required POST data is not set, redirect back
        header("Location: ../post-edit.php&post_id=$post_id");
        exit;
    }

} else {
    // If the user is not logged in as an admin, redirect to the login page
    header("Location: ../admin-login.php");
    exit;
} 
?>
