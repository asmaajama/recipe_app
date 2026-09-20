<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.user_id = users.id
        WHERE recipes.id = $id";

$result = mysqli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($result);
?>

<!-- Recipe Container -->
<div style="max-width: 850px; margin: 50px auto; background:white; padding:30px; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1);">

    <!-- Recipe Image -->
    <img src="uploads/recipe_images/<?php echo $recipe['image']; ?>" 
         alt="Recipe Image" 
         style="width:100%; height:380px; object-fit:cover; border-radius:12px;">

    <!-- Title + Author -->
    <h1 style="margin-top:25px; font-size:36px;"><?php echo $recipe['title']; ?></h1>
    <p style="color:#777; font-size:16px; margin-bottom:30px;">
        By <strong><?php echo $recipe['username']; ?></strong>
    </p>

    <!-- Ingredients -->
    <h2 style="font-size:26px; margin-bottom:10px;">Ingredients</h2>
    <div style="background:#f7f6f2; padding:18px; border-radius:10px; white-space:pre-wrap; margin-bottom:30px;">
        <?php echo htmlspecialchars($recipe['ingredients']); ?>
    </div>

    <!-- Instructions -->
    <h2 style="font-size:26px; margin-bottom:10px;">Instructions</h2>
    <div style="background:#f7f6f2; padding:18px; border-radius:10px; white-space:pre-wrap;">
        <?php echo htmlspecialchars($recipe['instructions']); ?>
    </div>

    <!-- Buttons -->
    <div style="margin-top:30px; display:flex; gap:15px; flex-wrap:wrap;">
        <?php if (isset($_SESSION['user_id'])): ?>

            <!-- Favorite Button -->
            <a class="btn" href="favorite_add.php?id=<?php echo $recipe['id']; ?>">
                Add to Favorites ❤️
            </a>

            <!-- Edit + Delete for owner or admin -->
            <?php if ($_SESSION['role'] === 'admin' || $_SESSION['user_id'] == $recipe['user_id']): ?>
                <a class="btn" href="edit_recipe.php?id=<?php echo $recipe['id']; ?>">Edit</a>
                <a class="btn" style="background:#b33939;" href="delete_recipe.php?id=<?php echo $recipe['id']; ?>">Delete</a>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
