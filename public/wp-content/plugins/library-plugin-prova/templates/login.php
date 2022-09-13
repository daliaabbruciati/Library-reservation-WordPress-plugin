
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Accedi</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/login.css'; ?>">
</head>
<body>

<?php
//session_start();
wp_head();
get_header();
//wp_nav_menu([
//    'theme_location' => 'library-primary-menu'
//]);

?>

<div class="container">
    <div class="container__welcome">
        <h1>Benvenuto in Biblioteca</h1>
        <p class="container__welcome--paragraph">
            Questo portale ti permetterà di scegliere e prenotare il tuo posto in sala studio nel giorno e nella fascia
            oraria che desideri.
        </p>
        <p><strong>Accedi</strong> per proseguire.</p>
    </div>
    <div class="container__form">
        <form class="form" action="/scegli-posto" method="post">
            <div class="form__email">
                <label for="user_email">Email</label>
                <input name="user_email" type="email" id="user_email" aria-describedby="emailHelp">
            </div>
            <div class="form__password">
                <label for="user_pass">Password</label>
                <input name="user_pass" type="password" id="user_pass">
            </div>

            <input class="form__submit" type="submit" name="submit_user" value="Accedi">
        </form>
        <p class="container__go-to-signup">
            Non sei ancora registrato? <a href="/signup">Crea account</a>
        </p>
    </div>
</div>


<?php
    if(isset($_POST['submit_user'])){
        include __DIR__.'/../includes/functions/function.php';
    }

get_footer(); ?>

</body>
</html>
