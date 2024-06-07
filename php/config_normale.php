<?php
$servername = "localhost";
$username = "normale";
$password = "posso_leggere?";
$dbname = "social_network";
$port = 3307;

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

