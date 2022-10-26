<?php include __DIR__ . '/../../DB/add-new-res.php'; ?>

<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <p>Compila tutti i campi e poi clicca su 'Aggiungi' per inserire una nuova prenotazione</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <label for="nome_utente">Nome utente*
                <div class="form--error">
                    <input type="text" name="nome_utente" id="nome_utente" value="<?= $field['nome_utente'] ?>"
                           placeholder="Inserisci nome utente">
                    <p> <?= $error['nome_utente'] ?> </p>
                </div>
            </label>

            <label for="email_utente">Email utente*
                <div class="form--error">
                    <input type="text" name="email_utente" id="email_utente" value="<?= $field['email_utente'] ?>"
                           placeholder="Inserisci email utente">
                    <p> <?= $error['email_utente'] ?> </p>
                </div>
            </label>
            <?php

            ?>

<!--            <input type="hidden" name="id_utente" id="id_utente" value="--><?//= $field['id_utente'] = $findUserId ?><!--">-->

            <label for="nome_stanza">Scegli stanza*
                <div class="form--error">
                    <select name="nome_stanza" id="nome_stanza">
                        <option value=""><?= isset($_POST['submit']) ? $field['nome_stanza'] : 'Scegli stanza' ?></option>
                        <?php
                        foreach ($db->getRoomName() as $room):
                            ?>
                            <option id="stanza" value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p> <?= $error['nome_stanza'] ?> </p>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione*
                <div class="form--error">
                    <input type="date" name="giorno" id="giorno" value="<?= $field['giorno'] ?>">
                    <p> <?= $error['giorno'] ?> </p>
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo*
                <div class="form--error">
                    <input type="time" name="ora_arrivo" id="ora_arrivo" value="<?= $field['ora_arrivo'] ?>">
                    <p> <?= $error['ora_arrivo'] ?> </p>
                </div>
            </label>

            <label for="ora_partenza">Ora partenza*
                <div class="form--error">
                    <input type="time" name="ora_partenza" id="ora_partenza" value="<?= $field['ora_partenza'] ?>">
                    <p> <?= $error['ora_partenza'] ?> </p>
                </div>
            </label>

            <label for="tutto_il_giorno">Tutto il giorno
                <div class="form--error">
                    <input type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno" value="si">
                    <p> <?= $error['tutto_il_giorno'] ?> </p>
                </div>
            </label>

            <label for="numero_posto">Numero posto*
                <div class="form--error">
                    <select name="numero_posto" id="numero_posto">
                        <option value=""><?= isset($_POST['submit']) ? $field['numero_posto'] : 'Scegli posto' ?></option>
                        <?php
                        foreach ($db->getSeatNum() as $seat):
                            ?>
                            <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <p> <?= $error['numero_posto'] ?> </p>
                </div>
            </label>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Aggiungi prenotazione">
        </form>
    </div>
    <script src="<?= plugin_dir_url(__DIR__) . '/../../js/book-seat.js'; ?>"></script>
</div>

