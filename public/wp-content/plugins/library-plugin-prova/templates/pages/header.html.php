<?php
session_start();
wp_head();
get_header();
//wp_nav_menu([
//    'theme_location' => 'library-primary-menu'
//]);
?>

<head>
    <title>Biblioteca</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__) . '/../css/logout.css'; ?>">
</head>
<body>
<div class="container-logout">
    <a class="container-logout__link" href="/logout">LOGOUT</a>
</div>
</body>
