<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
    include_once("../db_conn.php");
    include_once("data/Settings.php");

    $settingsModel = new Settings($conn);
    $settingsArray = [];
    foreach ($settingsModel->getAll() as $setting) {
        $settingsArray[$setting['setting_key']] = $setting['setting_value'];
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Dashboard - Settings</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body> 

        <?php $key = "hhdsfs1263z";
        include "inc/side-nav.php"; ?>

        <div class="main-table">
            <h3 class="mb-3">Admin Settings</h3>
            <form action="req/save-setting.php" method="POST">
                <div class="mb-4">
                    <h4>Blog Post Settings</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments" <?php if (isset($settingsArray['allow_comments']) && $settingsArray['allow_comments'] == 'on') echo 'checked'; ?>>
                        <label class="form-check-label" for="allow_comments">Allow Comments</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="auto_approve_comments" name="auto_approve_comments" <?php if (isset($settingsArray['auto_approve_comments']) && $settingsArray['auto_approve_comments'] == 'on') echo 'checked'; ?>>
                        <label class="form-check-label" for="auto_approve_comments">Auto-approve Comments</label>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Email Notifications</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="new_post_notifications" name="new_post_notifications" <?php if (isset($settingsArray['new_post_notifications']) && $settingsArray['new_post_notifications'] == 'on') echo 'checked'; ?>>
                        <label class="form-check-label" for="new_post_notifications">Notify when a new post is published</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="new_comment_notifications" name="new_comment_notifications" <?php if (isset($settingsArray['new_comment_notifications']) && $settingsArray['new_comment_notifications'] == 'on') echo 'checked'; ?>>
                        <label class="form-check-label" for="new_comment_notifications">Notify when a new comment arrives</label>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Theme Settings</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="light_mode" name="theme" value="light" <?php if (!isset($settingsArray['theme']) || $settingsArray['theme'] == 'light') echo 'checked'; ?>>
                        <label class="form-check-label" for="light_mode">Light Mode</label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" id="dark_mode" name="theme" value="dark" <?php if (isset($settingsArray['theme']) && $settingsArray['theme'] == 'dark') echo 'checked'; ?>>
                        <label class="form-check-label" for="dark_mode">Dark Mode</label>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: ../admin-login.php");
    exit;
}
?>