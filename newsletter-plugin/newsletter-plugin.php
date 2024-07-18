<?php
/**
 * Plugin Name: Newsletter Plugin
 * Description: A plugin for managing newsletter subscriptions.
 * Version: 1.05
 * Author: Dionis
 */

// Sortie si l'accès direct
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
 
 
// Les constantes pour les tables personnalisées
function np_definir_const() {
    if ( !defined( 'NP_PARAMETRES')) {
        global $wpdb;
        define('NP_PARAMETRES', $wpdb->prefix. 'np_parametres');
    }

    if ( !defined( 'NP_INSCRIPTIONS')) {
        global $wpdb;
        define('NP_INSCRIPTIONS', $wpdb->prefix. 'np_inscriptions');
    }
}
add_action('plugins_loaded', 'np_definir_const', 0);

require_once(plugin_dir_path(__FILE__) . '/includes/np-activation.php');
register_activation_hook( __FILE__, 'np_activation' );
 
/**
 * Description: Suprimer la table apres la desactivation du plugin
 */

function np_deactivation() {
    global $wpdb;
    $table_parametres = $wpdb->prefix . 'np_parametres';
    $wpdb->query( "DROP TABLE IF EXISTS $table_parametres" );

    $table_inscriptions = $wpdb->prefix . 'np_inscriptions';
    $wpdb->query( "DROP TABLE IF EXISTS $table_inscriptions" );
}
register_deactivation_hook( __FILE__, 'np_deactivation' );

/*
*Charge les comportements du panneau admin
*/
require_once(plugin_dir_path(__FILE__) . '/includes/np-pannel-admin.php');

/*
*Charge les comportements côté client
*/
require_once(plugin_dir_path(__FILE__) . '/includes/np-newsletter-client.php');
 

    // Enregistrement des styles et scripts
    function np_ajouter_styles_et_scripts() {
        wp_register_style( 'np-style', plugins_url( 'assets/styles/styles.css', __FILE__ ) );
        wp_enqueue_style( 'np-style' );
        wp_register_script( 'np-script', plugins_url( 'assets/scripts/main.js', __FILE__ ) );
        wp_enqueue_script( 'np-script' );
        }
        add_action( 'wp_enqueue_scripts', 'np_ajouter_styles_et_scripts' );
     
?>