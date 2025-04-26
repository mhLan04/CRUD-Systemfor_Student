<?php
session_start();
include "../db_conn.php";

if (isset($_POST['uname']) && isset($_POST['pass'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../login.php?error=$em");
        exit;
    } elseif (empty($pass)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em&uname=$uname");
        exit;
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();

            if (password_verify($pass, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];

                // Xử lý Remember Me
                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32));
                    $updateToken = $conn->prepare("UPDATE users SET remember_token = ? WHERE user_id = ?");
                    $updateToken->execute([$token, $user['user_id']]);
                    setcookie('remember_token', $token, time() + (86400 * 30), "/");
                } else {
                    setcookie('remember_token', '', time() - 3600, "/");
                    $updateToken = $conn->prepare("UPDATE users SET remember_token = NULL WHERE user_id = ?");
                    $updateToken->execute([$user['user_id']]);
                }

                header("Location: ../blog.php?success=Login successful!");
                exit;

            } else {
                $em = "Incorrect username or password";
                header("Location: ../login.php?error=$em&uname=$uname");
                exit;
            }
        } else {
            $em = "Incorrect username or password";
            header("Location: ../login.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
