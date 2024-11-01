import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
document.addEventListener('DOMContentLoaded', function () {
    let collectionHolder = document.querySelector('#images_container');
    let addButton = document.querySelector('#add_image_button');

    // Récupérer le nombre actuel d'entrées dans la collection
    let index = collectionHolder.children.length;

    // Fonction pour ajouter un nouveau formulaire d'image
    function addImageForm() {
        // Récupérer le prototype de formulaire
        let prototype = collectionHolder.dataset.prototype;

        // Remplacer '__name__' dans le prototype par l'index actuel
        let newForm = prototype.replace(/__name__/g, index);

        // Incrémenter l'index pour le prochain élément
        index++;

        // Créer un élément div pour le nouveau formulaire
        let newFormElement = document.createElement('div');
        newFormElement.classList.add('image-entry');
        newFormElement.innerHTML = newForm;

        // Ajouter le nouveau formulaire au conteneur
        collectionHolder.appendChild(newFormElement);
    }

    // Ajouter un gestionnaire d'événements au bouton d'ajout
    addButton.addEventListener('click', function (e) {
        e.preventDefault();
        addImageForm();
    });
});