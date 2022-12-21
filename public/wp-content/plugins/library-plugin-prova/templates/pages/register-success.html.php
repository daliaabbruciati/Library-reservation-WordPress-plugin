<div class="container__successfull">
    <form class="form form__successfull" method="post" action="/scegli-posto">
        <input type="hidden" value="<?=$field['nome']?>">
        <input type="hidden" value="<?=$field['username']?>">
        <input type="hidden" value="<?=$field['email']?>">
        <h2>Account creato con successo!</h2>
        <p>Clicca su "Continua" per prenotare il tuo posto</p>
        <input class="form__submit" type="submit" name="continua" value="Continua">
    </form>
</div>
