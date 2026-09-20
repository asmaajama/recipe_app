<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Fetch recipe info
$sql = "SELECT * FROM recipes WHERE id = $id";
$result = mysqli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($result);

if (!$recipe) {
    echo "<p style='text-align:center; color:red;'>Recipe not found.</p>";
    include 'includes/footer.php';
    exit();
}

// If delete confirmed
if (isset($_POST['confirm_delete'])) {
    $sqlDelete = "DELETE FROM recipes WHERE id = $id";
    mysqli_query($conn, $sqlDelete);

    echo "<script>alert('Recipe deleted successfully.'); window.location='browse.php';</script>";
    exit();
}
?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Delete Recipe ❌</h2>

<div style="max-width:600px; margin:40px auto; background:white; padding:25px; border-radius:12px; text-align:center; box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <p style="font-size:18px; margin-bottom:20px;">
        Are you sure you want to delete this recipe?
    </p>

    <h3 style="margin-bottom:15px;"><?php echo $recipe['title']; ?></h3>

    <img src="uploads/recipe_images/<?php echo $recipe['image']; ?>" 
         style="width:250px; height:180px; object-fit:cover; border-radius:10px; margin-bottom:20px;">

    <form method="post" style="margin-top:20px;">
        <button type="submit" name="confirm_delete" style="background:#b33939; padding:12px 20px; border-radius:8px;">
            Yes, Delete
        </button>

        <a href="recipe.php?id=<?php echo $id; ?>" 
           class="btn" 
           style="background:#3e5c34; padding:12px 20px; border-radius:8px; margin-left:10px;">
           Cancel
        </a>
    </form>

</div>

<?php include 'includes/footer.php'; ?>
