<?php
// Start sessie voor eventuele login later
session_start();

// Database connectie
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Rockstar Events</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a2e;
            color: white;
            line-height: 1.6;
        }

        /* Navigatie */
        nav {
            background-color: #0f0f1a;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ff3366;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ff3366;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover, nav a.active {
            color: #ff3366;
        }

        /* Content */
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
            color: #ff3366;
            margin-bottom: 20px;
            font-size: 36px;
        }

        h2 {
            color: #ff3366;
            margin: 30px 0 15px 0;
        }

        /* Footer */
        footer {
            background-color: #0f0f1a;
            text-align: center;
            padding: 30px;
            border-top: 2px solid #ff3366;
            margin-top: 50px;
        }

        footer p {
            color: #888;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Navigatie -->
    <nav>
        <a href="index.php" class="logo">Rockstar Events</a>
        <ul>
            <li><a href="index.php" <?php if($pageTitle == 'Home') echo 'class="active"'; ?>>Home</a></li>
            <li><a href="evenementen.php" <?php if($pageTitle == 'Evenementen') echo 'class="active"'; ?>>Evenementen</a></li>
            <li><a href="artiesten.php" <?php if($pageTitle == 'Artiesten') echo 'class="active"'; ?>>Artiesten</a></li>
            <li><a href="podia.php" <?php if($pageTitle == 'Podia') echo 'class="active"'; ?>>Podia</a></li>
            <li><a href="optredens.php" <?php if($pageTitle == 'Optredens') echo 'class="active"'; ?>>Optredens</a></li>
        </ul>
    </nav>

    <div class="content">
