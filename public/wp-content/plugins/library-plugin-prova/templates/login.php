<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Login</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/login.css'; ?>">
</head>
<body>
<?php
    wp_head();
    get_header();
?>

<div class="container">
    <div class="container__welcome">
    <h1>Benvenuto nella Biblioteca</h1>
    <p>
        Questo portale ti permetterà di scegliere e prenotare il tuo posto in sala studio nel giorno e nella fascia
        oraria che desideri.
    </p>
    <p class="container__welcome--access-info"><strong>Accedi</strong> o <strong>registrati</strong> per proseguire.</p>
    </div>
    <div class="container__login">
        <form action="" method="post">
            <div>
                <label for="email">Email</label>
                <input name="email" type="email" id="email" aria-describedby="emailHelp">
            </div>
            <div>
                <label for="password">Password</label>
                <input name="password" type="password" id="password">
            </div>

            <input type="submit" name="submit_user" value="Login">
        </form>
        <p>
            Non sei ancora registrato? <a href="/signup">Crea account</a>
        </p>
    </div>
</div>

<?php get_footer(); ?>

</body>
</html>
