<?php

/* Template che vogliamo includere nel dropdown per la scelta dei template */
function my_template_array(): array
{
    $temps = [];
    $temps['login.php'] = 'Login';
    $temps['signup.php'] = 'Signup';
    $temps['book-seat.php'] = 'Scegli posto';
    $temps['booking-successful.php'] = 'Prenotazione confermata';

    return $temps;
}

function my_template_register($page_templates)
{
    $templates = my_template_array();
    foreach ($templates as $tk => $tv) {
        $page_templates[$tk] = $tv;
    }
    return $page_templates;
}

add_filter('theme_page_templates', 'my_template_register', 10, 3);

function my_template_select($template)
{
    global $post;

    $page_temp_slug = get_page_template_slug($post->ID);

    $templates = my_template_array();

    if (isset($templates[$page_temp_slug])) {
        $template = plugin_dir_path(__FILE__) . '../../templates/' . $page_temp_slug;
    }

    return $template;
}

add_filter('template_include', 'my_template_select', 99);

//add_action('after_setup_theme', 'register_primary_menu');
