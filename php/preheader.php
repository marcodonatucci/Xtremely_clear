<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config_normale.php';

$username = '';
$lastTweet = '';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $username = $_SESSION['username'];

    mysqli_set_charset($conn, "utf8");

    // Recupera l'ultimo tweet dell'utente
    $sql = "SELECT testo FROM tweets WHERE username = ? ORDER BY data DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($tweet);
    if ($stmt->fetch()) {
        $lastTweet = substr($tweet, 0, 30);
    }
    $stmt->close();
}
?>
    <?php if ($username): ?>
        <div class="user-info">
            <div class="username"><?php echo $username; ?></div>
            <p class="last-tweet"><?php echo $lastTweet; ?></p>
        </div>
    <?php endif; ?>
