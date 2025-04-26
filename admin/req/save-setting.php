<?php
session_start();
include_once("../../db_conn.php");
include_once("../data/Settings.php");

if (isset($_SESSION['admin_id'])) {

    $settingsModel = new Settings($conn);

    $settings = [
        'allow_comments' => isset($_POST['allow_comments']) ? 'on' : 'off',
        'auto_approve_comments' => isset($_POST['auto_approve_comments']) ? 'on' : 'off',
        'new_post_notifications' => isset($_POST['new_post_notifications']) ? 'on' : 'off',
        'new_comment_notifications' => isset($_POST['new_comment_notifications']) ? 'on' : 'off',
        'theme' => isset($_POST['theme']) ? $_POST['theme'] : 'light',
    ];

    foreach ($settings as $key => $value) {
        $settingsModel->save($key, $value);
    }

    header("Location: ../setting.php?success=Settings updated successfully!");
    exit;

} else {
    header("Location: ../admin-login.php");
    exit;
}
?>
