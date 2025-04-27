<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'inc/NavBar.php'; ?>

    <section class="hero-section">
        <div class="text-center">
            <h1>CONTACT US</h1>
            <p class="lead">DISCOVER COURSES THAT INSPIRE YOU</p>
        </div>
    </section>

    <div class="container mt-5">
        <h2 class="mb-4">Contact the Administrator</h2>

        <form action="req/send-mail.php" method="post">
            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Your Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>

        <div class="mt-3">
            <a href="blog.php" class="btn btn-secondary">Back to Blog</a>
        </div>
    </div>

    <!-- Toastr popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "extendedTimeOut": "1000"
        };

        // Display toastr notifications
        <?php if (isset($_GET['success'])): ?>
            toastr.success("<?= htmlspecialchars($_GET['success']) ?>");
        <?php elseif (isset($_GET['error'])): ?>
            toastr.error("<?= htmlspecialchars($_GET['error']) ?>");
        <?php endif; ?>
    </script>

</body>

</html>