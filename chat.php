<?php
include __DIR__ . '/hello.php';

if(isset($_POST['sender_id']) && isset($_POST['receiver_id'])){
    $sender = (int) $_POST['sender_id'];
    $receiver = (int) $_POST['receiver_id'];

    // SEND MESSAGE
    if(isset($_POST['message'])){
        $msg = $conn->real_escape_string($_POST['message']);
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender, $receiver, $msg);
        $stmt->execute();
        $stmt->close();
        exit;
    }

    // LOAD MESSAGES
    $sql = "SELECT m.*, u.username AS sender_name
            FROM messages m
            LEFT JOIN users u ON u.id = m.sender_id
            WHERE 
                (m.sender_id=$sender AND m.receiver_id=$receiver)
            OR  (m.sender_id=$receiver AND m.receiver_id=$sender)
            ORDER BY m.timestamp ASC";

    $messages = $conn->query($sql);
    $output = "";

    while($m = $messages->fetch_assoc()){
        $cls = ($m['sender_id'] == $sender) ? 'me' : 'other';
        $name = htmlspecialchars($m['sender_name']);
        $text = htmlspecialchars($m['message']);

        $output .= "<p class='$cls'><strong>$name:</strong> $text</p>";
    }

    echo $output;
}
?>
