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
defined( 'ABSPATH' ) or die( 'Hey you can\t access this file' );

/* Activation and deactivation plugin hooks */
register_activation_hook( __DIR__ . '/includes/Base/Activate.php', 'activate' );
register_deactivation_hook( __DIR__ . '/includes/Base/Deactivate.php', 'deactivate' );


/* File dell' admin menu */
include __DIR__ . '/admin/admin-menu.php';
/* File per includere lo style e gli scripts*/
include __DIR__ . '/includes/Base/Enqueue.php';

/* Include database file */
register_activation_hook(__DIR__ . '/DB/create-table.php',"DB_table");

/* Includo la connession al db*/
//include __DIR__ . '/DB/start-connection.php';


