<?php
require __DIR__ . '/../../DB/start-connection.php';
require __DIR__ . '/../../DB/add-row.php';
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

            <label for="num_tavolo">Numero tavolo
                <div>
                    <input type="number" name="num_tavolo"
                           placeholder="Inserisci numero tavolo prenotato"><span>* <?= $numTavoloErr; ?></span>
                </div>
            </label>

            <label for="num_posto">Numero posto
                <div>
                    <input type="number" name="num_posto"
                           placeholder="Inserisci numero posto prenotato"><span>* <?= $numPostoErr; ?></span>
                </div>
            </label>
            <?php
            if (isset($_POST['submit'])):
                ?>
                <div>
                    <h3>Nuovo utente inserito correttamente.Torna alla schermata <a
                                href='http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php'>Panoramica</a>.
                    </h3>
                </div>
            <?php endif; ?>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Aggiungi utente">
        </form>
    </div>
</div>

