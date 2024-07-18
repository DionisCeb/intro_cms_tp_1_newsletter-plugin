window.addEventListener('DOMContentLoaded', function() {
    //infolettre titre
    const titleNewsletter = document.querySelector(".newsletter-title");
    //infolettre conteneur
    const newsletterForm = document.querySelector('[data-js-np-form]');
    //icone de fermeture
    const closeIcon = document.querySelector('.close-icon-btn');
    //les boutons
    const btnNext = document.querySelector('#btn-suivant');
    const btnSubmit = document.querySelector('#btn-submit');
    
    //les sections:
    const inputNextSection = document.querySelector(".input-next");
    const inputSubmitSection = document.querySelector(".input-submit");

    //les champs:
    const nameInput = document.querySelector(".name-input");
    const emailInput = document.querySelector(".email-input");
    //default les champs:
    nameInput.required = true;
    emailInput.required = true;

    //message final
    const successMessageDiv = document.querySelector(".success-message");

    //les valeurs saisies par l'utilisateur:
    const nameValueSpan = document.querySelector(".name-value");
    const emailValueSpan = document.querySelector(".email-value");



    setTimeout(function() {
        newsletterForm.classList.replace('np-form--closed', 'np-form--opened');
    }, 10);

    //fermer le infolettre
    closeIcon.addEventListener("click", closeNewsletter);

    function closeNewsletter() {
        newsletterForm.classList.remove("np-form--opened");
        newsletterForm.classList.add("np-form--closed");
    }

    //fermer-afficher les sections
    btnNext.addEventListener("click", displayNextSection);

    function displayNextSection() {
        //cacher section actuelle
        inputNextSection.classList.remove("visible");
        inputNextSection.classList.add("invisible");

        //afficher la prochaine section 
        inputSubmitSection.classList.remove("invisible");
        inputSubmitSection.classList.add("visible");
    }

    //Bloquer l'avancement vers une autre section, si le champ est vide
    function disableBtn() {
        if(nameInput.value === "") {
            btnNext.disabled = true;
        } else {
            btnNext.disabled = false;
        }
    }

    //Activer/désactiver le bouton Suivant
    nameInput.addEventListener("input", disableBtn);

    // Soumettre le formulaire
    btnSubmit.addEventListener("click", function() {
        if (emailInput.value.trim() === "") {
            return;
        }
        displayData();
    });


    function displayData() {
        //Cacher le titre
        titleNewsletter.classList.add("invisible");
        //Cacher la section précédente
        inputSubmitSection.classList.add("invisible");
        //Afficher le message
        successMessageDiv.classList.remove("invisible");
        //Les valeurs choisies
        nameValueSpan.innerText = nameInput.value;
        emailValueSpan.innerText = emailInput.value;
    }

    disableBtn();
});
