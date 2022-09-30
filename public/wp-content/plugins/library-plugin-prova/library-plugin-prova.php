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

/* Include classes */

use Plugin\Admin\AdminMenu;
use Plugin\Base\Activate;
use Plugin\Base\Deactivate;
use Plugin\DB\Database;
use Plugin\Enqueue\Enqueue;
use Plugin\Functions\Pages;

/* Define the ABSPATH */
defined('ABSPATH') or die('Hey you can\t access this file');
require_once(ABSPATH . 'wp-admin/includes/plugin.php');

/* Register ACTIVATION hook. */
include_once __DIR__ . '/includes/base/Activate.php';
$activate = new Activate(__FILE__);

/* Register DEACTIVATION hook */
include_once __DIR__ . '/includes/base/Deactivate.php';
$deactivate = new Deactivate(__FILE__);

/* File per i template */
include_once __DIR__ . '/includes/functions/Template.php';

/* File per creare le pagine all'attivazione del plugin */
include_once __DIR__ . '/includes/functions/Pages.php';
$pages = new Pages(__FILE__);

/* File dell' admin menu */
require_once __DIR__ . '/admin/AdminMenu.php';
$admin = new AdminMenu();

/* File per includere lo style e gli scripts*/
include __DIR__ . '/includes/base/Enqueue.php';
$enqueue = new Enqueue();

/* Include database file */
require_once __DIR__ . '/DB/Database.php';
$database = new Database(__FILE__);
$database->create_table();

/* Includo la connession al db*/
//require_once __DIR__ . '/DB/start-connection.php';

