<?php
$servername = "localhost";
$username = "privilegiato";
$password = "SuperPippo!!!";
$dbname = "social_network";
$port = 3307;

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
