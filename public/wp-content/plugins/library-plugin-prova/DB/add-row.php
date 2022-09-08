<?php
$nomeErr = $emailErr = $stanzaErr = $giornoErr = $oraArrivoErr = $oraPartenzaErr = $tuttoIlGiornoErr = $idPostoErr = "";
$nome = $email = $stanza = $giorno = $ora_arrivo = $ora_partenza =  $tutto_il_giorno = $id_posto = '';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome_utente'];
    $email = $_POST['email_utente'];
    $stanza = $_POST['stanza'];
    $giorno = $_POST['giorno'];
    $ora_arrivo = $_POST['ora_arrivo'];
    $ora_partenza = $_POST['ora_partenza'];
    $tutto_il_giorno = $_POST['tutto_il_giorno'];
    $id_posto = $_POST['id_posto'];

    if (empty($_POST['nome_utente']) || empty($_POST['email_utente']) || empty($_POST['stanza']) || empty($_POST['giorno']) || empty($_POST['ora_arrivo']) || empty($_POST['ora_partenza']) || empty($_POST['tutto_il_giorno']) || empty($_POST['id_posto'])) {

        if (empty($_POST['nome_utente']) || !preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $nomeErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['email_utente']) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['stanza'])) {
            $stanzaErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['giorno'])) {
            $giornoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['ora_arrivo'])) {
            $oraArrivoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['ora_partenza'])) {
            $oraPartenzaErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['tutto_il_giorno'])) {
            $tuttoIlGiornoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        if (empty($_POST['id_posto'])) {
            $idPostoErr = "<span class='error-field'>Inserisci campo</span>";
        }
        echo "<p class='error-field'>ERRORE inserimento: Compila tutti i campi</p>";
    } else {
        $wpdb->insert($db_table_prenotazione, [
            'nome_utente' => $nome,
            'email_utente' => $email,
            'stanza' => $stanza,
            'giorno' => $giorno,
            'ora_arrivo' => $ora_arrivo,
            'ora_partenza' => $ora_partenza,
            'tutto_il_giorno' => $tutto_il_giorno,
            'id_posto' => $id_posto
        ]);
    }
}
