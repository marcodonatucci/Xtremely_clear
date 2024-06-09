<?php
// Avvia la sessione
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script>alert('Identità non verificata! Non hai permesso di usare questa funzionalità senza autenticazione.'); window.location='scopri.php';</script>";
    exit();
}

// Includi il file di configurazione per la connessione al database
include 'php/config_normale.php';

// Ottieni l'ID dell'utente loggato
$username = $_SESSION['username'];

// Imposta le variabili per il filtro temporale
if(isset($_GET['start_date']) && isset($_GET['end_date'])){
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
}else{
    $start_date = null;
    $end_date = null;
}

// Crea la query SQL per recuperare i tweet dell'utente
$sql = "SELECT * FROM tweets WHERE username = ?";

if ($start_date && $end_date) {
    $sql .= " AND data BETWEEN ? AND ?";
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, "sss", $username, $start_date, $end_date);
} else {
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, "s", $username);
}

//forzo la codifica dei dati del database
mysqli_set_charset($conn, "utf8");

// Esegui la query
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result( $statement );
$tweets = [];
// Usa un ciclo while per estrarre i risultati
while ($row = mysqli_fetch_assoc($result)) {
    $tweets[] = $row;
}
mysqli_stmt_close($statement);
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
    <meta name="description" content="Pagina bacheca per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <title>Xtremely Clear - Bacheca</title>
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
    </div>
<main>
        <div class="tweet-container">
            <h3>Bacheca</h3>
            <!--Filtro temporale composto da un form per inserire due date, una di inizio e una di fine, e dal bottone filtra per il submit-->
            <form method="GET" action="bacheca.php">
                <label for="start_date">Data Inizio:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
                <label for="end_date">Data Fine:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
                <button type="submit" class="btn">Filtra</button>
            </form>
            
            <!--Visualizza i tweet, commentare!!-->
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
                    echo "<p class=\"no-tweets\">Non hai ancora scritto nessun tweet... Vai su scrivi e creane uno ora!</p>";
                }
            ?>
        </div>
    </main>
     <!--Footer della pagina con indicazioni di copyright, contatti dell'autore (email) e indicazioni sulla pagina corrente-->
    <footer>
    <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it"><span id="page_author"></span></a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: <span id="current_page"></span></p>
    </footer>
    <script>
        // Automazione per la visualizzazione del nome dell'autore e della pagina corrente
        // Il nome della pagina corrente viene estratto dal path della pagina 
        document.getElementById('current_page').innerText = window.location.pathname.split('/').pop().replace('.php', '');
        document.getElementById('page_author').innerText = 'Marco Donatucci';
    </script>
</body>
</html>
