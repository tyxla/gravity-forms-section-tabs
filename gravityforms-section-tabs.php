<?php
/**
 * Plugin Name: Gravity Forms: Section Tabs
 * Description: Allows the Gravity Forms sections to work as tabs.
 * Version: 1.0
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.1
 */

// main plugin constants
define('GFST_PLUGIN_NAME', 'Gravity Forms: Section Tabs');
define('GFST_PLUGIN_VERSION', '1.0');
define('GFST_PLUGIN_DIRNAME', basename(dirname(__FILE__)));
define('GFST_PLUGIN_URL', WP_PLUGIN_URL . '/' . GFST_PLUGIN_DIRNAME);
define('GFST_PLUGIN_DIR', WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . GFST_PLUGIN_DIRNAME);
define('GFST_PLUGIN_INCLUDES_DIR', GFST_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR);

// main plugin class
include_once(GFST_PLUGIN_INCLUDES_DIR . 'class.Gravity-Forms-Section-Tabs.php');

// initializing the plugin
$gfst = Gravity_Forms_Section_Tabs::instance();

?>