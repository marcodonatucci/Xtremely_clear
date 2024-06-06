<!DOCTYPE html>
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
    <header>
        <img src="images/image1.png" alt="Immagine iniziale">
        <div>
            <h1>Xtremely Clear</h1>
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
        <div class="tweet-container">
            <h3>Bacheca</h3>
            <!-- Qui puoi inserire la logica per visualizzare i tweet dell'utente -->
            <!-- Esempio di struttura di un singolo tweet -->
            <div class="tweet">
                <span class="author">Nome Autore</span>
                <span class="date">Data e Ora</span>
                <p class="content">Contenuto del Tweet</p>
            </div>
            <!-- Fine esempio -->
            <p class="no-tweets">Non hai ancora scritto nessun tweet. Scrivine uno ora!</p>
            <!-- Qui puoi inserire il filtro per visualizzare i tweet in un intervallo temporale -->
        </div>
    </main>
    <footer>
        <p>Copyright &copy; 2024 <a href="mailto:s293556@studenti.polito.it">Elon Musk</a>. Tutti i diritti riservati.</p>
        <p>Pagina corrente: Xtremely_clear/Bacheca</p>
    </footer>
</body>
</html>
