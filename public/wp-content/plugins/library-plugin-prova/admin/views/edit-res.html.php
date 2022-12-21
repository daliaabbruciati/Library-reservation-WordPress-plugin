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
    <h3>Modifica i campi e poi clicca su 'Salva modifiche' per aggiornare i dati dell'utente utente.</h3>
    <p> Oppure torna alla schermata
        <a href="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">
            'Lista prenotazioni'
        </a>

    </p>
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
            <input type="hidden" name="id_prenotazione" id="id_prenotazione" value="<?= $old->id_prenotazione ?>">
            <input type="hidden" name="id_utente" id="id_utente" value="<?= $old->id_utente ?>">

            <label for="nome_utente">Nome utente
                <div class="form--error">
                    <input type="text" name="nome_utente" id="nome_utente"
                           value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['nome_utente'] : $old->nome_utente ?>">
                </div>
            </label>
            <label for="email_utente">Email utente
                <div class="form--error">
                    <input type="text" name="email_utente" id="email_utente"
                           value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['email_utente'] : $old->email_utente ?>">
                </div>
            </label>
            <label for="nome_stanza">Stanza
                <div>
                    <select name="nome_stanza" id="nome_stanza">
                        <option value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['nome_stanza'] : $old->nome_stanza ?>"> <?= ( isset( $_POST['continua'] ) ) ? $_POST['nome_stanza'] : $old->nome_stanza ?></option>
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
                    <input type="date" name="giorno"
                           value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['giorno'] : $old->giorno ?>">
                </div>
            </label>
            <label for="ora_arrivo">Ora arrivo
                <div>
                    <select name="ora_arrivo" id="ora_arrivo">
                        <option value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['ora_arrivo'] : $old->ora_arrivo; ?>"> <?= ( isset( $_POST['continua'] ) ) ? $_POST['ora_arrivo'] : $old->ora_arrivo; ?> </option>
						<?php
						foreach ( $db->getHours() as $hour ):
							?>
                            <option value="<?= $hour ?>"><?= $hour ?></option>
						<?php endforeach; ?>
                    </select>
                </div>
            </label>
            <label for="ora_partenza">Ora partenza
                <div class="form--error">
                    <select name="ora_partenza" id="ora_partenza">
                        <option value="<?= ( isset( $_POST['continua'] ) ) ? $_POST['ora_partenza'] : $old->ora_partenza ?>"> <?= ( isset( $_POST['continua'] ) ) ? $_POST['ora_partenza'] : $old->ora_partenza; ?></option>
						<?php
						foreach ( $db->getHours() as $hour ):
							?>
                            <option value="<?= $hour ?>"><?= $hour ?></option>
						<?php endforeach; ?>
                    </select>
                </div>
            </label>
            <label for="tutto_il_giorno">tutto il giorno
                <div class="form--error">
                    <input style="width: 10px"
                           type="checkbox"
                           name="tutto_il_giorno"
                           id="tutto_il_giorno"
						<?php
						if ( $old->tutto_il_giorno === "si" ) {
							echo "checked";
						}
						?> >
                </div>
            </label>
            <input type="submit" name="continua" value="Continua">
            </form>
			<?php
			include __DIR__ . '/../php/edit-res.php';
			if ( isset( $_POST['continua'] ) ):
				print_r( $oldValues );
				var_dump( $_POST );
				var_dump( $old );
				var_dump( $old->giorno, $old->ora_arrivo, $old->ora_partenza, $old->tutto_il_giorno );
				var_dump( $_POST['giorno'], $_POST['ora_arrivo'], $_POST['ora_partenza'] );
				?>
                <form class="form-container" method="post"
                      action="<?php echo htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>">
                    <!--                <form class="form-container" method="post" action="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">-->
                    <input type="hidden" name="id_prenotazione" id="id_prenotazione"
                           value="<?= $old->id_prenotazione ?>">
                    <input type="hidden" name="id_utente" id="id_utente" value="<?= $old->id_utente; ?>">
                    <input type="hidden" name="nome_utente" id="nome_utente" value="<?= $old->nome_utente; ?>">
                    <input type="hidden" name="email_utente" id="email_utente" value="<?= $old->email_utente; ?>">
                    <input type="hidden" name="nome_stanza" id="nome_stanza" value="<?= $old->nome_stanza; ?>">
                    <input type="hidden" name="giorno" id="giorno" value="<?= $old->giorno; ?>">
                    <input type="hidden" name="ora_arrivo" id="ora_arrivo" value="<?= $old->ora_arrivo; ?>">
                    <input type="hidden" name="ora_partenza" id="ora_partenza" value="<?= $old->ora_partenza; ?>">
	                <?php
//	                if($old->ora_arrivo > $old->ora_partenza){
//		                echo "<p><span class='error-field'>Errore: ora di arrivo maggiore dell'ora di partenza.</span></p>";
//	                }
	                ?>
                    <input type="hidden" name="tutto_il_giorno" id="tutto_il_giorno"
                           value="<?= $old->tutto_il_giorno ?>">
                    <label for="numero_posto">Numero posto
                        <div class="form--error">
                            <select name="numero_posto" id="numero_posto">
                                <option value="<?= isset( $_POST['update'] ) ? $_POST['numero_posto'] : $old->numero_posto ?>"><?= isset( $_POST['update'] ) ? $_POST['numero_posto'] : $old->numero_posto ?></option>
								<?php
								foreach ( $db->getAvailableSeats( $_POST['giorno'], $_POST['ora_arrivo'], $_POST['ora_partenza'] ) as $seat ):
									?>
                                    <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
								<?php
								endforeach;
								?>
                            </select>
                        </div>
                    </label>
                    <input type="submit" name="update" id="update" class="button button-primary"
                           value="Salva modifiche">
                    <!---->
                    <!--                    <input type="hidden" name="id_prenotazione" value="-->
					<?//= $old->id_prenotazione;
					?><!--">-->
                    <!--                    <input type="submit" name="update" id="update" class="button button-primary"-->
                    <!--                           value="Salva modifiche">-->
                </form>
                </div>
			<?php
			endif; // di if(isset$_POST['continua'])
			print_r( $oldValues );
			?>
            </div>

		<?php
		endforeach;
	endif;

endif; // del primo if in alto, request method
//else:
if ( $_SERVER['REQUEST_METHOD'] !== "POST" ):
	?>
    <h3>Vai alla schermata <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a>
        e clicca sul pulsante 'Modifica' per aggiornare i dati dell'utente</h3>
<?php endif; ?>
