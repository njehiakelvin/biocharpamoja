<?php
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($page_title)) { $page_title = "Biochar Pamoja – Sustainable Biochar Solutions"; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    
    <link rel="icon" type="image/jpg" href="assets/images/favicon.png">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=5">
    
    <!-- Open Graph Meta Tags -->
<meta property="og:title" content="Biochar Pamoja – We fix carbon" />
<meta property="og:description" content="Discover how Biochar Pamoja is helping farmers in Bungoma County improve soil health and crop yields through biochar technology." />
<meta property="og:image" content="https://biocharpamoja.co.ke/assets/images/biocharpamoja logo.jpg" />
<meta property="og:url" content="https://biocharpamoja.co.ke" />
<meta property="og:type" content="website" />

<!-- Twitter Card Tags -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Biochar Pamoja – Sustainable Farming in Kenya" />
<meta name="twitter:description" content="Biochar Pamoja empowers Kenyan farmers with sustainable biochar solutions for better harvests." />
<meta name="twitter:image" content="https://biocharpamoja.co.ke/assets/images/biocharpamoja logo.jpg" />

</head>

<body>
    <!-- <div id="loader-wrapper">
        <lottie-player
          src="assets/loader/animations/Animation - 1746611039237.json"
          background="transparent"
          speed="1"
          style="width: 200px; height: 200px;"
          loop
          autoplay>
        </lottie-player>
    </div> -->

    <header id="header" class="fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">
                    BIOCHAR <span>PAMOJA</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'projects.php') ? 'active' : ''; ?>" href="projects.php">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'blog.php') ? 'active' : ''; ?>" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <button class="theme-toggle" id="theme-toggle" title="Switch Theme">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>