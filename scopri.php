<?php
// Avvia la sessione
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Includi il file di configurazione per la connessione al database
include 'php/config_normale.php';

//forzo la codifica dei dati del database
mysqli_set_charset($conn, "utf8");

// Recupera tutti i tweet dal database
$sql = "SELECT * FROM `tweets`
        ORDER BY tweets.data DESC";
$result = mysqli_query($conn, $sql);

// Controlla se ci sono risultati
$tweets = [];
if (mysqli_num_rows($result) > 0) {
    while( $row = mysqli_fetch_assoc($result)) {
        $tweet = array(
            'username' => $row['username'],
            'data' => $row['data'],
            'testo' => $row['testo']
        );
        $tweets[] = $row;
    }
}
mysqli_close( $conn );
?>
<!DOCTYPE html>
<!--Impostazione dei metadati della pagina: lingua, codifica utf8, autore, breve descrizione,
viewport, icona da visualizzare, inclusione file css per gli stili, titolo della pagina-->
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Marco Donatucci">
    <meta name="keywords" lang="it" content="html">
    <meta name="description" content="Pagina esplora per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <title>Xtremely Clear - Scopri</title>
</head>
<body>
    <?php include 'php/preheader.php'; ?>
    <!--Costruzione header con logo e nome del sito-->
    <header>
        <img src="images/image1.png" alt="Immagine iniziale">
        <div>
            <h1>Xtremely Clear</h1>
        </div>
    </header>
    <div>   
        <!--Menu di navigazione composto da una lista di voci ognuna con un riferimento ad una pagina per il reindirizzamento-->
    <nav>
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="registrazione.php">REGISTRA</a></li>
            <li><a href="bacheca.php" class="<?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? '' : 'disabled'; ?>">BACHECA</a></li>
            <li><a href="scrivi.php" class="<?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? '' : 'disabled'; ?>">SCRIVI</a></li>
            <li><a href="login.php" class="<?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? 'disabled' : ''; ?>">LOGIN</a></li>
            <li><a href="scopri.php">SCOPRI</a></li>
            <li><a href="php/logout.php" class="<?php echo (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? '' : 'disabled'; ?>">LOGOUT</a></li>
        </ul>
    </nav>
    <?php
        // Mostra il messaggio di errore se esiste
        if (isset($_SESSION['error_message'])) {
            echo '<div class="err">' . $_SESSION['error_message'] . '</div>';
            // Rimuovi il messaggio di errore dalla sessione dopo averlo visualizzato
            unset($_SESSION['error_message']);
        }
    ?>
    </div>
<main>
<div class="tweet-container">
            <!--Visualizzazione di tutti i tweet contenuti nel database in un elenco, commenta!!-->
            <h3>Tutti i Tweet</h3>
            <!-- Verifica se ci sono tweet, commenta!! -->
            <?php 
                if (count($tweets) > 0){
                    foreach ($tweets as $tweet){
                            echo "<div class=\"tweet\">";
                            echo "<div class=\"header\">";
                            echo "<span class=\"author\">".$tweet['username']."</span>";
                            echo "<span class=\"date\">".$tweet['data']."</span>";
                            echo "</div>";
                            echo "<p class=\"content\">".$tweet['testo']."</p>";
                            echo "</div>";
                    }
                } else {
                    echo "<p class=\"no-tweets\">Non ci sono tweet da visualizzare!</p>";
                }
            ?>
</div>
</main>
     <!--Footer della pagina con indicazioni di copyright, contatti dell'autore (email) e indicazioni sulla pagina corrente-->
    <footer>
    <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it">Marco Donatucci</a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: Xtremely_clear/Scopri</p>
    </footer>
</body>
</html>
