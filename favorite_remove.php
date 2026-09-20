<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user_id'];
$recipe = $_GET['id'];

// Remove ONLY the favorite entry (not the recipe)
$sql = "DELETE FROM favorites WHERE user_id='$user' AND recipe_id='$recipe'";
mysqli_query($conn, $sql);

header("Location: favorites.php");
exit();
?>
