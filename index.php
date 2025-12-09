<?php
session_start();
include 'hello.php';

if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res && $res->num_rows > 0){
        $row = $res->fetch_assoc();

        if(password_verify($pass, $row['password'])){
            $_SESSION['student'] = $row['id'];  
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="center">
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>No account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
