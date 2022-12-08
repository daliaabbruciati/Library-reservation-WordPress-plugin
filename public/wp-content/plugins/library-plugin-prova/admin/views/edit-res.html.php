<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../../DB/Database.php';
$db = new Database( __FILE__ );

?>

<?php
if ( $_SERVER["REQUEST_METHOD"] == "POST" ):
	?>
    <div class="wrap">
        <h1><?= esc_html( get_admin_page_title() ); ?></h1>
        <h4>Modifica i campi e poi clicca su 'Salva modifiche' per aggiornare i dati dell'utente utente</h4>
		<?php
		$oldValues = $wpdb->get_results( "SELECT * FROM " . $db::TABLE_PRENOTAZIONE .
		                                 " WHERE id_prenotazione = '" . $_POST['id_prenotazione'] . "';" );
		print_r( $oldValues );
		?>
        <div id="tab-2" class="tab-pane">
            <form class="form-container" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">
				<?php
				if ( ! empty( $oldValues ) ):
				foreach ( $oldValues as $old ):
				?>
                <input type="hidden" name="id_utente" id="id_utente" value="<?= $old->id_utente ?>">

                <label for="nome_utente">Nome utente
                    <div>
                        <input type="text" name="nome_utente" id="nome_utente" value="<?= $old->nome_utente ?>">
                    </div>
                </label>

                <label for="email_utente">Email utente
                    <div>
                        <input type="text" name="email_utente" id="email_utente" value="<?= $old->email_utente ?>">
                    </div>
                </label>

                <label for="nome_stanza">Stanza
                    <div>
                        <select name="nome_stanza" id="nome_stanza">
                            <option value="<?=  $old->nome_stanza ?>"> <?=  $old->nome_stanza ?></option>
							<?php
							foreach ( $db->getRoomName() as $room ):
								?>
                                <option id="stanza" value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                </label>

                <label for="giorno">Giorno prenotazione
                    <div>
                        <input type="date" name="giorno" value="<?= $old->giorno ?>">
                    </div>
                </label>

                <label for="ora_arrivo">Ora arrivo
                    <div>
                        <select name="ora_arrivo" id="ora_arrivo">
                            <option value="<?= $old->ora_arrivo; ?>"> <?= $old->ora_arrivo; ?> </option>
							<?php
							foreach ( $db->getHours() as $hour ):
								?>
                                <option value="<?= $hour ?>"><?= $hour ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                </label>

                <label for="ora_partenza">Ora partenza
                    <div>
                        <select name="ora_partenza" id="ora_partenza">
                            <option value="<?= $old->ora_partenza ?>"> <?= $old->ora_partenza ?></option>
							<?php
							foreach ( $db->getHours() as $hour ):
								?>
                                <option value="<?= $hour ?>"><?= $hour ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                </label>

                <label for="tutto_il_giorno">tutto il giorno
                    <div>
                        <input type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno" value="<?= $old->tutto_il_giorno ?>" <?php if($old->tutto_il_giorno == "si") echo "checked" ?>  >
                    </div>
                </label>

                <label for="numero_posto">Numero posto
                    <div>
                        <select name="numero_posto" id="numero_posto">
                            <option value="<?= $old->numero_posto ?>"><?= $old->numero_posto ?></option>
							<?php
							foreach ( $db->getSeatNum( $old->giorno, $old->ora_arrivo, $old->ora_partenza ) as $seat ):
								?>
                                <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
							<?php
							endforeach;
							?>
                        </select>
                    </div>
                </label>
                <?php include __DIR__ . '/../php/edit-res.php'; ?>
                <form method="post" action="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">
                    <input type="hidden" name="id_prenotazione" value="<?= $old->id_prenotazione; ?>">
                    <input type="submit" name="update" id="update" class="button button-primary"
                           value="Salva modifiche">
                </form>
            </form>
			<?php
			endforeach;
			endif;
			?>
        </div>
    </div>

<?php
else:
	?>
    <h3>Vai alla schermata <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a>
        e clicca sul pulsante 'Modifica' per aggiornare i dati dell'utente</h3>

<?php endif; ?>
