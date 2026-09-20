<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Explore Recipes 🍽️</h2>

<div class="recipe-grid">
<?php
$sql = "SELECT * FROM recipes ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)):
?>
    <div class="recipe-card">
        <img src="uploads/recipe_images/<?php echo $row['image']; ?>" alt="Recipe Image">

        <div class="recipe-card-content">
            <h3><?php echo $row['title']; ?></h3>
            <a class="btn" style="margin-top:10px; display:inline-block;"
               href="recipe.php?id=<?php echo $row['id']; ?>">
               View Recipe
            </a>
        </div>
    </div>
<?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
