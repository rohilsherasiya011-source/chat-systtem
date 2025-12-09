<?php
include 'hello.php';
session_start();

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $passRaw  = $_POST['password'];

    if($username === "" || $email === "" || $passRaw === ""){
        $error = "All fields required.";
    } else {
        $password = password_hash($passRaw, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if($stmt->execute()){
            $_SESSION['user_id'] = $stmt->insert_id;
            $stmt->close();
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="center">
    <h2>Signup</h2>
    <?php if(isset($error)) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
    <form method="POST" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="submit" value="Register">
    </form>
    <p>Already have account? <a href="index.php">Login</a></p>
</div>
</body>
</html>
