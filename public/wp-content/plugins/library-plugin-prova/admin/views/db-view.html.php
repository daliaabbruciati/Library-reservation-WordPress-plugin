<?php

use Plugin\DB\Database;

include_once __DIR__. '/../../DB/Database.php';
$mydb = new Database(__FILE__);

?>

<div class="wrap">
    <h1>Library Reservation plugin management </h1>
    <?php settings_errors(); ?>
    <?php echo $mydb->start_connection(); ?>

    <div class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Vista prenotazioni</a></li>
        <li><a href="#tab-2">Modifica impostazioni</a></li>
    </div>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <?php
            if (isset($_POST['submit'])) echo "<h4>Elemento eliminato correttamente. Ricarica la pagina</h4>";
            ?>
            <table class="db-table">
                <thead class="db-thead">
                <tr class="db-tr">
                    <th class="db-th">Id prenotazione</th>
                    <th class="db-th">Id utente</th>
                    <th class="db-th">Nome</th>
                    <th class="db-th">Email</th>
                    <th class="db-th">Stanza</th>
                    <th class="db-th">Giorno</th>
                    <th class="db-th">Ora arrivo</th>
                    <th class="db-th">Ora partenza</th>
                    <th class="db-th">Tutto il giorno</th>
                    <th class="db-th">Id posto</th>
                    <th class="db-th">QR code</th>
                    <th class="db-th">Modifica</th>
                    <th class="db-th">Elimina</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $mydb->select_all($mydb::TABLE_PRENOTAZIONE);
                if ($result > 0):
                    foreach ($result as $row):
                        ?>
                        <tr class="db-tr">
                            <td class="db-td"><?php echo $row->id; ?></td>
                            <td class="db-td"><?php echo $row->id_utente; ?></td>
                            <td class="db-td"><?php echo $row->nome_utente; ?></td>
                            <td class="db-td"><?php echo $row->email_utente; ?></td>
                            <td class="db-td"><?php echo $row->stanza; ?></td>
                            <td class="db-td"><?php echo $row->giorno; ?></td>
                            <td class="db-td"><?php echo $row->ora_arrivo; ?></td>
                            <td class="db-td"><?php echo $row->ora_partenza; ?></td>
                            <td class="db-td"><?php echo $row->tutto_il_giorno; ?></td>
                            <td class="db-td"><?php echo $row->id_posto; ?></td>
                            <td class="db-td"><?php echo $row->qr_code; ?></td>
                            <td class="db-td">

                                <form method="post"
                                      action="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fedit-user.html.php">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <input type="submit" name="save" id="save" class="button button-secondary"
                                           value="Modifica">
                                </form>
                            </td>
                            <td class="db-td">

                                <?php
                                if (isset($_POST['submit']) && $row->id == $_POST['id']) {
                                    $wpdb->delete($mydb::TABLE_PRENOTAZIONE, [
                                        'id' => $row->id
                                    ]);
                                }
                                ?>

                                <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <input type="submit" name="submit" class="button button-link-delete"
                                           value="Elimina">
                                </form>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>


        <div id="tab-2" class="tab-pane">
            <h3>Modifica impostazioni</h3>
            <div class="form-container">
                <label for="numero_stanze">Numero stanze
                    <div>
                        <input type="number" name="numero_stane" id="numero_stanze"
                               placeholder="Inserisci numero totale di stanze">
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>

