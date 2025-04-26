<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    if (isset($_POST['cpass']) && isset($_POST['new_pass']) && isset($_POST['cnew_pass'])) {

        include "../db_conn.php";

        $cpass = $_POST['cpass'];
        $new_pass = $_POST['new_pass'];
        $cnew_pass = $_POST['cnew_pass'];
        $id = $_SESSION['user_id'];

        if (empty($cpass)) {
            $em = "Current password is required";
            header("Location: ../users-profile.php?perror=$em#cpassword");
            exit;
        } elseif (empty($new_pass)) {
            $em = "New password is required";
            header("Location: ../users-profile.php?perror=$em#cpassword");
            exit;
        } elseif (empty($cnew_pass)) {
            $em = "Confirm password is required";
            header("Location: ../users-profile.php?perror=$em#cpassword");
            exit;
        } elseif ($new_pass !== $cnew_pass) {
            $em = "New password and confirmation do not match";
            header("Location: ../users-profile.php?perror=$em#cpassword");
            exit;
        }

        $sql = "SELECT password FROM users WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        $data = $stmt->fetch();

        if (!password_verify($cpass, $data['password'])) {
            $em = "Incorrect current password";
            header("Location: ../users-profile.php?perror=$em#cpassword");
            exit;
        } else {
            $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$new_pass, $id]);

            if ($res) {
                $sm = "Password changed successfully!";
                header("Location: ../users-profile.php?psuccess=$sm#cpassword");
                exit;
            } else {
                $em = "Unknown error occurred";
                header("Location: ../users-profile.php?perror=$em#cpassword");
                exit;
            }
        }

    } else {
        header("Location: ../users-profile.php");
        exit;
    }

} else {
    header("Location: ../login.php");
    exit;
}
