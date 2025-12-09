<?php
session_start();
include __DIR__ . '/hello.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$users = $conn->query("SELECT id, username FROM users WHERE id != $user_id ORDER BY username ASC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">

<script>
    const LOGGED_IN_USER = <?php echo $user_id; ?>;
</script>
<script src="scripts.js" defer></script>

</head>
<body>
<div class="topbar">
    <h2>Welcome to Chat!</h2>
    <div><a href="logout.php" class="btn">Logout</a></div>
</div>

<div class="container">
    <div class="users">
        <h3>Users</h3>
        <ul>
        <?php while($u = $users->fetch_assoc()){ ?>
            <li onclick="startChat(<?php echo $u['id']; ?>, '<?php echo addslashes($u['username']); ?>')">
                <?php echo htmlspecialchars($u['username']); ?>
            </li>
        <?php } ?>
        </ul>
    </div>

    <div class="chatbox" id="chatbox">
        <h3 id="chat_with">Select user to chat</h3>
        <div id="messages" class="messages"></div>
        <div class="composer">
            <input type="text" id="message" placeholder="Type message">
            <button id="sendBtn">Send</button>
        </div>
    </div>
</div>
</body>
</html>
