<?php 
if ( ! defined( 'WP_UNINSTALL_PLUGIN')) {
  wp_die( sprintf(
    __( '%s should only be called when unistalling the plugin.', 'torb'), __FILE__
    ));
    exit;
}
$role = get_role( 'administrator' );
if  ( ! empty( $role)) {
  $role->remove_cap( 'torb_manage');
}
?>