<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Signup</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/signup.css'; ?>">
</head>
<body>
<?php
wp_head();
get_header();
//wp_nav_menu([
//    'theme_location' => 'library-primary-menu'
//]);

?>

<div class="container">
    <?php
    if(!isset($_POST['registrati'])):
    ?>
    <h2>Crea account</h2>
    <div class="container__form">
        <form class="form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form__nome-utente">
                <label for="user_login">Nome e cognome</label>
                <input name="user_login" type="text" id="user_login">
            </div>
            <div class="form__nome-utente">
                <label for="user_nicename">Username</label>
                <input name="user_nicename" type="text" id="user_nicename">
            </div>
            <div class="form__email">
                <label for="user_email">Email </label>
                <input name="user_email" type="email" id="user_email" aria-describedby="emailHelp">
            </div>
            <div class="form__password">
                <label for="user_pass">Password</label>
                <input name="user_pass" type="password" id="user_pass">
            </div>
            <input type="hidden" name="user_registered" id="user_registered">
            <input class="form__submit" type="submit" name="registrati" value="Crea account">
        </form>
        <p>Hai gia un account? <a href="/prenotazione">Torna indietro e accedi</a></p>
    </div>
    <?php
    else:
        $result = $wpdb->insert($db_table_utenti,[
            'user_login' => $_POST['user_login'],
            'user_nicename' => $_POST['user_nicename'],
            'user_email' => $_POST['user_email'],
            'user_pass' => $_POST['user_pass'],
            'user_registered' => current_datetime()->format('Y-m-d H:i:s')
        ] );
        if($result == 1){
            echo "<script>alert('Dati inseriti correttamente')</script>";
        }else{
            echo "<script>alert('Dati NON inseriti')</script>";
        }
    ?>
    <div class="container__successfull">
        <form class="form form__successfull" method="post" action="/scegli-posto">
            <h2>Account creato con successo!</h2>
            <p>Clicca su "Continua" per prenotare il tuo posto</p>
            <input class="form__submit" type="submit" name="continua" value="Continua">
        </form>
    </div>
    <?php endif;
    ?>
</div>

<?php

//if(isset($_POST['registrati'])){
//    $result = $wpdb->insert($db_table_utenti,[
//            'user_login' => $_POST['user_login'],
//            'user_nicename' => $_POST['user_nicename'],
//            'user_email' => $_POST['user_email'],
//            'user_pass' => $_POST['user_pass']
//    ] );
//    if($result == 1){
//        echo "<script>alert('Dati inseriti correttamente')</script>";
//    }else{
//        echo "<script>alert('Dati NON inseriti')</script>";
//    }
//}

get_footer(); ?>

</body>
</html>
