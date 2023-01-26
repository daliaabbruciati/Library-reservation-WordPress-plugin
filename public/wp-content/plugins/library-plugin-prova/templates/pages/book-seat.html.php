<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Scegli posto</title>
    <link rel="stylesheet" href="<?= plugin_dir_url( __DIR__ ) . '/../styles/book-seat.css'; ?>">
    <script src="<?= plugin_dir_url( __DIR__ ) . '/../js/book-seat.js'; ?>"></script>
</head>
<body>

<?php

if ( isset( $_GET['download'] ) ) {
	ob_end_clean();
	$email = urlencode( $_GET['email'] );
	$url   = "https://api.qrserver.com/v1/create-qr-code/?data=$email&size=200x200&margin=15&format=jpg";
	header( "Content-Type: image/jpg" );
	header( "Content-Transfer-Encoding: Binary" );
	header( "Content-Disposition: attachment; filename=qrcode.jpg" );
	readfile( $url );
	exit( 0 );
}
include 'header.html.php';

if ( isset( $_POST['submit_prenotazione'] ) && empty( array_filter( $error ) ) ):
	include_once __DIR__ . '/./booking-success.html.php';
else:
	?>
    <div class="container">
        <div class="container__description">
            <p>Ciao <strong><?= $_SESSION['nome'] ?></strong>.</p>
            <p hidden><?= $_SESSION['email'] ?></p>
			<?php
			$findUser = $wpdb->get_results( "SELECT * FROM " . $db::TABLE_UTENTI . " WHERE user_email = '" . $_SESSION['email'] . "';" );

			?>
            <p>Di seguito troverai: a sinistra il form con i campi da completare e a destra la piantina della biblioteca
                con
                i
                relativi tavoli numerati.</p>
            <p>Una volta completato, clicca su 'Conferma' per effettuare la prenotazione.</p>
            <p>Sei hai gia effettuato una prenotazione vai al <a href="/riepilogo">riepilogo</a></p>
        </div>
        <div class="container__content">
            <div class="container__form">
                <h2>Prenota posto</h2>
				<?php
				if ( isset( $_POST['id_prenotazione'] ) && isset( $_POST['update'] ) ) {
					echo "<h6 style='padding: 14px; color: #220dea; width: 521px;'>
                            Prenotazione modificata correttamente. Torna al <a href='/riepilogo'>riepilogo prenotazioni.</a></h6>";
				}
				?>
                <form class="form" action="<?php echo htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>"
                      method="post">
					<?php
					foreach ( $findUser as $user ):
						?>
                        <input type="hidden" name="id_utente" id="id_utente"
                               value="<?= $field['id_utente'] = $user->ID ?>">
                        <input type="hidden" name="nome_utente" id="nome_utente"
                               value="<?= $field['nome_utente'] = $user->user_login ?>">
                        <input type="hidden" name="email_utente" id="email_utente"
                               value="<?= $field['email_utente'] = $user->user_email ?>">
					<?php endforeach; ?>
                    <div class="form__stanza">
                        <label for="nome_stanza">Scegli stanza</label>
                        <div class="form--error">
                            <select name="nome_stanza" id="nome_stanza">
                                <option value="<?= $field['nome_stanza']; ?>"> <?= ! empty( $field['nome_stanza'] ) ? $field['nome_stanza'] : 'Scegli stanza'; ?></option>
								<?php
								foreach ( $db->getRoomName() as $room ):
									?>
                                    <option id="stanza"
                                            value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
								<?php endforeach; ?>
                            </select>
                            <p><?= $error['nome_stanza'] ?></p>
                        </div>
                    </div>
                    <div class="form__giorno">
                        <label for="giorno">Scegli giorno</label>
                        <div class="form--error">
                            <input type="date" name="giorno" id="giorno" value="<?= $field['giorno']; ?>">
                            <p><?= $error['giorno'] ?></p>
                        </div>
                    </div>
                    <div class="form__ora-arrivo">
                        <label for="ora_arrivo">Ora arrivo</label>
                        <div class="form--error">
                            <select name="ora_arrivo" id="ora_arrivo">
                                <option value="<?= $field['ora_arrivo']; ?>"> <?= ! empty( $field['ora_arrivo'] ) ? $field['ora_arrivo'] : 'Dalle'; ?></option>
								<?php
								foreach ( $db->getHours() as $hour ):
									?>
                                    <option value="<?= $hour ?>"><?= $hour ?></option>
								<?php endforeach; ?>
                            </select>
                            <p><?= $error['ora_arrivo'] ?></p>
                        </div>
                    </div>
                    <div class="form__ora-partenza">
                        <label for="ora_partenza">Ora partenza</label>
                        <div class="form--error">
                            <select name="ora_partenza" id="ora_partenza">
                                <option value="<?= $field['ora_partenza']; ?>"> <?= ! empty( $field['ora_partenza'] ) ? $field['ora_partenza'] : 'Alle' ?></option>
								<?php
								foreach ( $db->getHours() as $hour ):
									?>
                                    <option value="<?= $hour ?>"><?= $hour ?></option>
								<?php endforeach; ?>
                            </select>
                            <p style="max-width: 100px"><?= $error['ora_partenza'] ?></p>
                        </div>
                    </div>
                    <div class="form__tutto-il-giorno">
                        <label for="tutto_il_giorno">Tutto il giorno</label>
                        <div class="checkbox">
                            <input type="checkbox" name="tutto_il_giorno"
                                   id="tutto_il_giorno" <?php if ( $field['tutto_il_giorno'] === "si" ) {
								echo "checked";
							} ?>>
                            <p class="form--error"><?= $error['tutto_il_giorno'] ?></p>
                            <p style="font-size: 13px">Dalle 09:00 alle 18:30</p>
                        </div>
                    </div>
					<?php if ( ! isset( $_POST['submit_prenotazione'] ) || ( empty( array_filter( $error ) ) ) ):
						?>
                        <input class="form__submit" type="submit" id="continua" name="continua"
                               value="Continua">
					<?php endif; ?>
					<?php if ( isset( $_POST['id_prenotazione'] ) ): ?>
                        <input type="hidden" name="id_prenotazione" id="id_prenotazione"
                               value="<?= $_POST['id_prenotazione'] ?>">
					<?php endif; ?>
                </form>
				<?php
				if ( isset( $_POST['id_prenotazione'] ) && isset( $_POST['continua'] ) ):
					?>
                    <div class="container__form">
                        <form class="form" method="post" action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>">
                            <input type="hidden" name="id_prenotazione" id="id_prenotazione"
                                   value="<?= $field['id_prenotazione']; ?>">
                            <input type="hidden" name="id_utente" id="id_utente"
                                   value="<?= $field['id_utente']; ?>">
                            <input type="hidden" name="nome_utente" id="nome_utente"
                                   value="<?= $field['nome_utente']; ?>">
                            <input type="hidden" name="email_utente" id="email_utente"
                                   value="<?= $field['email_utente']; ?>">
                            <input type="hidden" name="nome_stanza" id="nome_stanza"
                                   value="<?= $field['nome_stanza']; ?>">
                            <input type="hidden" name="giorno" id="giorno" value="<?= $field['giorno']; ?>">
                            <input type="hidden" name="ora_arrivo" id="ora_arrivo"
                                   value="<?= $field['ora_arrivo']; ?>">
                            <input type="hidden" name="ora_partenza" id="ora_partenza"
                                   value="<?= $field['ora_partenza']; ?>">
                            <input type="hidden" name="tutto_il_giorno" value="<?= $field['tutto_il_giorno']; ?>">
                            <div class="form__posto">
                                <label for="numero_posto">Scegli posto disponibile</label>
                                <div class="form--error">
                                    <select name="numero_posto" id="numero_posto">
                                        <option value=""> <?= isset( $_POST['submit_prenotazione'] ) ? $field['numero_posto'] : 'Scegli posto' ?></option>
										<?php
										foreach ( $db->getAvailableSeats( $field['giorno'], $field['ora_arrivo'], $field['ora_partenza'] ) as $seat ):
											?>
                                            <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
										<?php
										endforeach;
										?>
                                    </select>
                                    <p><?= $error['numero_posto'] ?></p>
                                </div>
                            </div>
                            <input class="form__submit" type="submit" id="update" name="update"
                                   value="Salva modifiche">
                        </form>
                    </div>
				<?php else:
					if ( isset( $_POST['continua'] ) && empty( array_filter( $error ) ) || ! empty( $error['numero_posto'] ) ):
						?>
                        <div class="container__form">
                            <form class="form" method="post"
                                  action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>">
                                <input type="hidden" name="id_utente" id="id_utente"
                                       value="<?= $field['id_utente']; ?>">
                                <input type="hidden" name="nome_utente" id="nome_utente"
                                       value="<?= $field['nome_utente']; ?>">
                                <input type="hidden" name="email_utente" id="email_utente"
                                       value="<?= $field['email_utente']; ?>">
                                <input type="hidden" name="nome_stanza" id="nome_stanza"
                                       value="<?= $field['nome_stanza']; ?>">
                                <input type="hidden" name="giorno" id="giorno" value="<?= $field['giorno']; ?>">
                                <input type="hidden" name="ora_arrivo" id="ora_arrivo"
                                       value="<?= $field['ora_arrivo']; ?>">
                                <input type="hidden" name="ora_partenza" id="ora_partenza"
                                       value="<?= $field['ora_partenza']; ?>">
                                <input type="hidden" name="tutto_il_giorno" value="<?= $field['tutto_il_giorno']; ?>">
                                <div class="form__posto">
                                    <label for="numero_posto">Scegli posto disponibile</label>
                                    <div class="form--error">
                                        <select name="numero_posto" id="numero_posto">
                                            <option value=""> <?= isset( $_POST['submit_prenotazione'] ) ? $field['numero_posto'] : 'Scegli posto' ?></option>
											<?php
											foreach ( $db->getAvailableSeats( $field['giorno'], $field['ora_arrivo'], $field['ora_partenza'] ) as $seat ):
												?>
                                                <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
											<?php
											endforeach;
											?>
                                        </select>
                                        <p><?= $error['numero_posto'] ?></p>
                                    </div>
                                </div>
                                <input class="form__submit" type="submit" id="submit_prenotazione"
                                       name="submit_prenotazione"
                                       value="Conferma">
                            </form>
                        </div>
					<?php
					endif;
				endif; ?>
            </div>
            <div class="container__image">
				<?php
				/* Query che restituisce il numero di posti disponibili nella stanza */
				$availableSeats = $wpdb->get_var( "SELECT posti_disponibili FROM " . $db::TABLE_BIBLIOTECA_STANZA .
				                                  " WHERE nome_stanza = '" . $field['nome_stanza'] . "';" );
				?>
                <p style="text-align: center">Posti disponibili: <?= $availableSeats ?>/ 108</p>
                <img src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/piantina_posti.svg' ?>"
                     alt="piantina-posti"/>
            </div>
        </div>
    </div>
<?php
endif;
include 'footer.html.php'; ?>
</body>
</html>
