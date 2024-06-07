// Funzione per cancellare il contenuto dei campi del modulo di login
function clearFields() {
    // Recupera gli elementi HTML con l'id "user" e "pwd" relativi ai campi compilabili di username e password, 
    //e imposta il loro valore a una stringa vuota in modo da svuotarli
    document.getElementById("user").value = "";
    document.getElementById("pwd").value = "";
}

// Funzione per continuare senza autenticarsi
function continueWithoutLogin() {
    // Visualizza il messaggio sulla finestra e reindirizza alla pagina scopri, accessibile anche ad utenti non autenticati
    alert("Continua senza autenticarsi");
    window.location='scopri.php';
}