<?php  

session_start();  // Start the session to check if the user is logged in

// Check if the user session exists and post_id is passed in the POST request
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_POST['post_id'])) {
    
    include "../db_conn.php";  // Include the database connection
    $user_id = $_SESSION['user_id'];  // Get the logged-in user ID from session
    $post_id = $_POST['post_id'];  // Get the post ID from the POST request

    // If post_id is empty, return a placeholder response
    if (empty($post_id)) {
        echo "...";
    } else {
        // Check if the user has already liked the post
        $sql = "SELECT * FROM post_like WHERE post_id=? AND liked_by=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$post_id, $user_id]);

        // If the user has already liked the post, perform 'unlike' by deleting the like record
        if ($stmt->rowCount() > 0) {
            $sql = "DELETE FROM post_like WHERE post_id=? AND liked_by=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$post_id, $user_id]);
        } else {
            // If the user hasn't liked the post, insert a new like record
            $sql = "INSERT INTO post_like(liked_by, post_id) VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$user_id, $post_id]);
        }
        
        // Get the total number of likes for the post
        $sql = "SELECT * FROM post_like WHERE post_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$post_id]);
        
        // Return the total number of likes for the post, or a placeholder if no likes exist
        if ($stmt->rowCount() >= 0) {
            echo $stmt->rowCount();  // Output the total number of likes
        } else {
            echo "...";  // Return a placeholder if something goes wrong
        }
    }

} else {
    // If the session or post_id is not set, return a placeholder response
    echo "...";
}
