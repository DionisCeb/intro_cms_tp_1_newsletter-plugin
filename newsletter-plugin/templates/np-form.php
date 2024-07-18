<!-- Un modal qui contient le formulaire d'inscription à la newsletter
    Permet l'enregistrement des données client, du nom et de l'e-mail
    De plus, avec l'aide de esc_attr, l'administrateur peut gérer la couleur du fond, le texte et le contenu, le texte des champs, le titre général et les boutons.
-->
<div class="np-form np-form--closed" style="background-color: <?php echo esc_attr( $np_color_bg ); ?>" data-js-np-form>
    <span class="close-icon-btn">x</span>

    <form method="post">
        <label class="newsletter-title" for="np-titre" style="color: <?php echo esc_attr( np_get_label_color() ); ?>"><?php echo esc_html( np_get_newsletter_title()) ?></label>
        <div class="input-next visible">
            <label for="name-input" style="color: <?php echo esc_attr( np_get_label_color() ); ?>"><?php echo esc_html( np_get_name_input_label()) ?></label>
            <input type="text" class="name-input" name="np-nom" placeholder="Votre nom">
            <input type="button" value="<?php echo esc_attr( np_get_btn_next() ); ?>" name="btn_prochain" id="btn-suivant">
        </div>
        <div class="input-submit invisible">
            <label for="email-input" style="color: <?php echo esc_attr( np_get_label_color() ); ?>"><?php echo esc_html( np_get_email_input_label()) ?></label>
            <input type="email" class="email-input" name="np-courriel" placeholder="Votre email">
            <input type="submit" name="btn_soumission" value="<?php echo esc_attr( np_get_btn_submit() ); ?>" id="btn-submit">
        </div>
    </form>
    <div class="success-message invisible">
        <div class="inscription-message">Inscription réussie!</div>
        <div class="data-client">
            <label for="name-input" class="nom" style="color: <?php echo esc_attr( np_get_label_color() ); ?>">Votre Nom:<span class="name-value"></span></label>
            <label for="email-input" class="email" style="color: <?php echo esc_attr( np_get_label_color() ); ?>">Votre Email: <span class="email-value"></span></label>
        </div>
    </div>
</div>
