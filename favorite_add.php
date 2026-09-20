<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user_id'];
$recipe = $_GET['id'];

// Prevent duplicate favorites
$check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id='$user' AND recipe_id='$recipe'");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO favorites (user_id, recipe_id) VALUES ('$user', '$recipe')");
}

header("Location: favorites.php");
exit();
?>
