<?php

// Function: Get all users from the 'users' table
// Parameters:
//   $conn - the database connection object (PDO)
function getAll($conn)
{
    // SQL query to fetch user id, first name (fname), and username from 'users' table
    $sql = "SELECT user_id, fname, username FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // If there are results, return them as an array
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0; // If no users, return 0
    }
}

// Function: Delete a user by their ID from the 'users' table
// Parameters:
//   $conn - the database connection object (PDO)
//   $id   - the ID of the user to delete
function deleteById($conn, $id)
{
    // SQL query to delete user by their ID
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    // Return 1 if the deletion was successful, otherwise return 0
    if ($res) {
        return 1; // Success
    } else {
        return 0; // Failure
    }
}
?>
