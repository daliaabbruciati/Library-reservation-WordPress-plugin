<?php
/**
 * Plugin Name: Library plugin prova
 * Description: A plugin to do reservation in a library
 * Version: 1.0.0
 * Author: Dalia Abbruciati
 * Author: URI: https://www.linkedin.com/in/dalia-abbruciati-137655228/
 * License: GPLv2 or later
 * Text Domain: library-plugin-prova
 */

/* Define the ABSPATH */
defined('ABSPATH') or die('Hey you can\t access this file');
require_once(ABSPATH . 'wp-admin/includes/plugin.php');


/* Register ACTIVATION hook. */
include_once __DIR__ . '/includes/base/Activate.php';
register_activation_hook( __FILE__, 'admin_notice_activation_hook');

/* Register DEACTIVATION hook */
include_once __DIR__ . '/includes/base/Deactivate.php';
register_deactivation_hook(__FILE__, 'deactivate');

/* File per i template */
include_once __DIR__ . '/includes/functions/create-template.php';

/* File per creare le pagine all'attivazione del plugin */
include_once __DIR__ . '/includes/functions/create-pages.php';
register_activation_hook(__FILE__, 'page_creator');

/* File dell' admin menu */
require_once __DIR__ . '/admin/admin-menu.php';

/* File per includere lo style e gli scripts*/
require_once __DIR__ . '/includes/base/Enqueue.php';

/* Include database file */
require_once __DIR__ . '/DB/create-table.php';
register_activation_hook(__FILE__, "DB_table");

/* Includo la connession al db*/
include __DIR__ . '/DB/start-connection.php';

