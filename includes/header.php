<?php
    $pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Dhofar Tourism';
    $currentPage = $_SERVER['SCRIPT_NAME'];
    $basePath = (strpos($currentPage, '/pages/') !== false) ? '../' : './';
    $isLoggedIn = function_exists('is_logged_in') && is_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover the beauty of Dhofar, Oman - Your ultimate travel guide">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-map-marked-alt"></i> Dhofar Explorer
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/landscapes.php">Landscapes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/historical.php">Historical Sites</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/markets.php">Markets</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/malls.php">Malls</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/restaurants.php">Restaurants</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>pages/hotels.php">Hotels</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>pages/mytrip.php">
                                <i class="fas fa-suitcase"></i> My Trip
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>login.php">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>register.php">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1">
