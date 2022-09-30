<?php
use Plugin\DB\Database;

include_once __DIR__. '/../../DB/Database.php';
$mydb = new Database(__FILE__);

require __DIR__ . '/../../DB/add-user.php';
?>

<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <p>Compila tutti i campi e poi clicca su 'Aggiungi' per inserire una nuova prenotazione</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container"
              method="post"
              action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <label for="nome_utente">Nome utente
                <div class="form--error">
                    <input type="text" name="nome_utente" id="nome_utente" value="<?= $fields['nome'] ?>"
                           placeholder="Inserisci nome utente">*
                    <p> <?= $errors['nomeErr'] ?> </p>
                </div>
            </label>

            <label for="email_utente">Email
                <div class="form--error">
                    <input type="text" name="email_utente" id="email_utente" value="<?= $fields['email'] ?>"
                           placeholder="Inserisci email utente">*
                    <p> <?= $errors['emailErr'] ?> </p>
                </div>
            </label>

            <label for="stanza">Scegli stanza
                <div class="form--error">
                    <select name="stanza" id="stanza">
                        <option value="" selected="selected">Scegli stanza</option>*
                    </select>
                    <p> <?= $errors['stanzaErr'] ?> </p>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione
                <div class="form--error">
                    <input type="date" name="giorno" id="giorno" value="<?= $fields['giorno'] ?>">*
                    <p> <?= $errors['giornoErr'] ?> </p>
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo
                <div class="form--error">
                    <input type="time" name="ora_arrivo" id="ora_arrivo" value="<?= $fields['ora_arrivo'] ?>">*
                    <p> <?= $errors['ora_arrivoErr'] ?> </p>
                </div>
            </label>

            <label for="ora_partenza">Ora partenza
                <div class="form--error">
                    <input type="time" name="ora_partenza" id="ora_partenza" value="<?= $fields['ora_partenza'] ?>">*
                    <p> <?= $errors['ora_partenzaErr'] ?> </p>
                </div>
            </label>

            <label for="tutto_il_giorno">Tutto il giorno
                <div class="form--error">
                    <input type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno">*
                    <p> <?= $errors['tutto_il_giornoErr'] ?> </p>
                </div>
            </label>

            <label for="id_posto">Numero posto
                <div class="form--error">
                    <select name="id_posto" id="id_posto">
                        <option value="" selected="selected">Scegli posto</option>*
                    </select>
                    <p> <?= $errors['id_postoErr'] ?> </p>
                </div>
            </label>
            <?php
            if (isset($_POST['submit']) && empty(array_filter($errors))):
                ?>
                <div>
                    <h3>Nuovo utente inserito correttamente.Torna alla schermata <a
                                href='http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php'>Panoramica</a>.
                    </h3>
                </div>
            <?php
            endif;
            ?>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Aggiungi prenotazione">
        </form>
    </div>
</div>

