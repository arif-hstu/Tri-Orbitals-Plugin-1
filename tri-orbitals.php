<?php
/**
* Plugin Name: my orbitals
* Plugin URI: https://wordpress.com/plugins/triorbitals
* Description: This is A Trial Plugin
* Version: 1.0.0
* Requires at least: 5.3
* Requires PHP: 5.6
* Author: Md Arifur Rahman 
* Author URI: https://triorbitals.com
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: triorbitals
* Domain Path: /public/lang
*/

/*
Copyright (C) <year> <name of author>
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
add_action( 'admin_menu', 'torb_create_menu' );

function torb_create_menu() {
  
  //create custom top-level menu
  add_menu_page( 'Tri Orbitals Page', 'Tri Orbitals', 'manage_options', 'torb-options', 'torb_settings_page', 'dashicons-smiley', 99 );

  //create custom sub-menus
  add_submenu_page( 'torb-options', 'About The Tri Orbitals Plugin', 'About', 'manage_options', 'torb-about', 'torb_about_page' );
  add_submenu_page( 'torb-options', 'Help with the Tri Orbitals', 'Help', 'manage_options', 'torb-help', 'torb_help_page' );
  add_submenu_page( 'torb-options', 'Settings of Tri Orbitals', 'Setting', 'manage_options', 'torb-setting', 'torb_setting_page' );
  add_submenu_page( 'torb-options', 'Unstalling the Plugin', 'Uninstall', 'manage_options', 'torb-uninstall', 'torb_uninstall_page' );
}

//Creating Details of the menus
function torb_settings_page(){

}

function torb_about_page() {

}

function torb_help_page() {

}

function torb_uninstall_page() {

}


/*****
* Setting API example 
*
* Complete Practical example is below
*
* */


/*
Plugin Name: Settings API example
Plugin URI: https://example.com/
Description: A complete and practical example of the WordPress Settings API
Author: WROX
Author URI: http://wrox.com
*/

// Add a menu for our option page
add_action( 'admin_menu', 'torb_plugin_add_settings_menu' );

function torb_plugin_add_settings_menu() {

    add_options_page( 'TORB Plugin Settings', 'TORB Settings', 'manage_options',
        'torb_plugin', 'torb_plugin_option_page' );

}
        
// Create the option page
function torb_plugin_option_page() {
    ?>
    <div class="wrap">
        <h2>My plugin</h2>
        <form action="options.php" method="post">
            <?php 
            do_settings_sections( 'torb_plugin' );
            settings_fields( 'torb_plugin_options' );
            submit_button( 'Save Changes', 'primary' );  
            ?>
        </form>
    </div>
    <?php
}
        
// Register and define the settings
add_action('admin_init', 'torb_plugin_admin_init');

function torb_plugin_admin_init() {
    $args = array(
        'type'=> 'string', 
        'sanitize_callback' => 'torb_plugin_validate_options',
        'default' => NULL
    );

    //register our settings
    register_setting( 'torb_plugin_options', 'torb_plugin_options', $args );
    
    //add a settings section
    add_settings_section( 
        'torb_plugin_main', 
        'Tri Orbitals Settings',
        'torb_plugin_section_text', 
        'torb_plugin' 
    );
    
    //create our settings field for name
    add_settings_field( 
        'torb_plugin_name', 
        'Your Name',
        'torb_plugin_setting_name', 
        'torb_plugin', 
        'torb_plugin_main' 
    );

    //favorite color field
    add_settings_field( 
      'torb_plugin_color', 
      'Your Color', 
      'torb_plugin_favorite_color', 
      'torb_plugin', 
      'torb_plugin_main' 
    );



}

// Draw the section header
function torb_plugin_section_text() {

    echo '<p>Enter your settings here.</p>';

}
        
// Display and fill the Name form field
function torb_plugin_setting_name() {

    // get option 'text_string' value from the database
    $options = get_option( 'torb_plugin_options' );
    $name = $options['name'];

    // echo the field
    echo "<input id='name' name='torb_plugin_options[name]'
        type='text' value='" . esc_attr( $name ) . "' />";

}

//Display and fill the Name form field
function torb_plugin_favorite_color() {

  //get option 'text_string' value form database
  $options = get_option( 'torb_plugin_options' );
  $color = $options['color'];

  //echo the field
  echo "<input id='color' name='torb_plugin_options[color]' type='text' value='" . esc_attr( $color ) . "'/>";

}




// Validate user input for name input (we want text and spaces only)
function torb_plugin_validate_options( $input ) {

    $valid = array();
    $valid['name'] = preg_replace(
        '/[^a-zA-Z\s]/',
        '',
        $input['name'] );

    //validate user input for color input (we want text and space only)
    $valid['color'] = preg_replace(
      '/[^a-zA-Z\s]/',
      '',
      $input['color'] );
    
    return $valid;

}

