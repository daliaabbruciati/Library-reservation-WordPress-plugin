<?php
require_once __DIR__.'/../includes/functions/function.php';

$nomeErr = $usernameErr = $emailErr = $passErr = '';
$nome = $username = $email = $password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['user_login'];
    $username = $_POST['user_nicename'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    $valid = true;
// check form fields
    if (empty($_POST['user_login']) || empty($_POST['user_nicename']) || empty($_POST['user_email']) || empty($_POST['user_pass'])) {
        if (empty($_POST['user_login']) || !isValidName($_POST['user_login'])) {
            $nomeErr = 'Compila campo nome';
            $valid = false;
        }
        if (empty($_POST['user_nicename'])) {
            $usernameErr = 'Compila campo username';
            $valid = false;
        }
        if (empty($_POST['user_email']) || !isValidEmail($_POST['user_email'])) {
            $emailErr = 'Compila campo email';
            $valid = false;
        }
        if (empty($_POST['user_pass']) || !isValidPassword($_POST['user_pass'])) {
            $passErr = 'Compila campo password';
            $valid = false;
        }
        echo '<script> alert("ERRORE: dati errati") </script>';
    } else {
        $wpdb->insert($db_table_utenti, [
            'user_login' => $_POST['user_login'],
            'user_nicename' => $_POST['user_nicename'],
            'user_email' => $_POST['user_email'],
            'user_pass' => md5($_POST['user_pass']),
            'user_registered' => current_datetime()->format('Y-m-d H:i:s')
        ]);
        echo '<script> alert("Dati inseriti correttamente") </script>';
    }
}
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Crea account</title>
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

<?php
    if (isset($_POST['registrati']) && $valid):
        include_once __DIR__ . '/register-successful.php';
?>

<?php
else:
?>
<div class="container">
    <h2>Crea account</h2>
    <div class="container__form">
        <form class="form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form__nome-utente">
                <label for="user_login">Nome e cognome</label>
                <div class="form--error">
                    <input name="user_login" type="text" id="user_login" placeholder="Inserisci nome e cognome">*
                    <p> <?php echo $nomeErr ?> </p>
                </div>
            </div>
            <div class="form__nome-utente">
                <label for="user_nicename">Username</label>
                <div class="form--error">
                    <input name="user_nicename" type="text" id="user_nicename" placeholder="Inserisci username">*
                    <p> <?php echo $usernameErr ?> </p>
                </div>
            </div>
            <div class="form__email">
                <label for="user_email">Email </label>
                <div class="form--error">
                    <input name="user_email" type="email" id="user_email" aria-describedby="emailHelp"
                           placeholder="Inserisci email">*
                    <p> <?php echo $emailErr ?> </p>
                </div>
            </div>
            <div class="form__password">
                <label for="user_pass">Password</label>
                <div class="form--error">
                    <input name="user_pass" type="password" id="user_pass" placeholder="Inserisci password">*
                    <p> <?php echo $passErr ?> </p>
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
