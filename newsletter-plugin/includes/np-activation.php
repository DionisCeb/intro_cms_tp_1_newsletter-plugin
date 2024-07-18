<?php

    /**
     * Fonction d'activation du plugin.
     * Est exécutée lors de l'activation du plugin.
     * Créer les tables nécessaires dans la base de données
     */
    function np_activation() {
        global $wpdb;  
        $charset_collate = $wpdb->get_charset_collate();


        $table_parametres = $wpdb->prefix . 'np_parametres';
        
       // Vérifie si la table des paramètres existe déjà dans la base de données
        if  ( $wpdb->get_var( "SHOW TABLES LIKE '$table_parametres'" ) != $table_parametres ) {
            // Requête SQL pour créer la table des paramètres
            $sql = "CREATE TABLE $table_parametres (
                id int NOT NULL AUTO_INCREMENT,
                couleur_bg varchar (10) NOT NULL,
                couleur_labels varchar(10) NOT NULL,
                name_input_label varchar(100) NOT NULL,
                email_input_label varchar(100) NOT NULL,
                newsletter_title varchar(200) NOT NULL,
                btn_next varchar(50) NOT NULL,
                btn_submit varchar(50) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate";
            // --> script d'upgrade de WordPress pour exécuter la requête SQL
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            //SQL pour créer la table avec la fonction dbDelta()
            dbDelta( $sql );
            
            // Insertion des données par défaut
            $wpdb->insert( $table_parametres, array(
                'couleur_bg' => '#ffffff',
                'couleur_labels' => '#000000',
                'name_input_label' => 'Nom:',
                'email_input_label' => 'Email:',
                'newsletter_title' => 'Inscrivez-vous à notre infolettre!',
                'btn_next' => 'Suivant',
                'btn_submit' => 'Soumettre',
            ));
            
        }


        $table_inscriptions = $wpdb->prefix . 'np_inscriptions';
        
       // Vérifie si la table des inscriptions existe déjà
        if  ( $wpdb->get_var( "SHOW TABLES LIKE '$table_inscriptions'" ) != $table_inscriptions ) {
            // Requête SQL pour créer la table des inscriptions
            $sql = "CREATE TABLE $table_inscriptions (
                id int NOT NULL AUTO_INCREMENT,
                nom varchar(100) NOT NULL,
                courriel varchar(100) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate";
            // Le script d'WordPress pour exécuter la requête SQL
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }
?>