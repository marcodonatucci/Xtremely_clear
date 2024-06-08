<?php
$servername = "localhost";
$username = "normale";
$password = "posso_leggere?";
$dbname = "social_network";

// Crea connessione
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controlla la connessione
if (mysqli_connect_errno()) {
    printf ("<p>errore - collegamento al DB impossibile: %s</p>\n", mysqli_connect_error());
}

if (!mysqli_close($con));{
    printf ("<p>errore di chiusura connessione - impossibile rilasciare le risorse</p>\n");
}

