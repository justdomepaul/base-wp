<?php
/**
 * @package Delivery
 */
/*
Plugin Name: Delivery Function
Description: Base delivery source info control.
Version: 0.0.1
Author: Maxfocker
License: GPLv2 or later
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_delivery() {
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_delivery' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_delivery() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_delivery' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}