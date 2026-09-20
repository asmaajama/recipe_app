<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

    // Image upload
    $image = $_FILES["image"]["name"];
    $targetFolder = "uploads/recipe_images/";
    $targetFile = $targetFolder . basename($image);

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    $user_id = $_SESSION['user_id'];

    // Insert into database
    $sql = "INSERT INTO recipes (user_id, title, ingredients, instructions, image)
            VALUES ('$user_id', '$title', '$ingredients', '$instructions', '$image')";
    mysqli_query($conn, $sql);

    header("Location: browse.php");
    exit();
}
?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Add a New Recipe 🍳</h2>

<form method="post" enctype="multipart/form-data">

    <label>Recipe Title</label>
    <input type="text" name="title" placeholder="e.g., Creamy Chicken Alfredo" required>

    <label>Ingredients</label>
    <textarea name="ingredients" rows="6" placeholder="- 2 cups cream
- 1 cup cheese
- 250g pasta" required></textarea>

    <label>Instructions</label>
    <textarea name="instructions" rows="8" placeholder="Step 1...
Step 2...
Step 3..." required></textarea>

    <label>Recipe Image</label>
    <input type="file" name="image" required>

    <button type="submit">Submit Recipe</button>

</form>

<?php include 'includes/footer.php'; ?>
