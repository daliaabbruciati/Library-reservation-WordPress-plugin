<?php
include __DIR__ . '/../../DB/start-connection.php';
$nome = $email = $giorno = $ora_arrivo = $ora_partenza = $id_tavolo = $id_posto = '';

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
              action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

            <?php
//            $sql = "SELECT * FROM ". $db_table_name ." WHERE id = ?";
//            $result = $connection->prepare($sql);
//            $result->execute([$_POST['id']]);

            $result = $wpdb->get_results($wpdb->prepare("SELECT * FROM ". $db_table_name ." WHERE id = %d", $_POST['id']) );

            if ($result > 0):
//                $rows = $result->fetchAll();
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

                    <label for="id_tavolo">Numero tavolo
                        <div>
                            <input type="number" name="id_tavolo"
                                   value="<?= $row->id_tavolo ?>">
                        </div>
                    </label>

                    <label for="id_posto">Numero posto
                        <div>
                            <input type="number" name="id_posto"
                                   value="<?= $row->id_posto ?>">
                        </div>
                    </label>
                    <?php
                endforeach;
            endif;
            if (isset($_POST['edit']) && $_SERVER['REQUEST_METHOD'] =='POST') {
                $wpdb->update($db_table_name, [
                    'nome_utente' => $row['nome_utente'],
                    'email_utente' => $row['email_utente'],
                    'giorno_prenotazione' => $row['giorno_prenotazione'],
                ], [
                    'id' => $row['id']
                ]);
            }
            ?>
            <input type="submit" name="edit" id="edit" class="button button-primary" value="Salva modifiche">
        </form>
        <?php
        else:
            ?>
            <h3>Vai alla schermata <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php">'Panoramica'</a>
                e clicca sul pulsante 'Modifica' per editare i dati dell'utente</h3>
        <?php
        endif;
        ?>
    </div>
</div>


