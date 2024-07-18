<?php
//Menu pour le plugin Newsletter
function np_add_menu() {
    add_menu_page(
        //Titre de la page
        'Newsletter Plugin',
        //Titre du menu 
        'Newsletter Plugin', 
        //Capacité pour le menu
        'manage_options', 

        'np-menu-page', 
        //Fonction pour afficher la page du formulaire
        'np_add_form'  
    );
}
add_action( 'admin_menu', 'np_add_menu' );
   
function np_add_form() {
    global $wpdb;

    // Gestion de la couleur de fond
    if ( isset( $_POST['enregistrer'] ) ) {
        //mettre à jour la couleur de fond dans la base de données
        np_update_data();
    }

    // Récupérer les valeurs choisies par l'administrateur, comme couleur, texte de la base de données
    require_once( 'np-get-values.php' );
    //récupération de la couleur d'arrière-plan
    $np_color_bg = np_get_bg_color();
    //récupération de la couleur du texte (titres)
    $np_couleur_labels = np_get_label_color();
    //récupération de texte:
    //nom
    $name_input_label = np_get_name_input_label();
    //courriel
    $email_input_label = np_get_email_input_label();
    //titre de la infolettre
    $newsletter_title = np_get_newsletter_title();
    //bouton 'suivant'
    $btn_next = np_get_btn_next();
    //bouton 'soumettre'
    $btn_submit = np_get_btn_submit();

    /**
     * Le formulaire côté admin
     * qui offre la possibilité de changer:
     * la couleur du fond, la couleur du texte, le texte des champs et boutons
     */
    echo '
    <div style="padding:5vw;">
        <h1>' . get_admin_page_title() . '</h1>
        <form method="post" style="margin-top:25px;">
            <div>
                <label for="np-couleur-bg">Couleur de fond:</label>
                <input type="color" id="np-couleur-bg" name="np-couleur-bg" value="' . esc_attr( $np_color_bg ) . '">
            </div>
            
            <br>
            <div>
                <label for="np-couleur-labels">Couleur du texte:</label>
                <input type="color" id="np-couleur-labels" name="np-couleur-labels" value="' . esc_attr( $np_couleur_labels ) . '">
            </div>
            <br>
            <div>
                <label for="name-input-label">Titre du champ \'Nom\':</label>
                <input type="text" id="name-input-label" name="name-input-label" value="' . esc_attr( $name_input_label ) . '">
            <div>

            <br>
            <div>
                <label for="email-input-label">Titre du champ \'Email\':</label>
                <input type="text" id="email-input-label" name="email-input-label" value="' . esc_attr( $email_input_label ) . '">
            </div>
            <br>
            <div>
                <label for="newsletter-title">Titre de l\'infolettre:</label>
                <input type="text" id="newsletter-title" name="newsletter-title" value="' . esc_attr( $newsletter_title ) . '">
            </div>
            <br>
            <div>
                <label for="btn-next">Le bouton \'Suivant\':</label>
                <input type="text" id="btn-next" name="btn-next" value="' . esc_attr( $btn_next ) . '">
            </div>
            <br>
            <div>
                <label for="btn-submit">Le bouton \'Soumettre\':</label>
                <input type="text" id="btn-submit" name="btn-submit" value="' . esc_attr( $btn_submit ) . '">
            </div>

            <br>
            <button type="submit" name="enregistrer" style="padding:15px; cursor:pointer; border-radius:5px; border:none; background: orange; color:white; font-weight:bold;">Enregistrer</button>
        </form>
    </div>';

    // Récupèrer les données client de la table np_inscriptions
    $clients = $wpdb->get_results( "SELECT nom, courriel FROM {$wpdb->prefix}np_inscriptions" );

    //S'il y a des clients inscrits à la infolettre
    if ( $clients ) {
        // Afficher les données des clients
        echo '
        <div class="data-clients-div">
            <h1>Données des clients:</h1>
            <table style="border:2px solid black;">
                <tr style="border:1px solid black; padding: 10px; background: gray; color: white;">
                    <th style="border:1px solid black; padding: 8px;">Nom:</th>
                    <th style="border:1px solid black; padding: 8px;">Courriel:</th>
                </tr>';
    
        // Boucle à travers chaque client
        // Pour afficher les données de chaque client
        foreach ( $clients as $client ) {
            echo '
                <tr style="border:1px solid black; padding: 10px;">
                    <td style="border:1px solid black; padding: 8px;">' . esc_html( $client->nom ) . '</td>
                    <td style="border:1px solid black; padding: 8px;">' . esc_html( $client->courriel ) . '</td>
                </tr>';
        }
    
        echo '
            </table>
        </div>';
    } else {
        // Display nothing if there are no clients
        echo '';
    }

}

function np_update_data() {
    global $wpdb;

    //// Nettoie la couleur de fond en format hexadécimal
    $np_color_bg = sanitize_hex_color( $_POST['np-couleur-bg'] );
    // Nettoie la couleur du texte en format hexadécimal
    $np_couleur_labels = sanitize_hex_color( $_POST['np-couleur-labels'] );
    // Nettoie le <label> du champ 'Nom'
    $name_input_label = sanitize_text_field( $_POST['name-input-label'] );
    // Nettoie le <label> du champ 'Email'
    $email_input_label = sanitize_text_field( $_POST['email-input-label'] );
    // Nettoie le titre de l'infolettre
    $newsletter_title = sanitize_text_field( $_POST['newsletter-title'] );
    // Nettoie le libellé du bouton 'Suivant'
    $btn_next = sanitize_text_field( $_POST['btn-next'] );
    // Nettoie le libellé du bouton 'Soumettre'
    $btn_submit = sanitize_text_field( $_POST['btn-submit'] );

     // Préparer les données pour les mettre à jour dans la base de données
    $data = array( 
        'couleur_bg' => $np_color_bg,
        'couleur_labels' => $np_couleur_labels,
        'name_input_label' => $name_input_label,
        'email_input_label' => $email_input_label,
        'newsletter_title' => $newsletter_title,
        'btn_next' => $btn_next,
        'btn_submit' => $btn_submit,
    );
    // Condition pour la mise à jour
    $where = [ 'id' => 1 ];
    //La mise à jour dans la table NP_PARAMETRES
    $wpdb->update( NP_PARAMETRES, $data, $where );
}
?>
