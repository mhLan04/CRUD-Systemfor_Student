<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Classes - MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Include Navbar -->
    <?php include 'inc/NavBar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="text-center">
            <h1>CLASSES</h1>
            <p class="lead">DISCOVER COURSES THAT INSPIRE YOU</p>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="class-card bg-yellow">
                        <i class="fas fa-laptop-code class-icon"></i>
                        <h5 class="fw-bold">Web Development</h5>
                        <p>Learn to build modern websites and applications with the latest technologies.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="class-card bg-red">
                        <i class="fas fa-chart-line class-icon"></i>
                        <h5 class="fw-bold">Marketing</h5>
                        <p>Master the art of digital marketing and grow your brand globally.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="class-card bg-blue">
                        <i class="fas fa-pen-nib class-icon"></i>
                        <h5 class="fw-bold">Graphic Design</h5>
                        <p>Unleash your creativity and design stunning visuals for brands.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="class-card bg-cyan">
                        <i class="fas fa-language class-icon"></i>
                        <h5 class="fw-bold">Language Courses</h5>
                        <p>Expand your horizons by learning new languages with native speakers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>