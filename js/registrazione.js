function validateForm() {
    // Recupera i valori degli elementi HTML
    const name = document.getElementById('name').value;
    const surname = document.getElementById('surname').value;
    const birthdate = document.getElementById('birthdate').value;
    const address = document.getElementById('address').value;
    const nick = document.getElementById('nick').value;
    const password = document.getElementById('password').value;

    // Pattern di validazione
    const namePattern = /^[A-Z][a-zA-Z ]{1,11}$/;
    const surnamePattern = /^[A-Z][a-zA-Z ]{1,15}$/;
    const birthdatePattern = /^\d{4}-\d{1,2}-\d{1,2}$/;
    const addressPattern = /^(Via|Corso|Largo|Piazza|Vicolo) [a-zA-Z ]+ \d{1,4}$/;
    const nickPattern = /^[a-zA-Z][a-zA-Z0-9_-]{3,9}$/;
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=(?:.*\d){2})(?=(?:.*[#!?@%^&*+=]){2}).{8,16}$/;

    // Validazione del nome
    if (!namePattern.test(name)) {
        alert('Il nome non soddisfa i requisiti: deve essere lungo tra 2 e 12 caratteri, contenere solo lettere e spazi, e iniziare con una lettera maiuscola.');
        return false;
    }

    // Validazione del cognome
    if (!surnamePattern.test(surname)) {
        alert('Il cognome non soddisfa i requisiti: deve essere lungo tra 2 e 16 caratteri, contenere solo lettere e spazi, e iniziare con una lettera maiuscola.');
        return false;
    }

    // Validazione della data di nascita
    if (!birthdatePattern.test(birthdate)) {
        alert('La data di nascita non soddisfa i requisiti: deve essere nella forma "aaaa-mm-gg".');
        return false;
    }

    // Validazione del domicilio
    if (!addressPattern.test(address)) {
        alert('Il domicilio non soddisfa i requisiti: deve essere nella forma "Via/Corso/Largo/Piazza/Vicolo nome numeroCivico", con nome contenente solo lettere e spazi e numeroCivico composto da 1 a 4 cifre.');
        return false;
    }

    // Validazione dello username
    if (!nickPattern.test(nick)) {
        alert('Lo username non soddisfa i requisiti: deve essere lungo tra 4 e 10 caratteri, contenere solo lettere, numeri, "-" o "_", e iniziare con un carattere alfabetico.');
        return false;
    }

    // Validazione della password
    if (!passwordPattern.test(password)) {
        alert('La password non soddisfa i requisiti: deve essere lunga tra 8 e 16 caratteri, contenere almeno una lettera maiuscola, una lettera minuscola, due numeri e due caratteri speciali tra #!?@%^&*+=.');
        return false;
    }

    // Se tutte le validazioni passano, invio del modulo consentito
    return true;
}
