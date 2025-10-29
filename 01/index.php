<?php
// Include your library files
require_once 'lib/readText.php';
require_once 'lib/readCSV.php';
require_once 'lib/readJSON.php';

// Load data from files
$overview = readTextFile('data/overview.txt');
$mission = readTextFile('data/about.txt');
$products = readCSVFile('data/products.csv');
$team = readCSVFile('data/team.csv');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>NaturaTech Solutions Inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet" />
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#home">NaturaTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li><a href="#home" class="nav-link">Home</a></li>
                <li><a href="#services" class="nav-link">Products</a></li>
                <li><a href="#team" class="nav-link">Team</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="hero-3 bg-center position-relative" style="background-image:url('images/hero-3-bg.png');">
    <div class="container text-center py-5">
        <h1 class="mb-4">NaturaTech Solutions Inc.</h1>
        <p class="lead"><?php echo nl2br($overview); ?></p>
        <p class="fst-italic text-muted"><?php echo $mission; ?></p>
    </div>
</section>

<!-- Products / Services -->
<section class="section" id="services">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Products & Services</h2>
        </div>
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-lg-4 mb-4">
                <div class="service-box text-center p-4">
                    <h4 class="mb-3"><?php echo $product['name']; ?></h4>
                    <p class="text-muted"><?php echo $product['description']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section bg-light" id="team">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Meet Our Team</h2>
        </div>
        <div class="row">
            <?php foreach ($team as $member): ?>
                <div class="team-member">
                 <img src="<?= $member['image'] ?>" alt="<?= $member['name'] ?>">
                 <h3><?= $member['name'] ?></h3>
                 <p><strong><?= $member['role'] ?></strong></p>
                 <p><?= $member['bio'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section" id="contact">
    <div class="container text-center">
        <h2>Contact Us</h2>
        <p>Email: info@naturatech.com | Portland, Oregon</p>
    </div>
</section>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
