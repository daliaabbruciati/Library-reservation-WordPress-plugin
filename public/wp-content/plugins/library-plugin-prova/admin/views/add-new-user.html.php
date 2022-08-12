<?php

$nomeErr = $emailErr = $giornoErr = $oraArrivoErr = $oraPartenzaErr = $idTavoloErr = $idPostoErr = "";
$nome = $email = $giorno = $ora_arrivo = $ora_partenza = $id_tavolo = $id_posto = '';


if ($_SERVER["REQUEST_METHOD"] === "POST" && checkEmptyField($_POST)) {


    if (empty($_POST['nome_utente'])) {
        $nomeErr = "Inserisci campo";
    } else {
        $nome = test_input($_POST['nome_utente']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $nameErr = "Formato nome non valido";
        }
    }
    if (empty($_POST['email_utente'])) {
        $emailErr = "Inserisci campo";
    } else {
        $email = test_input($_POST['email_utente']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato email non valido";
        }
    }
    if (empty($_POST['giorno_prenotazione'])) {
        $giornoErr = "Inserisci campo";
    } else {
        $giorno = test_input($_POST['giorno_prenotazione']);
    }
    if (empty($_POST['ora_arrivo'])) {
        $oraArrivoErr = "Inserisci campo";
    } else {
        $ora_arrivo = test_input($_POST['ora_arrivo']);
    }
    if (empty($_POST['ora_partenza'])) {
        $oraPartenzaErr = "Inserisci campo";
    } else {
        $ora_partenza = test_input($_POST['ora_partenza']);
    }
    if (empty($_POST['id_tavolo'])) {
        $idTavoloErr = "Inserisci campo";
    } else {
        $id_tavolo = test_input($_POST['id_tavolo']);
    }
    if (empty($_POST['id_posto'])) {
        $idPostoErr = "Inserisci campo";
    } else {
        $id_posto = test_input($_POST['id_posto']);
    }

    print_r($_POST);

    global $wpdb;
    $table_name = $wpdb->prefix . 'library_users';
    $wpdb->insert($table_name, [
        'nome_utente' => $nome,
        'email_utente' => $email,
        'giorno_prenotazione' => $giorno,
        'ora_arrivo' => $ora_arrivo,
        'ora_partenza' => $ora_partenza,
        'id_tavolo' => $id_tavolo,
        'id_posto' => $id_posto
    ]);

}

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkEmptyField($field){
    if($field == ''){
        echo 'Non hai riempito tutti i campi';
    }
}

?>


<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <p>Compila tutti i campi e poi clicca su 'Aggiungi' per inserire un nuovo utente</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container"
              method="post"
              action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <label for="nome_utente">Nome
                <div>
                    <input type="text" name="nome_utente" id="nome_utente"
                           placeholder="Inserisci nome utente"><span>* <?= $nomeErr; ?></span>
                </div>
            </label>

            <label for="email_utente">Email
                <div>
                    <input type="text" name="email_utente" id="email_utente" placeholder="Inserisci email utente"><span>* <?= $emailErr; ?></span>
                </div>
            </label>

            <label for="giorno_prenotazione">Giorno prenotazione
                <div>
                    <input type="date" name="giorno_prenotazione"><span>* <?= $giornoErr; ?></span>
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo
                <div>
                    <input type="time" name="ora_arrivo"><span>* <?= $oraArrivoErr; ?></span>
                </div>
            </label>

            <label for="ora_partenza">Ora partenza
                <div>
                    <input type="time" name="ora_partenza"><span>* <?= $oraPartenzaErr; ?></span>
                </div>
            </label>

            <label for="id_tavolo">Numero tavolo
                <div>
                    <input type="number" name="id_tavolo"
                           placeholder="Inserisci numero tavolo prenotato"><span>* <?= $idTavoloErr; ?></span>
                </div>
            </label>

            <label for="id_posto">Numero posto
                <div>
                    <input type="number" name="id_posto"
                           placeholder="Inserisci numero posto prenotato"><span>* <?= $idPostoErr; ?></span>
                </div>
            </label>

            <input type="submit" name="submit" id="submit" class="button button-primary" value="Aggiungi utente">
        </form>
    </div>
</div>


<?php
//if (isset ($_POST['submit'])) {
//    checkEmptyField($_POST);
//    if ($nomeErr == '' && $emailErr == '' && $giornoErr == '' && $oraArrivoErr == '' && $oraPartenzaErr == '' && $idTavoloErr == '' && $idPostoErr == '')
//        echo "I dati sono stati inseriti correttamente ";
//} else {
//    echo "Non hai riempito tutti i campi";
//}
?>
