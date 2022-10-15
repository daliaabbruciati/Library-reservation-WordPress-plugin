<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../../DB/Database.php';
$db = new Database(__FILE__);

$newNome = $newEmail = $newStanza = $newGiorno = $newOra_arrivo = $newOra_partenza = $newTuttoIlGiorno = $newId_posto = '';

$result = $wpdb->get_results("SELECT * FROM ".$db::TABLE_PRENOTAZIONE.
    " WHERE id_prenotazione = '".$_POST['id_prenotazione']."';");
print_r($result);
?>


<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST"):
    ?>
    <p>Modifica i campi e poi clicca su 'Salva modifiche' per aggiornare i dati dell'utente utente</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container" method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>">
            <?php
                if (!empty($result)):
                foreach ($result as $row):
            ?>
            <input type="hidden" name="id_utente" id="id_utente" value="<?= $row->id_utente?>">
            <label for="nome_utente">Nome utente
                <div>
                    <input type="text" name="nome_utente" id="nome_utente"
                           value="<?= $row->nome_utente ?>">
                </div>
            </label>

            <label for="email_utente">Email utente
                <div>
                    <input type="text" name="email_utente" id="email_utente"
                           value="<?= $row->email_utente ?>">
                </div>
            </label>

            <label for="stanza">Stanza
                <div>
                    <select name="stanza" id="stanza">
                        <option value=""><?= $row->stanza ?></option>
                        <?php
                        foreach ($db->getRoomName() as $room):
                            ?>
                            <option value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione
                <div>
                    <input type="date" name="giorno" value="<?= $row->giorno ?>">
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

            <label for="tutto_il_giorno">tutto il giorno
                <div>
                    <input type="checkbox" name="tutto_il_giorno"  id="tutto_il_giorno" value="yes">
                </div>
            </label>

            <label for="numero_posto">Numero posto
                <div>
                    <select name="numero_posto" id="numero_posto">
                        <option value=""><?= $row->numero_posto ?></option>
                        <?php
                        foreach ($db->getSeatNum() as $seat):
                            ?>
                            <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </label>

            <?php include __DIR__ . '/../../DB/edit-res.php'; ?>
            <input type="hidden" name="id_prenotazione" value="<?= $row->id_prenotazione; ?>">
            <input type="submit" name="update" id="update" class="button button-primary" value="Salva modifiche">
        </form>
        <?php
         endforeach;
        endif;
        ?>
        <?php
        else:
            ?>
            <h3>Vai alla schermata <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a>
                e clicca sul pulsante 'Modifica' per editare i dati dell'utente</h3>
        <?php
        endif;
        ?>
    </div>
</div>
