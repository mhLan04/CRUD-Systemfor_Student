<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'inc/NavBar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="text-center">
            <h1>Our Classes</h1>
            <p class="lead">Discover Courses That Inspire You</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Who We Are</h2>
            <p class="lead">At MyBlog, we are passionate about empowering communities through knowledge, creativity, and technology. Our team is dedicated to building a vibrant, supportive environment where ideas flourish and innovation leads the way to success.</p>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5 values-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Mission</h5>
                            <p class="card-text">To empower individuals and organizations with meaningful information and community-driven platforms.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Vision</h5>
                            <p class="card-text">To be a global leader in delivering impactful digital experiences that inspire and connect people everywhere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Core Values</h5>
                            <p class="card-text">Integrity, Innovation, Collaboration, Excellence, and Commitment to Social Impact.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 team-section">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Team</h2>
            <div class="row justify-content-center">
                <div class="col-md-3 text-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team Member">
                    <h5 class="mt-3">John Doe</h5>
                    <p class="text-muted">Founder & CEO</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team Member">
                    <h5 class="mt-3">Jane Smith</h5>
                    <p class="text-muted">Chief Operating Officer</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Team Member">
                    <h5 class="mt-3">Michael Brown</h5>
                    <p class="text-muted">Head of Technology</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2 class="mb-3">Ready to Connect?</h2>
            <p class="lead mb-4">Join our growing community or get in touch with us today!</p>
            <a href="contact.php" class="btn btn-light btn-lg">Contact Us</a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>