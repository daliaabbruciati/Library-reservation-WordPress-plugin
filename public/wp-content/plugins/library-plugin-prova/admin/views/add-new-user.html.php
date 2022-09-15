<?php
require __DIR__ . '/../../DB/start-connection.php';
require __DIR__ . '/../../DB/add-row.php';
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
                    <input type="text" name="nome_utente" id="nome_utente" value="<?= $nome ?>"
                           placeholder="Inserisci nome utente">*
                    <p> <?= $nomeErr ?> </p>
                </div>
            </label>

            <label for="email_utente">Email
                <div class="form--error">
                    <input type="text" name="email_utente" id="email_utente" value="<?= $email ?>"
                           placeholder="Inserisci email utente">*
                    <p> <?= $emailErr ?> </p>
                </div>
            </label>

            <label for="stanza">Scegli stanza
                <div class="form--error">
                    <select name="stanza" id="stanza">
                        <option value="" selected="selected">Scegli stanza</option>*
                    </select>
                    <p> <?= $stanzaErr ?> </p>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione
                <div class="form--error">
                    <input type="date" name="giorno" id="giorno" value="<?= $giorno ?>">*
                    <p> <?= $giornoErr ?> </p>
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo
                <div class="form--error">
                    <input type="time" name="ora_arrivo" id="ora_arrivo" value="<?= $ora_arrivo ?>">*
                    <p> <?= $oraArrivoErr ?> </p>
                </div>
            </label>

            <label for="ora_partenza">Ora partenza
                <div class="form--error">
                    <input type="time" name="ora_partenza" id="ora_partenza" value="<?= $ora_partenza ?>">*
                    <p> <?= $oraPartenzaErr ?> </p>
                </div>
            </label>

            <label for="tutto_il_giorno">Tutto il giorno
                <div class="form--error">
                    <input type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno">*
                    <p> <?= $tuttoIlGiornoErr ?> </p>
                </div>
            </label>

            <label for="id_posto">Numero posto
                <div class="form--error">
                    <select name="id_posto" id="id_posto">
                        <option value="" selected="selected">Scegli posto</option>*
                    </select>
                    <p> <?= $idPostoErr ?> </p>
                </div>
            </label>
            <?php
            if (isset($_POST['submit']) && $nomeErr && $emailErr && $stanzaErr && $giornoErr && $oraArrivoErr && $oraPartenzaErr && $tuttoIlGiornoErr && $idPostoErr == NULL):
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

