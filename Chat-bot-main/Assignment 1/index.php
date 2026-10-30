<?php
require "db.php";

// ---- 1. Save a new message (POST) ----
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sender  = trim($_POST["sender"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($sender === "") {
        $sender = "Anonymous";
    }

    // mb_strlen counts characters, so non-English text is not rejected early
    if ($message !== "" && mb_strlen($message, "UTF-8") <= 500
        && mb_strlen($sender, "UTF-8") <= 30) {
        $stmt = $conn->prepare(
            "INSERT INTO messages (sender, message) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $sender, $message);
        $stmt->execute();
        $stmt->close();
    }

    // Post/Redirect/Get: a refresh will not resend the form
    header("Location: index.php");
    exit;
}

// ---- 2. Read the latest 50 messages ----
$result = $conn->query(
    "SELECT sender, message, created_at
     FROM messages
     ORDER BY id DESC
     LIMIT 50"
);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}
$messages = array_reverse($messages); // oldest first
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="15">
    <title>Network Chat</title>
</head>
<body>

<h2>Network Chat Room</h2>

<form method="POST">
    <input type="text" name="sender" placeholder="Your name"
           maxlength="30" size="12">
    <input type="text" name="message" placeholder="Type a message"
           maxlength="500" size="40" required>
    <button type="submit">Send</button>
</form>

<hr>

<h3>Messages</h3>

<?php foreach ($messages as $row): ?>
    <p>
        <b><?= htmlspecialchars($row["sender"], ENT_QUOTES, "UTF-8") ?>:</b>
        <?= htmlspecialchars($row["message"], ENT_QUOTES, "UTF-8") ?>
        <br>
        <small><?= htmlspecialchars($row["created_at"], ENT_QUOTES, "UTF-8") ?></small>
    </p>
    <hr>
<?php endforeach; ?>

</body>
</html>
