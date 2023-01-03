<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../../DB/Database.php';
$db = new Database( __FILE__ );


//add_action('template_redirect', function () {
//	ob_start();
//if ( isset( $_POST['data-id'] ) ) {
//	header( 'http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php' );
//	//				refresh();
//}
//});

?>

<!doctype html>

<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vista prenotazioni</title>
    <script src="<?= plugin_dir_url( __DIR__ ) . '/../js/script.js'; ?>"></script>
</head>
<body>
<div class="wrap">
    <h1>Vista della lista delle prenotazioni </h1>
	<?php
	settings_errors();

	date_default_timezone_set( "Europe/Rome" );
	$currentDate = date( 'Y-m-d' );
	$currentTime = date( "H:i:s" );
	?>

    <div class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Vista prenotazioni</a></li>
        <li><a href="#tab-2">Vista impostazioni</a></li>
    </div>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="t--header">
                <h4 class="t-header-title">Prenotazioni attive</h4>
                <form method="post" action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ) ?>">
                    <input type="submit" name="delete-all" id="delete-all"
                           class="button button-link-delete"
                           value="Elimina tutto">
                </form>
            </div>

			<?php
			function refresh() {
				echo "<script> window.location.reload() </script>";
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
						if ( ( $currentDate > $row->giorno ) || ( $currentDate === $row->giorno && $currentTime >= $row->ora_partenza ) ) {
							continue;
						}
						?>
                        <tr class='db-tr' id='table-row'>
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
                            <td class="db-td">
                                <?php if($row->qr_code === '0'):
                                ?>
                                <img width="10px" height="10px" alt="cross" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/cross.png' ?>">
                                <?php else:?>
                                    <img width="10px" height="10px" alt="check" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/check.jpg' ?>">
                                <?php endif; ?>
                            </td>
                            <td class="db-td">

                                <form method="post"
                                      action="/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fedit-res.html.php">
                                    <input type="hidden" name="id_prenotazione" value="<?= $row->id_prenotazione; ?>">
                                    <input type='submit' name='edit' id='edit' class='button button - secondary'
                                           value='Modifica'>
                                </form>
                            </td>
                            <td class="db-td">
								<?php
								if ( isset( $_POST['data-id'] ) ) {
									$db->delete( $row );
									refresh();
								}
								?>
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
						$db->updateSeatsInRoom( $row->nome_stanza );
					endforeach;
					if ( isset( $_POST['delete-all'] ) ) {
						$db->deleteAll( $row );
						refresh();
					}
				endif;
				?>
                </tbody>
            </table>

            <!-- tabella prenotazioni scadute -->
            <div class="tscadute-table">
                <h4 class="t-header-title">Prenotazioni scadute</h4>
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
					if ( ! empty( $result ) ):
						foreach ( $result as $row ):
							if ( ( ( $currentDate < $row->giorno ) || ( $currentDate === $row->giorno && $currentTime < $row->ora_partenza ) ) ) {
								continue;
							}
							?>
                            <tr class='db-tr' id='table-row' style='background-color: #c0c0c0; color: #979797'>
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
                                <td class="db-td">
	                                <?php if($row->qr_code === '0'):
		                                ?>
                                        <img width="10px" height="10px" alt="cross" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/cross.png' ?>">
	                                <?php else:?>
                                        <img width="10px" height="10px" alt="check" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/check.jpg' ?>">
	                                <?php endif; ?>
                                </td>
                                <td class="db-td">

                                    <form method="post"
                                          action="/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fedit-res.html.php">
                                        <input type="hidden" name="id_prenotazione"
                                               value="<?= $row->id_prenotazione; ?>">
                                        <input type='submit' name='edit' id='edit' disabled
                                               class='button button - secondary'
                                               value='Scaduta'>
                                    </form>
                                </td>
                                <td class="db-td">
									<?php
									if ( isset( $_POST['data-id'] ) ) {
										$db->delete( $row );
										refresh();
									}
									?>
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
							$db->updateSeatsInRoom( $row->nome_stanza );
						endforeach;
					endif;
					?>
                    </tbody>
                </table>
            </div>
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
                    <th class="db-th">Giorno</th>
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
                    <td class="db-td"><?= $currentDate ?></td>
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
