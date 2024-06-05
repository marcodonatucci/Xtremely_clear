<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Marco Donatucci">
    <meta name="keywords" lang="it" content="html">
    <meta name="description" content="Pagina di registrazione per Xtremely Clear">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="css/style_X.css">
    <title>Xtremely Clear - Registrazione</title>
</head>
<body>
    <header>
        <img src="images/image1.png" alt="Immagine iniziale">
        <div>
            <h1>Xtremely Clear</h1>
            <blockquote>Registrati per entrare nel social più trasparente del web</blockquote>
        </div>
    </header>
    <div>   
            <nav>
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="registrazione.php">REGISTRA</a></li>
                    <li><a href="bacheca.php">BACHECA</a></li>
                    <li><a href="scrivi.php">SCRIVI</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="scopri.php">SCOPRI</a></li>
                    <?php
                    session_start();
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                        echo '<li><a href="logout.php">LOGOUT</a></li>';
                    }
                    ?>
                </ul>
            </nav>

<style>
    /* Stili per il menu di navigazione */
    nav {
        text-align: center;
        margin-top: 20px;
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #ffffff;
        transition: color 0.3s ease;
    }

    nav ul li a:hover {
        color: #1DA1F2; /* Rosso */
    }

    /* Stili per il menu di navigazione quando l'utente è autenticato */
    <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        echo 'nav ul li a[href="login.php"] {';
        echo 'display: none;';
        echo '}';
        echo 'nav ul li a[href="logout.php"] {';
        echo 'display: inline;';
        echo '}';
    } else {
        echo 'nav ul li a[href="login.php"] {';
        echo 'display: inline;';
        echo '}';
        echo 'nav ul li a[href="logout.php"] {';
        echo 'display: none;';
        echo '}';
    }
    ?>
</style></div>
    <main>
        <div class="form-container">
            <h3>Registrazione</h3>
            <form action="registrazione.php" method="post">
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
                <input type="password" id="password" name="password" required minlength="8" maxlength="16" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d{2})(?=.*[#!?@%^&*+=]{2}).{8,16}$">
                
                <button type="submit" class="btn">Registrati</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it">Elon Musk</a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: Xtremely_clear/Registrazione</p>
    </footer>
</body>
</html>
