<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();
        }
    }

    $error = "Incorrect email or password.";
}
?>

<h2 style="text-align:center; margin-top:40px; font-size:32px;">Welcome Back 👋</h2>

<form method="post">

    <?php if (!empty($error)): ?>
        <p style="color:red; text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password" required>

    <button type="submit">Login</button>

    <p style="text-align:center; margin-top:10px;">
        Don't have an account? <a href="register.php" style="color:#7a5130; font-weight:600;">Register here</a>
    </p>
</form>

<?php include 'includes/footer.php'; ?>
