<?php
require __DIR__ . '/../../DB/start-connection.php';
$newNome = $newEmail = $newGiorno = $newOra_arrivo = $newOra_partenza = $newNum_tavolo = $newNum_posto = '';
?>


<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"):
    ?>
    <p>Modifica i campi e poi clicca su 'Salva modifiche' per aggiornare i dati dell'utente utente</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container"
              method="post"
              action="<?php echo($_SERVER['REQUEST_URI']); ?>">
            <?php
            $result = $wpdb->get_results(
                $wpdb->prepare("SELECT * FROM " . $db_table_name . " WHERE id = %d", $_POST['id']));
            if ($result > 0):
            foreach ($result as $row):
            ?>
            <label for="nome_utente">Nome
                <div>
                    <input type="text" name="nome_utente" id="nome_utente"
                           value="<?= $row->nome_utente ?>">
                </div>
            </label>

            <label for="email_utente">Email
                <div>
                    <input type="text" name="email_utente" id="email_utente"
                           value="<?= $row->email_utente ?>">
                </div>
            </label>

            <label for="giorno_prenotazione">Giorno prenotazione
                <div>
                    <input type="date" name="giorno_prenotazione" value="<?= $row->giorno_prenotazione ?>">
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo
                <div>
                    <input type="time" name="ora_arrivo" value="<?= $row->ora_arrivo ?>">
                </div>
            </label>

            <label for="ora_partenza">Ora partenza
                <div>
                    <input type="time" name="ora_partenza" value="<?= $row->ora_partenza ?>">
                </div>
            </label>

            <label for="num_tavolo">Numero tavolo
                <div>
                    <input type="number" name="num_tavolo"
                           value="<?= $row->num_tavolo ?>">
                </div>
            </label>

            <label for="num_posto">Numero posto
                <div>
                    <input type="number" name="num_posto"
                           value="<?= $row->num_posto ?>">
                </div>
            </label>

            <?php
            include __DIR__ . '/../../DB/update-row.php';
            ?>
            <input type="hidden" name="id" value="<?= $row->id; ?>">
            <input type="submit" name="edit" id="edit" class="button button-primary" value="Salva modifiche">
        </form>
        <?php
         endforeach;
        endif;
        ?>
        <?php
        else:
            ?>
            <h3>Vai alla schermata <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php">Panoramica</a>
                e clicca sul pulsante 'Modifica' per editare i dati dell'utente</h3>
        <?php
        endif;
        ?>
    </div>
</div>
