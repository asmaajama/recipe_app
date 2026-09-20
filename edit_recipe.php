<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM recipes WHERE id = $id";
$result = mysqli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($result);

if (!$recipe) {
    echo "<p style='text-align:center; color:red;'>Recipe not found.</p>";
    include 'includes/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

    // Update image only if a new image is uploaded
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $target = "uploads/recipe_images/" . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);

        $imageSQL = ", image='$image'";
    } else {
        $imageSQL = "";
    }

    $sql = "UPDATE recipes 
            SET title='$title', ingredients='$ingredients', instructions='$instructions' $imageSQL
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: recipe.php?id=$id");
    exit();
}
?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Edit Recipe ✏️</h2>

<form method="post" enctype="multipart/form-data">

    <label>Recipe Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>

    <label>Ingredients</label>
    <textarea name="ingredients" rows="6" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>

    <label>Instructions</label>
    <textarea name="instructions" rows="8" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>

    <label>Current Image</label><br>
    <img src="uploads/recipe_images/<?php echo $recipe['image']; ?>" 
         alt="Current Image" 
         style="width:180px; height:120px; object-fit:cover; border-radius:8px; margin-bottom:15px;">

    <label>Upload New Image (optional)</label>
    <input type="file" name="image">

    <button type="submit">Save Changes</button>

</form>

<?php include 'includes/footer.php'; ?>
