<?php

/**
 * Récupération de la couleur de fond depuis la base de données
 */
function np_get_bg_color() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT couleur_bg FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération de la couleur des étiquettes depuis la base de données.
 */
function np_get_label_color() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT couleur_labels FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération de l’étiquette d’entrée du nom de la base de données.
 */
function np_get_name_input_label() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT name_input_label FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération de l’étiquette d’entrée de courrier électronique de la base de données.
 */
function np_get_email_input_label() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT email_input_label FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération du titre de la newsletter de la base de données.
 */
function np_get_newsletter_title() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT newsletter_title FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération du texte du bouton "Suivant" de la base de données.
 */
function np_get_btn_next() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT btn_next FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

/**
 * Récupération du texte du bouton "Soummettre" de la base de données.
 */
function np_get_btn_submit() {
    global $wpdb;
    $resultat = $wpdb->get_var( "SELECT btn_submit FROM " . $wpdb->prefix . "np_parametres WHERE id = 1" );
    return $resultat;
}

?>
