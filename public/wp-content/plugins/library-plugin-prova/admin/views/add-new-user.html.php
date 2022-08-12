<?php

$nomeErr = $emailErr = $giornoErr = $oraArrivoErr = $oraPartenzaErr = $idTavoloErr = $idPostoErr = "";
$nome = $email = $giorno = $ora_arrivo = $ora_partenza = $id_tavolo = $id_posto = '';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome_utente'];
    $email = $_POST['email_utente'];
    $giorno = $_POST['giorno_prenotazione'];
    $ora_arrivo = $_POST['ora_arrivo'];
    $ora_partenza = $_POST['ora_partenza'];
    $id_tavolo = $_POST['id_tavolo'];
    $id_posto = $_POST['id_posto'];

    if (empty($_POST['nome_utente']) || empty($_POST['email_utente']) || empty($_POST['giorno_prenotazione']) || empty($_POST['ora_arrivo']) || empty($_POST['ora_partenza']) || empty($_POST['id_tavolo']) || empty($_POST['id_posto'])) {

        if (empty($_POST['nome_utente']) || !preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $nomeErr = "Inserisci campo";
        }
        if (empty($_POST['email_utente']) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Inserisci campo";
        }
        if (empty($_POST['giorno_prenotazione'])) {
            $giornoErr = "Inserisci campo";
        }
        if (empty($_POST['ora_arrivo'])) {
            $oraArrivoErr = "Inserisci campo";
        }
        if (empty($_POST['ora_partenza'])) {
            $oraPartenzaErr = "Inserisci campo";
        }
        if (empty($_POST['id_tavolo'])) {
            $idTavoloErr = "Inserisci campo";

        }
        if (empty($_POST['id_posto'])) {
            $idPostoErr = "Inserisci campo";
        }
        echo "Compila tutti i campi";
    } else {

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

        echo "Dati inseriti correttamente";

    }

}

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkEmptyField($field)
{
    if ($field == '') {
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

