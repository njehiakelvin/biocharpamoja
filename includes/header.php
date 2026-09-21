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


    <style>
    /* ── Page loader ───────────────────────────── */
    #loader-wrapper {
        position: fixed; inset: 0;
        background: var(--bg-body, #fff);
        display: flex; align-items: center; justify-content: center;
        z-index: 99999;
        transition: opacity .5s ease-out, visibility .5s;
    }
    #loader-wrapper.hidden { opacity: 0; visibility: hidden; }
    .bp-loader { position: relative; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; }
    .bp-spinner {
        position: absolute; inset: 0;
        border: 3px solid #d8f3dc;
        border-top-color: #2d6a4f;
        border-radius: 50%;
        animation: bp-spin .9s linear infinite;
    }
    .bp-leaf { font-size: 1.8rem; color: #2d6a4f; z-index: 1; animation: bp-pulse 1.2s ease-in-out infinite; }
    @keyframes bp-spin  { to { transform: rotate(360deg); } }
    @keyframes bp-pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.15); } }

    /* ── Hamburger fix ─────────────────────────── */
    .navbar-toggler {
        border: 2px solid rgba(255,255,255,.6) !important;
        padding: 6px 10px !important;
        color: #fff !important;
    }
    .navbar-toggler i { color: #fff; font-size: 1.1rem; }
    .navbar-toggler:focus { box-shadow: none !important; }

    /* ── Lazy image fade-in ────────────────────── */
    img.lazy { opacity: 0; transition: opacity .4s ease; }
    img.lazy.loaded { opacity: 1; }
    </style>
</head>

<body>
    <div id="loader-wrapper">
        <div class="bp-loader">
            <div class="bp-leaf"><i class="fas fa-leaf"></i></div>
            <div class="bp-spinner"></div>
        </div>
    </div>

    <header id="header" class="fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">
                    BIOCHAR <span>PAMOJA</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fas fa-bars"></i>
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