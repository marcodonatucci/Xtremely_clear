<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'php/config_privilegiato.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['name']);
    $cognome = mysqli_real_escape_string($conn, $_POST['surname']);
    $data = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $indirizzo = mysqli_real_escape_string($conn, $_POST['address']);
    $username = mysqli_real_escape_string($conn, $_POST['nick']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    // Controlla se l'username esiste già
    $sql_check = "SELECT username FROM utenti WHERE username = '$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "<script>alert('Errore: l\'username \"$username\" è già in uso. Scegli un altro username.');</script>";
    } else {
        $sql = "INSERT INTO utenti (nome, cognome, data, indirizzo, username, pwd)
                VALUES ('$nome', '$cognome', '$data', '$indirizzo', '$username', '$pwd')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registrazione avvenuta con successo'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Errore durante la registrazione. Si prega di riprovare più tardi.');</script>";
        }
    }
    $conn->close();
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
    <meta name="description" content="Pagina di registrazione per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <script src="js/registrazione.js"></script>
    <title>Xtremely Clear - Registrazione</title>
</head>
<body>
    <?php include 'php/preheader.php'; ?>
    <!--Costruzione header con logo e nome del sito-->
    <header>
        <img src="images/image1.png" alt="Immagine iniziale">
        <div>
            <h1>Xtremely Clear</h1>
            <blockquote>Registrati per entrare nel social più trasparente del web</blockquote>
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
        <!--Form per la procedura di registrazione, contiene tutti i textfield relativi ai dati da inserire con l'attributo required 
        per i campi necessariamente da compilare, e l'attributo pattern che consente il controllo diretto della formattazione della
        stringa inserita in input dall'utente. Contiene inoltre il bottone Registrati per effettuare il submit, al submit viene 
        utilizzata la funzione di validazione del form definita nello script js esterno e incluso nel tag head della pagina corrente-->
        <div class="form-container">
            <h3>Registrazione</h3>
            <form action="registrazione.php" method="post" onsubmit="return validateForm()">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="12" pattern="[A-Z][a-zA-Z ]*">
                
                <label for="surname">Cognome:</label>
                <input type="text" id="surname" name="surname" required minlength="2" maxlength="16" pattern="[A-Z][a-zA-Z ]*">
                
                <label for="birthdate">Data di Nascita:</label>
                <input type="date" id="birthdate" name="birthdate" required>
                
                <label for="address">Indirizzo:</label>
                <input type="text" id="address" name="address" required pattern="^(Via|Corso|Largo|Piazza|Vicolo) [a-zA-Z ]+ [0-9]{1,4}$">
                
                <label for="nick">Username:</label>
                <input type="text" id="nick" name="nick" required minlength="4" maxlength="10" pattern="[A-Za-z][A-Za-z0-9_-]*">
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8" maxlength="16">
                
                <button type="submit" class="btn">Registrati!</button>
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
