<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Se l'utente è già loggato, reindirizza alla pagina home.php
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: home.php");
    exit();
}

include 'php/config_normale.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_REQUEST['user']) && isset($_REQUEST['pwd'])){
        $username = trim($_REQUEST['user']);
        $password = trim($_REQUEST['pwd']);
    
        $sql = "SELECT * FROM utenti WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password === $row['pwd']) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;

                // Memorizza l'username in un cookie per 16 ore
                setcookie('last_username', $username, time() + 16 * 3600, '/');

                $_SESSION['success_message'] = 'Accesso effettuato con successo!';
                mysqli_close( $conn );
                header('Location: bacheca.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Password errata! Si prega di riprovare.';
                mysqli_close( $conn );
                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Username non trovato! Si prega di registrarsi.';
            mysqli_close( $conn );
            header('Location: registrazione.php');
            exit();
        }
    }
    mysqli_close( $conn );
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
    <meta name="description" content="Pagina di login per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <script src="js/login.js"></script>
    <title>Xtremely Clear - Login</title>
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
        if(isset($_SESSION['success_message'])) {
            echo '<div class="success">' . $_SESSION['success_message'] . '</div>';
            // Rimuovi il messaggio di errore dalla sessione dopo averlo visualizzato
            unset($_SESSION['success_message']);
        }
?>
    </div>
    <main>
        <!--Form per la procedura di autenticazione, due textfield relativi a username e password, bottone invia per fare il submit,
        bottone cancella per pulire i campi di testo e bottone per continuare senza autenticarsi con reindirizzameno diretto alla pagina scopri-->
        <div class="form-container">
            <h3>Login</h3>
            <form id="login" action="login.php" method="post">
                <label for="user">Username:</label>
                <input type="text" id="user" name="user" value="<?php echo isset($_COOKIE['last_username']) ?$_COOKIE['last_username'] : ''; ?>" required>
                
                <label for="pwd">Password:</label>
                <input type="password" id="pwd" name="pwd" required>
                
                <button id="btn3" type="submit" class="btn">Invia</button>
                <button id="btn4" type="button" class="btn" onclick="clearFields()">Cancella</button>
            </form>
            <button id="btn2" type="button" class="btn" onclick="continueWithoutLogin()">Continua senza autenticarsi</button>
        </div>
    </main>
     <!--Footer della pagina con indicazioni di copyright, contatti dell'autore (email) e indicazioni sulla pagina corrente-->
    <footer>
    <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it">Marco Donatucci</a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: Xtremely_clear/Login</p>
    </footer>
</body>
</html>
