<!doctype html>

<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Scegli posto</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__) . '/../css/book-seat.css'; ?>">
</head>
<body>

<?php include 'header.html.php'; ?>

<div class="container">
    <p>Ciao <?= $_SESSION['nome'] ?>.</p>
    <p>Di seguito troverai: a sinistra il form con i campi da completare e a destra la piantina della biblioteca con i
        relativi tavoli numerati.</p>
    <p>Una volta completato, clicca su 'Conferma' per effettuare la prenotazione.</p>
    <div class="container__content">
        <div class="container__form">
            <h2>Prenota posto</h2>
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                <div class="form__stanza">
                    <label for="stanza">Scegli stanza</label>
                    <div class="form--error">
                        <select name="stanza" id="stanza">
                            <option value=""><?= isset($_POST['submit_prenotazione']) ? $fields['stanza'] : 'Scegli stanza' ?></option>
                            <?php
                            foreach ($roomName as $room):
                                ?>
                                <option value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p><?= $errors['stanza'] ?></p>
                    </div>
                </div>
                <div class="form__giorno">
                    <label for="giorno">Scegli giorno</label>
                    <div class="form--error">
                        <input name="giorno" type="date" id="giorno" value="<?= $fields['giorno']; ?>">
                        <p><?= $errors['giorno'] ?></p>
                    </div>
                </div>
                <div class="form__ora-arrivo">
                    <label for="ora_arrivo">Ora arrivo</label>
                    <div class="form--error">
                        <input type="time" name="ora_arrivo" id="ora_arrivo"
                               min="09:00" max="12:30" value="<?= $fields['ora_arrivo']; ?>">
                        <p><?= $errors['ora_arrivo'] ?></p>
                    </div>
                </div>
                <div class="form__ora-partenza">
                    <label for="ora_partenza">Ora partenza</label>
                    <div class="form--error">
                        <input type="time" name="ora_partenza" id="ora_partenza"
                               max="18:30" value="<?= $fields['ora_partenza']; ?>">
                        <p><?= $errors['ora_partenza'] ?></p>
                    </div>
                </div>
                <div class="form__tutto-il-giorno">
                    <label for="tutto_il_giorno">Tutto il giorno</label>
                    <div class="form--error">
                        <input name="tutto_il_giorno" type="checkbox" id="tutto_il_giorno" value="yes">
                        <p><?= $errors['tutto_il_giorno'] ?></p>
                    </div>
                </div>
                <div class="form__posto">
                    <label for="id_posto">Scegli posto disponibile</label>
                    <div class="form--error">
                    <select name="id_posto" id="id_posto">
                        <option value=""><?= isset($_POST['submit_prenotazione']) ? $fields['id_posto'] : 'Scegli posto' ?></option>
                        <?php
                        foreach ($seatNum as $seat):
                            ?>
                            <option value="<?= $seat->numero_posto; ?>"><?= $seat->numero_posto ?></option>
                        <?php endforeach; ?>
                    </select>
                        <p><?= $errors['id_posto'] ?></p>
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
                " WHERE nome_stanza = '".$fields['stanza']."';");
            ?>
            <p>Posti disponibili: <?= $availableSeats ?>/<?= $availableSeats?></p>
            <img src="<?= plugin_dir_url(__DIR__) . '/../../assets/piantina-desktop.svg' ?>" alt="piantina-posti"/>
        </div>
    </div>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>

