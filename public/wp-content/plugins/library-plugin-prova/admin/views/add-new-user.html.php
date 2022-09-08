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

            <label for="giorno">Scegli stanza
                <div>
                    <input type="number" name="stanza"
                           placeholder="Inserisci il numero della stanza"><span>* <?= $stanzaErr; ?></span>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione
                <div>
                    <input type="datetime-local" name="giorno"><span>* <?= $giornoErr; ?></span>
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

            <label for="tutto_il_giorno">Tutto il giorno
                <div>
                    <input type="checkbox" name="tutto_il_giorno"><span>* <?= $tuttoIlGiornoErr; ?></span>
                </div>
            </label>

            <label for="id_posto">Numero posto
                <div>
                    <input type="number" name="id_posto" min="1" max="120"
                           placeholder="Inserisci numero posto prenotato"><span>* <?= $idPostoErr; ?></span>
                </div>
            </label>
            <?php
            if (isset($_POST['submit']) && $nomeErr && $emailErr && $stanzaErr && $giornoErr && $oraArrivoErr && $oraPartenzaErr && $tuttoIlGiornoErr && $numPostoErr == NULL):
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

