<?php

function admin_notice_activation_hook(): void
{
    set_transient('admin-notice', true, 5);
}

/* Add admin notice */
add_action('admin_notices', 'admin_text_notice');

function admin_text_notice(): void
{
    if (get_transient('admin-notice')) {
        ?>
        <div class="updated notice is-dismissible">
            <p>Grazie per aver scelto questo plugin!
                <br>
                Per un corretto funzionamento sono state installate le sguenti pagine:
            </p>
            <ol>
                <li><strong>Prenotazione</strong></li>
                <li><strong>Login</strong></li>
                <li><strong>Signup</strong></li>
                <li><strong>Scegli posto</strong></li>
                <li><strong>Prenotazione confermata</strong></li>
            </ol>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient('admin-notice');
    }
}

