<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Your Favorite Recipes ❤️</h2>

<div class="recipe-grid">
<?php
$user = $_SESSION['user_id'];

$sql = "SELECT recipes.* 
        FROM recipes
        JOIN favorites ON recipes.id = favorites.recipe_id
        WHERE favorites.user_id = $user";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0): ?>
    <p style="text-align:center; width:100%; font-size:18px; margin-top:40px; color:#777;">
        You haven't added any favorites yet.
    </p>

<?php 
else:
    while ($row = mysqli_fetch_assoc($result)):
?>
    <div class="recipe-card">
        <img src="uploads/recipe_images/<?php echo $row['image']; ?>" alt="Recipe Image">

        <div class="recipe-card-content">
            <h3><?php echo $row['title']; ?></h3>

            <!-- View Recipe -->
            <a class="btn" 
               href="recipe.php?id=<?php echo $row['id']; ?>" 
               style="margin-top:10px; display:inline-block;">
                View Recipe
            </a>

            <!-- Remove from Favorites -->
            <a class="btn" 
               href="favorite_remove.php?id=<?php echo $row['id']; ?>" 
               style="background:#b33939; margin-top:10px; display:inline-block;">
                Remove ❌
            </a>

        </div>
    </div>

<?php 
    endwhile; 
endif;
?>
</div>

<?php include 'includes/footer.php'; ?>
