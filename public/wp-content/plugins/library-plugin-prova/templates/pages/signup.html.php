<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Crea account</title>
    <link rel="stylesheet" href="<?= plugin_dir_url(__DIR__) . '/../css/signup.css'; ?>">
</head>
<body>
<?php
wp_head();
get_header();
//wp_nav_menu([
//    'theme_location' => 'library-primary-menu'
//]);
?>

<?php
if (isset($_POST['registrati']) && $valid):
    include_once __DIR__ . '/./register-success.html.php';
    ?>
<?php

else:

?>
<div class="container">
    <h2>Crea account</h2>
    <div class="container__form">
        <form class="form" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post">
            <div class="form__nome-utente">
                <label for="user_login">Nome e cognome</label>
                <div class="form--error">
                    <input name="user_login" type="text" id="user_login" value="<?= $nome ?>"
                           placeholder="Inserisci nome e cognome">*
                    <p> <?= $errors['nome'] ?> </p>
                </div>
            </div>
            <div class="form__nome-utente">
                <label for="user_nicename">Username</label>
                <div class="form--error">
                    <input name="user_nicename" type="text" id="user_nicename" value="<?= $username ?>"
                           placeholder="Inserisci username">*
                    <p> <?= $errors['username'] ?> </p>
                </div>
            </div>
            <div class="form__email">
                <label for="user_email">Email </label>
                <div class="form--error">
                    <input name="user_email" type="email" id="user_email" value="<?= $email ?>"
                           aria-describedby="emailHelp"
                           placeholder="Inserisci email">*
                    <p> <?= $errors['email'] ?> </p>
                </div>
            </div>
            <div class="form__password">
                <label for="user_pass">Password</label>
                <div class="form--error">
                    <input name="user_pass" type="password" id="user_pass" placeholder="Inserisci password">*
                    <p> <?= $errors['password'] ?> </p>
                </div>
            </div>
            <input type="hidden" name="user_registered" id="user_registered">
            <input class="form__submit" type="submit" name="registrati" value="Crea account">
        </form>
        <p>Hai gia un account? <a href="/prenotazione">Torna indietro e accedi</a></p>
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

</body>
</html>
