<?php

/* Template che vogliamo includere nel dropdown per la scelta dei template */
function my_template_array(): array
{
    $temps = [];
    $temps['login.php'] = 'Login';
    $temps['signup.php'] = 'Signup';

    return $temps;
}


function my_template_register($page_templates, $theme, $post)
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
    global $post, $wp_query, $wpdb;

    $page_temp_slug = get_page_template_slug($post->ID);

    $templates = my_template_array();

    if(isset($templates[$page_temp_slug]))
    {
        $template = plugin_dir_path(__FILE__) . '../../templates/' . $page_temp_slug;
    }

    return $template;
}
add_filter('template_include','my_template_select', 99);