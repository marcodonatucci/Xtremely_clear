<?php
// Avvia la sessione
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Controlla se l'utente è autenticato
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script>alert('Identità non verificata! Non hai permesso di usare questa funzionalità senza autenticazione.'); window.location='scopri.php';</script>";
    exit();
}

// Includi il file di configurazione per la connessione al database
include 'php/config_privilegiato.php';

// Verifica se il modulo è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Controlla che il contenuto non sia vuoto
    if (isset($_REQUEST['tweet']) && $_REQUEST['tweet']) {
        // Recupera il contenuto del tweet
        $content = trim($_REQUEST['tweet']);
    
        // Recupera l'ID dell'utente dalla sessione
        $username = $_SESSION['username'];

        //forzo la codifica dei dati del database
        mysqli_set_charset($conn, "utf8");

        // Prepara e esegui la query SQL per inserire il tweet nel database
        $sql = "INSERT INTO tweets (username, data, testo) VALUES (?, NOW(), ?)";
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "ss", $username, $content);

        if (mysqli_stmt_execute($statement)) {
            echo "<script>alert('Tweet inviato con successo!'); window.location='bacheca.php';</script>";
        } else {
            echo "<script>alert('Errore nell'invio del tweet! Riprova più tardi.'); window.location='scrivi.php';</script>";
            // Se non è stato inviato il modulo, reindirizza alla pagina scrivi.php
            exit();
        }
        mysqli_stmt_close( $statement);
        mysqli_close( $conn );
    } else {
        echo "<script>alert('Il tweet non può essere vuoto!'); window.location='scrivi.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<!--Impostazione dei metadati della pagina: lingua, codifica utf8, autore, breve descrizione,
viewport, icona da visualizzare, inclusione file css per gli stili, titolo della pagina-->
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Marco Donatucci">
    <meta name="keywords" lang="it" content="html">
    <meta name="description" content="Pagina per scrivere un tweet per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <title>Xtremely Clear - Scrivi</title>
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
        <div class="form-container">
            <h3>Scrivi un Tweet!</h3>
            <!--Form per la scrittura di un tweet composto da una textarea in cui inserire il testo del messaggio e un bottone per il submit-->
            <form action="scrivi.php" method="post">
                <label for="tweet">Testo (max 140 caratteri):</label>
                <textarea id="tweet" name="tweet" rows="4" maxlength="140" required></textarea>
                <button type="submit" class="btn">Invia</button>
            </form>
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
