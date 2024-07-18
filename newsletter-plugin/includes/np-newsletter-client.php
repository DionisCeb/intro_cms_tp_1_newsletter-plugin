<?php

/**
 * Gestion du popup avec les données de couleur récupérées depuis la base de données.
 */
function charge_popup() {
    //le fichier pour récupérer les couleurs
    require_once( 'np-get-values.php' );
    // Récupèrer la couleur de fond depuis la base de données
    $np_color_bg = np_get_bg_color();

    ob_start();
    include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/np-form.php' );
    $template = ob_get_clean();
    // Afficher le template du popup
    echo $template;
}

//charger le popup
add_action('wp_body_open', 'charge_popup');

/**
 * Gestion de la soumission du formulaire côté client
 */
function np_nouvelle_inscription() {
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        //Vérifier si le nom et la valeur e-mail ont été envoyés
        if ( !empty( $_POST['np-courriel'] ) && !empty( $_POST['np-nom'] ) ) {

            global $wpdb;
            // Valider les valeurs du formulaire
            $np_courriel = sanitize_email( $_POST['np-courriel'] );
            $np_nom = sanitize_text_field( $_POST['np-nom'] );

            // Insertion de données dans la table des inscriptions
            $wpdb->insert( NP_INSCRIPTIONS,
                array(
                    'nom' => $np_nom,
                    'courriel' => $np_courriel
                ),
                array(
                    '%s', // Format pour 'nom'
                    '%s'  // Format pour 'courriel'
                )
            );

        }
    }
}
//gérer la soumission des nouvelles inscriptions
add_action( 'init', 'np_nouvelle_inscription' );

?>
