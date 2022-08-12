
<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=local", "root", "root");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Database connection established!';

} catch (PDOException $e) {
    $output = "Connessione non riuscita: " . $e->getMessage();
}
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

                $sql = "SELECT * FROM wp_library_users";
                $result = $connection->prepare($sql);
                $result->execute();

                if ($result->rowCount() > 0):
                    $rows = $result->fetchAll();
                    foreach ($rows as $row):
                        ?>
                        <tr class="db-tr">
                            <td class="db-td"><?php echo $row['id']; ?></td>
                            <td class="db-td"><?php echo $row['nome_utente']; ?></td>
                            <td class="db-td"><?php echo $row['email_utente']; ?></td>
                            <td class="db-td"><?php echo $row['giorno_prenotazione']; ?></td>
                            <td class="db-td"><?php echo $row['ora_arrivo']; ?></td>
                            <td class="db-td"><?php echo $row['ora_partenza']; ?></td>
                            <td class="db-td"><?php echo $row['id_tavolo']; ?></td>
                            <td class="db-td"><?php echo $row['id_posto']; ?></td>
                            <td class="db-td">
                                <?php
                                // query per delete row
//                                DELETE FROM `wp_library_users`WHERE `id` = '7';

                                ?>
                                <form method="post" action="<?php $_SERVER['REQUEST_URI']?>">

                                    <input type="submit" name="submit" id="submit" class="button button-secondary"
                                           value="Modifica">
                                </form>
                            </td>
                            <td class="db-td">
                                <form method="post" action="options.php">
                                    <input type="hidden" name="Id" value="<?= $row['id'] ?>">
                                    <input type="submit" name="submit" id="submit" class="button button-link-delete"
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

<!--            <div class="wrap">-->
<!--                --><?php
//                $nome = $_POST['nome_utente'];
//                $email = $_POST['email_utente'];
//                $giorno = $_POST['giorno_prenotazione'];
//                $ora_arrivo = $_POST['ora_arrivo'];
//                $ora_partenza = $_POST['ora_partenza'];
//                $id_tavolo = $_POST['id_tavolo'];
//                $id_posto = $_POST['id_posto'];
//                    echo $nome;
//                    echo $email;
//                    echo $giorno;
//                    echo $ora_arrivo;
//                    echo $ora_partenza;
//                    echo $id_tavolo;
//                    echo $id_posto;
//                ?>
<!--            </div>-->

        </div>


        <div id="tab-2" class="tab-pane">
            <h3>Aggiungi/modifica impostazioni</h3>
            <ul>
                <li>- Aggiungi stanza</li>
            </ul>
        </div>
    </div>
</div>

