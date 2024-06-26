<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_REQUEST['name']) && isset($_REQUEST['surname']) && isset($_REQUEST['birthdate']) && isset($_REQUEST['address']) && isset($_REQUEST['nick']) && isset($_REQUEST['password'])){
        $name = trim($_REQUEST['name']);
        $surname = trim($_REQUEST['surname']);
        $birthdate = trim($_REQUEST['birthdate']);
        $address = trim($_REQUEST['address']);
        $nick = trim($_REQUEST['nick']);
        $pwd = trim($_REQUEST['password']);
        
        $namePattern = "/^[A-Z][\sA-Za-z]{1,11}$/";
        $surnamePattern = "/^[A-Z][\sA-Za-z]{1,15}$/";
        $birthdatePattern = "/^(?:\d{4}-(?:0?[1-9]|1[0-2])-(?:0?[1-9]|[12]\d|3[01]))$/";
        $addressPattern = "/^(Via|Corso|Largo|Piazza|Vicolo) [A-Za-z\s]+ \d{1,4}$/";
        $usernamePattern = "/^[A-Za-z][A-Za-z\d\-_]{3,9}$/";
        $pwdPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d{2,})(?=.*[#!?@%^&*+=]{2,})[A-Za-z\d#!?@%^&*+=]{8,16}$/";
          
            if( !preg_match($namePattern,$name) ) {
                $_SESSION['error_message'] = 'Formato nome non valido! Deve iniziare con una lettera maiuscola, contenere solo lettere e non deve superare i 12 caratteri';
                header('Location: registrazione.php');
                exit();
            }
            if( !preg_match($surnamePattern,$surname) ) {
                $_SESSION['error_message'] = 'Formato cognome non valido! Deve iniziare con una lettera maiuscola, contenere solo lettere e non deve superare i 16 caratteri';
                header('Location: registrazione.php');
                exit();
            }
            if( !preg_match($birthdatePattern,$birthdate) ) {
                $_SESSION['error_message'] = 'Formato data non valido!';
                header('Location: registrazione.php');
                exit();
            }
            if( !preg_match($addressPattern,$address) )  {
                $_SESSION['error_message'] = 'Formato indirizzo non valido! Domicilio deve essere nella forma “Via/Corso/Largo/Piazza/Vicolo
                nome numeroCivico”, dove nome può contenere caratteri alfabetici e spazi mentre numeroCivico
                `e un numero naturale composto da 1 a 4 cifre decimali.';
                header('Location: registrazione.php');
                exit();
            }
            if( !preg_match($usernamePattern, $nick) ) {
                $_SESSION['error_message'] = 'Formato username non valido! Deve essere una stringa lunga
                da 4 a 10 caratteri, con solo lettere, numeri e
                - o _ come valori ammessi e deve cominciare con un
                carattere alfabetico.';
                header('Location: registrazione.php');
                exit();
            }
            if( !preg_match($pwdPattern, $pwd) ) {
                $_SESSION['error_message'] = 'La password inserita non rispetta gli standard di sicurezza! Deve essere una stringa lunga da 8 a 16 caratteri, che puo’ contenere
                lettere, numeri e caratteri speciali, e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola,
                2 numeri e 2 caratteri speciali tra i seguenti (#!?@%^&*+=).';
                header('Location: registrazione.php');
                exit();
            }
            $today = date('Y-m-d');
            if($birthdate > $today) {
                $_SESSION['error_message'] = "La data di nascita non può essere nel futuro!";
                header("Location: registrazione.php"); // Cambia 'form_page.php' con la tua pagina del form
                exit();
            }
        }
        else{
          $_SESSION['error_message'] = 'Errore - Dati mancanti!';
          header('Location: registrazione.php');
          exit();
        }

        include 'php/config_privilegiato.php';

        // Controlla se l'username esiste già
        $sql_check = "SELECT username FROM utenti WHERE username = '$nick'";
        $result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error_message'] = 'Errore - L\'username '.$nick.' è già in uso. Scegli un altro username.';
            mysqli_close( $conn );
            header('Location: registrazione.php');
            exit();
        } else {
            $sql = "INSERT INTO utenti (nome, cognome, data, indirizzo, username, pwd)
                    VALUES ('$name', '$surname', '$birthdate', '$address', '$nick', '$pwd')";

            if (mysqli_query($conn, $sql) === TRUE) {
                $_SESSION['success_message'] = 'Registrazione avvenuta con successo!';
                mysqli_close( $conn );
                header('Location: login.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Errore durante la registrazione. Si prega di riprovare più tardi.';
                mysqli_close( $conn );
                header('Location: registrazione.php');
                exit();
            }
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
        <!--Form per la procedura di registrazione, contiene tutti i textfield relativi ai dati da inserire con l'attributo required 
        per i campi necessariamente da compilare, e l'attributo pattern che consente il controllo diretto della formattazione della
        stringa inserita in input dall'utente. Contiene inoltre il bottone Registrati per effettuare il submit, al submit viene 
        utilizzata la funzione di validazione del form definita nello script js esterno e incluso nel tag head della pagina corrente-->
        <div class="form-container">
            <h3>Registrazione</h3>
            <form id="signup" action="registrazione.php" method="post" onsubmit="return validateForm()">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="12" pattern="[A-Z][a-zA-Z ]*" placeholder="Inizia con maiuscola">
                
                <label for="surname">Cognome:</label>
                <input type="text" id="surname" name="surname" required minlength="2" maxlength="16" pattern="[A-Z][a-zA-Z ]*" placeholder="Inizia con maiuscola">
                
                <label for="birthdate">Data di Nascita:</label>
                <input type="date" id="birthdate" name="birthdate" required placeholder="aaaa-mm-gg" onfocus="dataLimitBirthdate()">
                
                <label for="address">Indirizzo:</label>
                <input type="text" id="address" name="address" required pattern="^(Via|Corso|Largo|Piazza|Vicolo) [a-zA-Z ]+ [0-9]{1,4}$" placeholder="Via nome numero">
                
                <label for="nick">Username:</label>
                <input type="text" id="nick" name="nick" required minlength="4" maxlength="10" pattern="[A-Za-z][A-Za-z0-9_-]*">
                <small>4-10 caratteri, lettere, numeri, '-' o '_'</small>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8" maxlength="16">
                <small>8-16 caratteri, maiuscola, minuscola, 2 numeri, 2 speciali</small>
                
                <button id="btn1" type="submit" class="btn">Registrati!</button>
            </form>
        </div>
    </main>
     <!--Footer della pagina con indicazioni di copyright, contatti dell'autore (email) e indicazioni sulla pagina corrente-->
    <footer>
    <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it">Marco Donatucci</a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: Xtremely_clear/Registrazione</p>
    </footer>
</body>
</html>
