<?php 

session_start();  // Start the session to access session variables

// Check if the user is logged in by verifying session variables
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    // Check if 'comment' and 'post_id' are submitted via POST
    if (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $comment = $_POST['comment'];  // Get the comment text from POST
        $post_id = $_POST['post_id'];  // Get the post ID from POST
        $user_id = $_SESSION['user_id'];  // Get the logged-in user's ID from session
        
        include "../db_conn.php";  // Include database connection file

        // Check if the comment is empty
        if (empty($comment)) {
            $em = "Comment is required";  // Error message if comment is empty
            header("Location: ../blog-view.php?error=$em&post_id=$post_id#comments");  // Redirect to the blog view page with error message
            exit;
        } else {
            // Prepare and execute the SQL query to insert the comment into the database
            $sql = "INSERT INTO comment(comment, user_id, post_id) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);  // Prepare the SQL statement
            $stmt->execute([$comment, $user_id, $post_id]);  // Execute the statement with the provided values

            // Redirect to the blog view page with a success message
            header("Location: ../blog-view.php?success=successfully commented ;) &post_id=$post_id#comments");
            exit;
        }
        
    } else {
        // If 'comment' or 'post_id' are not set, redirect to the blog page
        header("Location: ../blog.php");
        exit;
    }

} else {
    // If user is not logged in, redirect to the blog page
    header("Location: ../blog.php");
    exit;
}
