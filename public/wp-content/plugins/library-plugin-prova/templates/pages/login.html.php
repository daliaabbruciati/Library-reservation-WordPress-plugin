<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Accedi</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__) . '/../styles/login.css'; ?>">
</head>
<body>

<?php include 'header.html.php';

if (isset($_POST['submit-login']) && empty(array_filter($error))){
    $_SESSION['nome'] = $checkUserName;
    $_SESSION['email'] = $field['email'];
}

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
        <form class="form" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post">
            <div class="form__email">
                <label for="user_email">Email</label>
                <div class="form--error">
                    <input name="user_email" type="email" id="user_email" value="<?= $field['email'] ?>">
                    <p><?= $error['email']; ?></p>
                </div>
            </div>
            <div class="form__password">
                <label for="user_pass">Password</label>
                <div class="form--error">
                    <input name="user_pass" type="password" id="user_pass" value="<?= $field['password'] ?>">
                    <p><?= $error['password']; ?></p>
                </div>
            </div>
            <div class="form__submit">
            <input class="submit" type="submit" name="submit-login" value="Accedi">
            </div>
        </form>
        <p class="container__go-to-signup">
            Non sei ancora registrato? <a href="/signup">Crea account</a>
        </p>
    </div>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>
