<?php include __DIR__ . '/../php/add-new-res.php'; ?>

<div class="wrap">
    <h1><?= esc_html( get_admin_page_title() ); ?></h1>
    <p>Compila tutti i campi e poi clicca su 'Aggiungi' per inserire una nuova prenotazione</p>
    <div id="tab-2" class="tab-pane">
        <form class="form-container" method="post" action="<?php echo htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>">
            <label for="nome_utente">Nome utente*
                <div class="form--error">
                    <input type="text" name="nome_utente" id="nome_utente" value="<?= $field['nome_utente'] ?>"
                           placeholder="Inserisci nome utente">
                    <p> <?= $error['nome_utente'] ?> </p>
                </div>
            </label>
            <label for="email_utente">Email utente*
                <div class="form--error">
                    <input type="text" name="email_utente" id="email_utente" value="<?= $field['email_utente'] ?>"
                           placeholder="Inserisci email utente">
                    <p> <?= $error['email_utente'] ?> </p>
                </div>
            </label>
            <label for="nome_stanza">Scegli stanza*
                <div class="form--error">
                    <select name="nome_stanza" id="nome_stanza">
                        <option value="<?= $field['nome_stanza']; ?>"> <?= ! empty( $field['nome_stanza'] ) ? $field['nome_stanza'] : 'Scegli stanza'; ?></option>
						<?php
						foreach ( $db->getRoomName() as $room ):
							?>
                            <option id="stanza" value="<?= $room->nome_stanza ?>"><?= $room->nome_stanza ?></option>
						<?php endforeach; ?>
                    </select>
                    <p> <?= $error['nome_stanza'] ?> </p>
                </div>
            </label>

            <label for="giorno">Giorno prenotazione*
                <div class="form--error">
                    <input type="date" name="giorno" id="giorno" value="<?= $field['giorno'] ?>" >
                    <p> <?= $error['giorno'] ?> </p>
                </div>
            </label>

            <label for="ora_arrivo">Ora arrivo*
                <div class="form--error">
                    <select name="ora_arrivo" id="ora_arrivo">
                        <option value="<?= $field['ora_arrivo']; ?>"> <?= ! empty( $field['ora_arrivo'] ) ? $field['ora_arrivo'] : 'Dalle'; ?></option>
						<?php
						foreach ( $db->getHours() as $hour ):
							?>
                            <option value="<?= $hour ?>"><?= $hour ?></option>
						<?php endforeach; ?>
                    </select>
                    <p> <?= $error['ora_arrivo'] ?> </p>
                </div>
            </label>

            <label for="ora_partenza">Ora partenza*
                <div class="form--error">
                    <select name="ora_partenza" id="ora_partenza">
                        <option value="<?= $field['ora_partenza']; ?>"> <?= !empty( $field['ora_partenza'] ) ? $field['ora_partenza'] : 'Alle' ?></option>
						<?php
						foreach ( $db->getHours() as $hour ):
							?>
                            <option value="<?= $hour ?>"><?= $hour ?></option>
						<?php endforeach; ?>
                    </select>
                    <p> <?= $error['ora_partenza'] ?> </p>
                </div>
            </label>
            <label for="tutto_il_giorno">Tutto il giorno
                <div class="form--error">
                    <input style="width: 10px" type="checkbox" name="tutto_il_giorno" id="tutto_il_giorno" <?php if($field['tutto_il_giorno'] === "si") echo "checked"; ?>>
                    <p> <?= $error['tutto_il_giorno'] ?> </p>
                </div>
            </label>
            <input type="submit" name="continua" id="continua" value="Continua">
        </form>

		<?php
		if ( isset( $_POST['continua'] ) && empty( array_filter( $error ) ) ):
			?>
            <div>
                <form class="form-container" method="post" action="<?php echo htmlspecialchars( $_SERVER['REQUEST_URI'] ); ?>">
                    <input type="hidden" name="id_utente" id="id_utente" value="<?= $field['id_utente']; ?>">
                    <input type="hidden" name="nome_utente" id="nome_utente" value="<?= $field['nome_utente']; ?>">
                    <input type="hidden" name="email_utente" id="email_utente" value="<?= $field['email_utente']; ?>">
                    <input type="hidden" name="nome_stanza" id="nome_stanza" value="<?= $field['nome_stanza']; ?>">
                    <input type="hidden" name="giorno" id="giorno" value="<?= $field['giorno']; ?>">
                    <input type="hidden" name="ora_arrivo" id="ora_arrivo" value="<?= $field['ora_arrivo']; ?>">
                    <input type="hidden" name="ora_partenza" id="ora_partenza" value="<?= $field['ora_partenza']; ?>">
                    <input type="hidden" name="tutto_il_giorno" value="<?= $field['tutto_il_giorno']?>">
                    <label for="numero_posto">Numero posto*
                        <div class="form--error">
                            <select name="numero_posto" id="numero_posto">
                                <option value=""><?= isset( $_POST['add'] ) ? $field['numero_posto'] : 'Scegli posto' ?></option>
								<?php
								foreach ( $db->getSeatNum( $field['giorno'], $field['ora_arrivo'], $field['ora_partenza'] ) as $seat ):
									?>
                                    <option value="<?= $seat->numero_posto ?>"><?= $seat->numero_posto ?></option>
								<?php
								endforeach;
								?>
                            </select>
                            <p> <?= $error['numero_posto'] ?> </p>
                        </div>
                    </label>
                    <input type="submit" name="add" id="add" class="button button-primary"
                           value="Aggiungi prenotazione">
                </form>
            </div>
		<?php endif; ?>
    </div>
</div>
