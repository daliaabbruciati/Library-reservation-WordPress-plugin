<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Scegli posto</title>
    <link rel="stylesheet" href="<?= plugin_dir_url(__DIR__) . '/../css/book-seat.css'; ?>">
    <script src="<?= plugin_dir_url(__DIR__) . '/../js/book-seat.js'; ?>"></script>
</head>
<body>

<?php include 'header.html.php';

if (isset($_POST['submit_prenotazione']) && empty(array_filter($error))):
    include_once __DIR__ . '/./booking-success.html.php';

else:

?>
<div class="container">
    <p>Ciao <strong><?= $_SESSION['nome'] ?></strong>.</p>
    <p hidden><?= $_SESSION['email'] ?>.</p>
    <?php
    $findUser = $wpdb->get_results("SELECT * FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $_SESSION['email'] . "';");

    ?>
    <p>Di seguito troverai: a sinistra il form con i campi da completare e a destra la piantina della biblioteca con i
        relativi tavoli numerati.</p>
    <p>Una volta completato, clicca su 'Conferma' per effettuare la prenotazione.</p>
    <div class="container__content">
        <div class="container__form">
            <h2>Prenota posto</h2>
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                <?php
                foreach ($findUser as $user):
                    ?>
                    <input type="hidden" name="id_utente" id="id_utente" value="<?= $field['id_utente'] = $user->ID ?>">
                    <input type="hidden" name="nome_utente" id="nome_utente"
                           value="<?= $field['nome_utente'] = $user->user_login ?>">
                    <input type="hidden" name="email_utente" id="email_utente"
                           value="<?= $field['email_utente'] = $user->user_email ?>">
                <?php endforeach; ?>
                <div class="form__stanza">
                    <label for="nome_stanza">Scegli stanza</label>
                    <div class="form--error">
                        <select name="nome_stanza" id="nome_stanza">
                            <option value=""><?= isset($_POST['submit_prenotazione']) ? $field['nome_stanza'] : 'Scegli stanza' ?></option>
                            <?php
                            foreach ($db->getRoomName() as $room):
                                ?>
                                <option id="stanza" value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p><?= $error['nome_stanza'] ?></p>
                    </div>
                </div>
                <div class="form__giorno">
                    <label for="giorno">Scegli giorno</label>
                    <div class="form--error">
                        <input type="date" name="giorno" id="giorno" value="<?= $field['giorno']; ?>">
                        <p><?= $error['giorno'] ?></p>
                    </div>
                </div>
                <div class="form__ora-arrivo">
                    <label for="ora_arrivo">Ora arrivo</label>
                    <div class="form--error">
                        <input type="time" name="ora_arrivo" id="ora_arrivo"
                               min="09:00" max="12:30" value="<?= $field['ora_arrivo']; ?>">
                        <p><?= $error['ora_arrivo'] ?></p>
                    </div>
                </div>
                <div class="form__ora-partenza">
                    <label for="ora_partenza">Ora partenza</label>
                    <div class="form--error">
                        <input type="time" name="ora_partenza" id="ora_partenza"
                               max="18:30" value="<?= $field['ora_partenza']; ?>">
                        <p><?= $error['ora_partenza'] ?></p>
                    </div>
                </div>
                <div class="form__tutto-il-giorno">
                    <label for="tutto_il_giorno">Tutto il giorno</label>
                    <div class="form--error">
                        <input type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno" value="yes">
                        <p><?= $error['tutto_il_giorno'] ?></p>
                    </div>
                </div>
                <div class="form__posto">
                    <label for="numero_posto">Scegli posto disponibile</label>
                    <div class="form--error">
                        <select name="numero_posto" id="numero_posto">
                            <option value=""><?= isset($_POST['submit_prenotazione']) ? $field['numero_posto'] : 'Scegli posto' ?></option>
                            <?php
                            foreach ($db->getSeatNum() as $seat):
                                ?>
                                <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <p><?= $error['numero_posto'] ?></p>
                    </div>

                </div>
                <input class="form__submit" type="submit" id="submit_prenotazione" name="submit_prenotazione"
                       value="Conferma">
            </form>
        </div>
        <div class="container__image">
            <?php
            /* Query che restituisce il numero di posti disponibili nella stanza */
            $availableSeats = $wpdb->get_var("SELECT posti_disponibili FROM " . $db::TABLE_BIBLIOTECA_STANZA .
                " WHERE nome_stanza = '" . $field['nome_stanza'] . "';");
            ?>
            <p>Posti disponibili: <?= $availableSeats ?>/<?= $availableSeats ?></p>
            <img src="<?= plugin_dir_url(__DIR__) . '/../../assets/piantina-desktop.svg' ?>" alt="piantina-posti"/>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>

