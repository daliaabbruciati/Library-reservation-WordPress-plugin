<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Crea account</title>
    <link rel="stylesheet" href="<?= plugin_dir_url( __DIR__ ) . '/../styles/signup.css'; ?>">
</head>
<body>

<?php
include 'header.html.php';

if ( isset( $_POST['registrati'] ) && $valid ){
	$_SESSION['nome']  = $field['nome'];
	$_SESSION['email'] = $field['email'];
}

?>
<div class="container">
    <h2>Crea account</h2>
    <div class="container__form">
        <form aria-label="Form crea nuovo account" class="form" action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ) ?>" method="post">
            <div class="form__nome-utente">
                <label for="user_login">Nome e cognome*</label>
                <div class="form--error">
                    <input aria-label="Inserisci nome utente" name="user_login" type="text" id="user_login" value="<?= $field['nome'] ?>"
                           placeholder="Inserisci nome e cognome">
                    <p aria-label="Errore campo nome utente"> <?= $error['nome'] ?> </p>
                </div>
            </div>
            <div class="form__username">
                <label for="user_nicename">Username*</label>
                <div class="form--error">
                    <input aria-label="Inserisci username" name="user_nicename" type="text" id="user_nicename" value="<?= $field['username'] ?>"
                           placeholder="Inserisci username">
                    <p aria-label="Errore campo username"> <?= $error['username'] ?> </p>
                </div>
            </div>
            <div class="form__email">
                <label for="user_email">Email*</label>
                <div class="form--error">
                    <input aria-level="Inserisci email utente" name="user_email" type="email" id="user_email" value="<?= $field['email'] ?>"
                           aria-describedby="emailHelp"
                           placeholder="Inserisci email">
                    <p aria-label="Errore campo email"> <?= $error['email'] ?> </p>
                </div>
            </div>
            <div class="form__password">
                <label for="user_pass">Password*</label>
                <div class="form--error">
                    <input aria-level="Inserisci password utente" name="user_pass" type="password" id="user_pass" placeholder="Inserisci password">
                    <p aria-label="Errore campo password"> <?= $error['password'] ?> </p>
                </div>
            </div>
            <input type="hidden" name="user_registered" id="user_registered">
            <input aria-level="Conferma creazione account" class="form__submit" type="submit" name="registrati" value="Crea account">
        </form>
        <p>Hai gia un account? <a aria-label="Link alla pagina di accesso" href="/prenotazione">Torna indietro e accedi</a></p>
    </div>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>
