<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $pass     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password, role)
            VALUES ('$username', '$email', '$pass', 'user')";
    mysqli_query($conn, $sql);

    header("Location: login.php");
    exit();
}
?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Create an Account ✨</h2>

<form method="post">

    <label>Username</label>
    <input type="text" name="username" placeholder="Choose a username" required>

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Create a password" required>

    <button type="submit">Register</button>

    <p style="text-align:center; margin-top:10px;">
        Already have an account? <a href="login.php" style="color:#7a5130; font-weight:600;">Login here</a>
    </p>

</form>

<?php include 'includes/footer.php'; ?>
