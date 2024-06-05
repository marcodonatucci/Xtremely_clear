<!-- File: config.php -->

<?php
// Credenziali per la connessione al database MySQL
$servername = "localhost"; // Host del database
$username = "nome_utente"; // Nome utente del database
$password = "password"; // Password del database
$dbname = "nome_database"; // Nome del database

// Connessione al database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>
