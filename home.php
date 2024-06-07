<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
    <meta name="description" content="Simulazione sito web X">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <title>Xtremely Clear - Home</title>
</head>
<body>
    <?php include 'php/preheader.php'; ?>
    <!--Costruzione header con logo e nome del sito, seguito da una serie di 3 citazioni e un container contenente i bottoni per il reindirizzamento
    alla pagina di registrazione oppure di login per l'autenticazione-->
    <header>
        <img src="images/image1.png" alt="Immagine iniziale">
        <div>
            <h1>Xtremely Clear</h1>
            <blockquote>You can't ban me anymore - Donald Trump</blockquote>
            <blockquote>L'unico social ammesso nei seminari - Papa Francesco</blockquote>
            <blockquote>Lo mas guapo que hay - Antonio Banderas</blockquote>
            <div class="signup-container">
                <p>Non hai ancora un account?</p>
                <button class="btn" onclick="window.location.href='registrazione.php'">Registrati ora!</button>
                <div class="separator"></div>
                <p>Hai già un account? Accedi adesso!</p>
                <button class="btn" onclick="window.location.href='login.php'">Accedi</button>    
            </div>
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
        <!--Menu dropdown con un elenco delle funzionalità del social-->
        <h3>Cosa troverai qui</h3>
        <ul class="dropdown-menu">
            <li>Gestione dell'account semplificata, anche tua nonna riuscirà ad usarlo!</li>
            <li>Condividi i tuoi pensieri in tutto il mondo!</li>
            <li>Entra in contatto con nuove persone che hanno i tuoi stessi interessi!</li>
        </ul>
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
<!--lista di cose cercate su W3School: button, blockquote, form con i bottoni su yt, textarea-->