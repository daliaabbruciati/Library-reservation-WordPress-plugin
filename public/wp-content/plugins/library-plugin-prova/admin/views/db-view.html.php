<?php
include __DIR__ . '/../../DB/start-connection.php';
?>

<div class="wrap">
    <h1>Library Reservation plugin management </h1>
    <?php settings_errors(); ?>
    <?php echo $output ?>

    <div class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Vista prenotazioni</a></li>
        <li><a href="#tab-2">Aggiungi/Modifica impostazioni</a></li>
    </div>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <?php
            if (isset($_POST['submit'])) echo "<h4>Elemento eliminato correttamente. Ricarica la pagina</h4>";
            ?>
            <table class="db-table">
                <thead class="db-thead">
                <tr class="db-tr">
                    <th class="db-th">ID</th>
                    <th class="db-th">Nome utente</th>
                    <th class="db-th">Email</th>
                    <th class="db-th">Giorno</th>
                    <th class="db-th">Ora arrivo</th>
                    <th class="db-th">Ora partenza</th>
                    <th class="db-th">Id tavolo</th>
                    <th class="db-th">Id. posto</th>
                    <th class="db-th">Modifica</th>
                    <th class="db-th">Elimina</th>
                </tr>
                </thead>
                <tbody>
                <?php

//                $sql = "SELECT * FROM $db_table_name";
//                $result = $connection->prepare($sql);
//                $result->execute();
                $result =  $result = $wpdb->get_results("SELECT * FROM ". $db_table_name);
                if ($result > 0):
                    foreach ($result as $row):
                        ?>
                        <tr class="db-tr">
                            <td class="db-td"><?php echo $row->id; ?></td>
                            <td class="db-td"><?php echo $row->nome_utente; ?></td>
                            <td class="db-td"><?php echo $row->email_utente; ?></td>
                            <td class="db-td"><?php echo $row->giorno_prenotazione; ?></td>
                            <td class="db-td"><?php echo $row->ora_arrivo; ?></td>
                            <td class="db-td"><?php echo $row->ora_partenza; ?></td>
                            <td class="db-td"><?php echo $row->id_tavolo; ?></td>
                            <td class="db-td"><?php echo $row->id_posto; ?></td>
                            <td class="db-td">
                                <?php
//                                if (isset($_POST['save'])) {
//                                    $wpdb->update($db_table_name, [
//                                        'nome_utente' => $row['nome_utente'],
//                                    ], [
//                                        'id' => $row['id']
//                                    ]);
//                                }
//                                include __DIR__ . '/../../DB/update-row.php';
                                //                                ?>

                                <form method="post" action="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fedit-user.html.php">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <input type="submit" name="save" id="save" class="button button-secondary"
                                           value="Modifica">
                                </form>
                            </td>
                            <td class="db-td">

                                <?php include __DIR__ . '/../../DB/delete-row.php'; ?>

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
            <h3>Aggiungi/modifica impostazioni</h3>
            <ul>
                <li>- Aggiungi stanza</li>
            </ul>
        </div>
    </div>
</div>

