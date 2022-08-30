<?php
$nomeErr = $emailErr = $giornoErr = $oraArrivoErr = $oraPartenzaErr = $numTavoloErr = $numPostoErr = "";
$nome = $email = $giorno = $ora_arrivo = $ora_partenza = $num_tavolo = $num_posto = '';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome_utente'];
    $email = $_POST['email_utente'];
    $giorno = $_POST['giorno_prenotazione'];
    $ora_arrivo = $_POST['ora_arrivo'];
    $ora_partenza = $_POST['ora_partenza'];
    $num_tavolo = $_POST['num_tavolo'];
    $num_posto = $_POST['num_posto'];

    if (empty($_POST['nome_utente']) || empty($_POST['email_utente']) || empty($_POST['giorno_prenotazione']) || empty($_POST['ora_arrivo']) || empty($_POST['ora_partenza']) || empty($_POST['num_tavolo']) || empty($_POST['num_posto'])) {

        if (empty($_POST['nome_utente']) || !preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $nomeErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['email_utente']) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['giorno_prenotazione'])) {
            $giornoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['ora_arrivo'])) {
            $oraArrivoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['ora_partenza'])) {
            $oraPartenzaErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['num_tavolo'])) {
            $numTavoloErr = "<span class='error-field'>Inserisci campo</span>";

        }
        if (empty($_POST['num_posto'])) {
            $numPostoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        echo "<p class='error-field'>ERRORE inserimento: Compila tutti i campi</p>";
    } else {
        $wpdb->insert($db_table_name, [
            'nome_utente' => $nome,
            'email_utente' => $email,
            'giorno_prenotazione' => $giorno,
            'ora_arrivo' => $ora_arrivo,
            'ora_partenza' => $ora_partenza,
            'num_tavolo' => $num_tavolo,
            'num_posto' => $num_posto
        ]);
    }
}
