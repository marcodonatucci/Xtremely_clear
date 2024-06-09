<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cancella tutte le variabili di sessione
session_unset();

// Distrugge la sessione
session_destroy();

// Reindirizza alla pagina home.php dopo il logout
echo "<script>alert('Logout effettuato con successo!'); window.location='../home.php';</script>";
exit();
