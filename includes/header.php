<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Sharing App</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>

<header>
    <div class="logo">🌿 Recipe Haven</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="browse.php">Browse</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="add_recipe.php">Add Recipe</a>
            <a href="favorites.php">Favorites</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<main>
