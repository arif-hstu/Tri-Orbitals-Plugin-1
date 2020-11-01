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
  add_submenu_page( 'torb-options', 'Unstalling the Plugin', 'Uninstall', 'manage_options', 'torb-uninstall', 'torb_uninstall' );
}

add_action( 'admin_menu', 'torb_create_submenu' );

function torb_create_submenu() {

  //create a submenu under Settings
  add_options_page( 'Tri Orbitals Settings', 'Tri Orbital Settings', 'manage_options', 'torb_settings', 'torb_plugin_option_page');
}
?>