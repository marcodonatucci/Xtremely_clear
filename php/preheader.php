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
    $statement = mysqli_prepare( $conn, $sql );
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result($statement, $tweet );
    if (mysqli_stmt_fetch($statement)) {
        $lastTweet = substr($tweet, 0, 30);
    }
    mysqli_stmt_close( $statement );
}

if ($username) {
    printf('<div class="user-info">
                <div class="username">%s</div>
                <p class="last-tweet">%s</p>
            </div>', $username, $lastTweet);
}
