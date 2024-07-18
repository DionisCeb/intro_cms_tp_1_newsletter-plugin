<?php
 
// Si uninstall.php n'est pas appelé par WordPress, die
if  ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}
global $wpdb;
$table_parametres = $wpdb->prefix . 'np_parametres';
$wpdb->query( "DROP TABLE IF EXISTS $table_parametres" );

$table_inscriptions = $wpdb->prefix . 'np_inscriptions';
$wpdb->query( "DROP TABLE IF EXISTS $table_inscriptions" );