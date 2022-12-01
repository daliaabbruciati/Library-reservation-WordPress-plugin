<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../../DB/Database.php';
$db = new Database( __FILE__ );

?>

<!doctype html>

<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library reservation view</title>
    <script src="<?= plugin_dir_url( __DIR__ ) . '/../js/script.js'; ?>"></script>
</head>
<body>
<div class="wrap">
    <h1>Library Reservation plugin management </h1>
	<?php
	settings_errors();
	echo $db->start_connection();

	date_default_timezone_set( "Europe/Rome" );
    $currentDate = date('Y-m-d');
	$currentTime = date( "H:i:s" );
	?>

    <div class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Vista prenotazioni</a></li>
        <li><a href="#tab-2">Vista impostazioni</a></li>
    </div>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
			<?php
			function refresh() {
				echo "<script type='text/javascript'>
                           window.location=document.location.href;
                           </script>";
			}

			if ( isset( $_POST['data-id'] ) ) {
				refresh();
			}
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
                    <th class="db-th">Numero posto</th>
                    <th class="db-th">QR code</th>
                    <th class="db-th">Modifica</th>
                    <th class="db-th">Elimina</th>
                </tr>
                </thead>
                <tbody id="table-body">
				<?php
				$result = $db->select_all( $db::TABLE_PRENOTAZIONE );
				if ( ! empty( $result ) ):
					foreach ( $result as $row ):
						if ( $currentTime >= $row->ora_partenza || $currentDate > $row->giorno ) {
							echo "<tr class='db-tr' id='table-row' 
                          style='background-color: #c0c0c0; color: #979797'> ";
						} else {
							echo "<tr class='db-tr' id='table-row'>";
						}
						?>
                        <td class="db-td"><?= $row->id_prenotazione; ?></td>
                        <td class="db-td"><?= $row->id_utente; ?></td>
                        <td class="db-td"><?= $row->nome_utente; ?></td>
                        <td class="db-td"><?= $row->email_utente; ?></td>
                        <td class="db-td"><?= $row->nome_stanza; ?></td>
                        <td class="db-td"><?= $row->giorno; ?></td>
                        <td class="db-td"><?= $row->ora_arrivo; ?></td>
                        <td class="db-td"><?= $row->ora_partenza; ?></td>
                        <td class="db-td"><?= $row->tutto_il_giorno; ?></td>
                        <td class="db-td"><?= $row->numero_posto; ?></td>
                        <td class="db-td"><?= $row->qr_code; ?></td>
                        <td class="db-td">

                            <form method="post"
                                  action="/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fedit-res.html.php">
                                <input type="hidden" name="id_prenotazione" value="<?= $row->id_prenotazione; ?>">
								<?php
								if ( $currentTime >= $row->ora_partenza || $currentDate > $row->giorno) {
									echo "<input type='submit' name='edit' id='edit' disabled class='button button - secondary'
                                       value='Scaduta'>";
								} else {
									echo "<input type='submit' name='edit' id='edit' class='button button - secondary'
                                       value='Modifica'>";
								}
								?>
                            </form>
                        </td>
                        <td class="db-td">
							<?php $db->deleteReservation( $row ); ?>
                            <form id="form_delete" method="post"
                                  action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ) ?>">
                                <input type="hidden" name="id_prenotazione" id="id_prenotazione"
                                       value="<?= $row->id_prenotazione; ?>">
                                <input type="hidden" name="numero_posto" value="<?= $row->numero_posto; ?>">
                                <input type="hidden" name="nome_stanza" value="<?= $row->nome_stanza; ?>">
                                <input type="hidden" name="data-id" value="<?= $row->id_prenotazione; ?>">
                                <input type="submit" name="delete" id="delete"
                                       data-id="<?= $row->id_prenotazione ?>" class="button button-link-delete"
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
            <h3>Qui puoi gestire le impostazioni generali della Biblioteca</h3>
            <p>Clicca sui pulsanti "Modifica" o "Elimina" per modificare o cancellare i dati.</p>
			<?php include __DIR__ . '/../php/edit-res.php'; ?>
            <table class="db-table">
                <thead class="db-thead">
                <tr class="db-tr">
                    <th class="db-th">Nome biblioteca</th>
                    <th class="db-th">id stanza</th>
                    <th class="db-th">Nome stanza</th>
                    <th class="db-th">Posti totali</th>
                    <th class="db-th">Posti disponibili</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$join = $wpdb->get_results( 'SELECT * FROM ' . $db::TABLE_BIBLIOTECA . ' INNER JOIN ' . $db::TABLE_BIBLIOTECA_STANZA .
				                            ' ON ' . $db::TABLE_BIBLIOTECA . '.id_biblioteca = ' . $db::TABLE_BIBLIOTECA_STANZA . '.id_biblioteca' );

				if ( ! empty( $join ) ):
				foreach ( $join

				as $row ):
				?>
                <tr class="db-tr">
                    <td class="db-td"><?= $row->nome_biblioteca; ?></td>
                    <td class="db-td"><?= $row->id_stanza; ?></td>
                    <td class="db-td"><?= $row->nome_stanza; ?></td>
                    <td class="db-td"><?= $row->posti_totali; ?></td>
                    <td class="db-td"><?= $row->posti_disponibili; ?></td>
					<?php
					endforeach;
					endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
