<?php
#this is the main file of the plugin
#this file is required by WordPress to install the plugin

/**
 * Plugin Name
 * 
 * 
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 * 
 * @package           PluginPackage
 * @author            Jalal Haidar
 * @copyright         2024 Techchaps
 * @license           GPL-2.0-or-later
 * 
 * 
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        https://techchaps.com/plugin-name
 * Description:       This is a plugin that does something
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jalal Haidar
 * Author URI:        https://techchaps.com
 * Text Domain:       plugin-name
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://techchaps.com/plugin-name
 * Required Plugins:  none
 */

#region 1. Define Constants
#activate the plugin function
function twip_activate(){
    #logic to execute when the plugin is activated

    #create a custom database table
    global $wpdb;
    $table_name = $wpdb->prefix . 'twip';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    #add option to the database
    add_option('twip_option', 'This is my option value.');
    #add option to the database
    add_option('twip_option2', 'This is my option value 2.');
    #add option to the database
    add_option('twip_option3', 'This is my option value 3.');
}

 #activate the plugin by registering the activation hook
    register_activation_hook(
        __FILE__,
	'twip_activate'
    );


#deactivate the plugin function
function twip_deactivate(){
    #logic to execute when the plugin is deactivated

    #remove the custom database table
    global $wpdb;
    $table_name = $wpdb->prefix . 'twip';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);

    #remove option from the database
    delete_option('twip_option');
    #remove option from the database
    delete_option('twip_option2');
    #remove option from the database
    delete_option('twip_option3');
}
#deactivate the plugin by registering the deactivation hook
register_deactivation_hook(
	__FILE__,
	'twip_deactivate'
);

#uninstall the plugin function
function twip_uninstall(){
    #logic to execute when the plugin is uninstalled

    #remove the custom database table
    global $wpdb;
    $table_name = $wpdb->prefix . 'twip';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);

    #remove option from the database
    delete_option('twip_option');
    #remove option from the database
    delete_option('twip_option2');
    #remove option from the database
    delete_option('twip_option3');
    
}
#uninstall the plugin by registering the uninstall hook
register_uninstall_hook(
    __FILE__,
    'twip_uninstall'
);


#Avoid Direct File Access
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}



#if direct access to this file is called, then abort execution
if ( ! defined( 'WPINC' ) ) {
    die;
}


 

#if the user is an admin, then load the admin file
if ( is_admin() ) {
    // we are in admin mode
    require_once __DIR__ . '/admin/wp-plugin-admin.php';
}




 ?>