
// Funzione per la validazione della password scelta durante la registrazione di un nuovo utente
function validateForm() {
    // Recupera il valore dell'elemento HTML con l'id "password"
    const password = document.getElementById('password').value;
    // Definisce un pattern regex per validare la password: stringa lunga tra 8 e 16 caratteri {8,16}, deve contenere almeno
    // una lettera maiuscola e una minuscola (primi due termini), due numeri e due caratteri speciali tra quelli forniti (ultimi due termini)
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=(?:.*\d){2})(?=(?:.*[#!?@%^&*+=]){2}).{8,16}$/;
            
    if (!passwordPattern.test(password)) {
        // Verifica di corrispondenza del pattern e alert con indicazioni in caso di requisiti non soddisfatti
        alert('La password non soddisfa i requisiti: deve essere lunga tra 8 e 16 caratteri, contenere almeno una lettera maiuscola, una lettera minuscola, due numeri e due caratteri speciali tra #!?@%^&*+=.');
        return false;
    }
    // Invio del modulo consentito
    return true;
}