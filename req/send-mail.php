<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    if ($stmt) {
        header("Location: ../contact.php?success=Message saved successfully!");
        exit;
    } else {
        header("Location: ../contact.php?error=Failed to save the message.");
        exit;
    }
} else {
    header("Location: ../contact.php");
    exit;
}
?>
