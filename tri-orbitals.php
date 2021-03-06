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
?>
    <div class="notice notice-error is-dismissible">
    <p>There has been an error.</p>
    </div>
    <div class="notice notice-warning is-dismissible">
    <p>This is a warning message.</p>
    </div>
    <div class="notice notice-success is-dismissible">
    <p>This is a success message.</p>
    </div>
    <div class="notice notice-info is-dismissible">
    <p>This is some information.</p>
    </div>

    <p>
    <input type="submit" name="Save" value="Save Options"/>
    <input type="submit" name="Save" value="Save Options"
    class="button-primary"/>
    </p><p>
    <input type="submit" name="Secondary" value="Secondary Button"/>
    <input type="submit" name="Secondary" value="Secondary Button"
    class="button-secondary"/>
    </p>

    <div class="tablenav">
    <div class="tablenav-pages">
    <span class="displaying-num">Displaying 1-20 of 69</span>
    <span class="page-numbers current">1</span>
    <a href="#" class="page-numbers">2</a>
    <a href="#" class="page-numbers">3</a>
    <a href="#" class="page-numbers">4</a>
    <a href="#" class="next page-numbers">&raquo;</a>
    </div>
    </div>
    <?php 

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

    // Adding a Section to an Existing Page
    register_setting( 'reading', 'torb_plugin_options', $args );


        
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

    //favorite holiday field
    add_settings_field( 
      'torb_plugin_holiday', 
      'Favorite Holiday', 
      'torb_plugin_setting_fav_holiday', 
      'torb_plugin', 
      'torb_plugin_main' 
    );

    //favorite country field
    add_settings_field( 
      'torb_plugin_fav_country', 
      'Your Favorite Country', 
      'torb_plugin_setting_fav_country', 
      'torb_plugin', 
      'torb_plugin_main' 
    );

    //add our field under reading page
    add_settings_field( 
      'torb_plugin_text_string', 
      'Your Name', 
      'torb_plugin_setting_name', 
      'reading', 
      'default'
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



// Display and fill the Favorite holiday field
function torb_plugin_setting_fav_holiday() {

  //get option "fav_holiday" value from database
  $option = get_option( 'torb_plugin_options', [ 'fav_holiday' => 'Eid Ul Adha' ] );
  $holiday = $option['fav_holiday'];

  //define the select option values for favorite holiday
  $items = array( 'Eid Ul Adha', 'Eid Ul Fitr', 'The Independence Day' );

  //echo the field
  echo "<select id='fav_holiday' name='torb_plugin_options[fav_holiday]'>";

  foreach( $items as $item ) {

    // loop through the option values
    //if saved option matches the option value, select it
    echo "<option value='" .esc_attr( $item ) . "'
          ".selected( $holiday, $item, false ) . ">". esc_html( $item ) . 
          "</option>";
  
        }

    echo "</select>";

}



// Display and select the favorite holiday field
function torb_plugin_setting_fav_country() {

  //get option from the field
  $option2 = get_option( 'torb_plugin_options', ['fav_country' => 'Bangladesh'] );
  $fav_country = $option2['fav_country'];

  //define the array of country 
  $country_items = ['USA', 'Bangladesh', 'Saudi Arabia', 'UK'];

  //echo the field
  echo "<select name='torb_plugin_options[fav_country]'  id='fav_country'>";

    foreach( $country_items as $country_item ) {

        //loop through the options
        //if saved value match the options value, select it 
        echo "<option value='" . esc_attr( $country_item ) . "'" . 
        selected( $fav_country, $country_item, false ) . ">" . 
        esc_html( $country_item ) . 
        "</option>";

    }

    echo "</select>";

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
      
      //adding error notice
      if( $valid['color'] !== $input['color'] || $valid['name'] !== $input['name']) {

        add_settings_error( 
          'torb_plugin_text_string', 
          'torb_plugin_texterror', 
          'Incorrect value entered!', 
          'error' );

      }

      //sanitizing the data we receive
      $valid['fav_holiday'] = sanitize_text_field( $input['fav_holiday'] );
      $valid['fav_country'] = sanitize_text_field( $input['fav_country'] );
      
    
    return $valid;

}




?>

