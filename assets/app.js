import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

document.addEventListener('DOMContentLoaded', function () {
    console.log('Hello Webpack Encore! Edit me in assets/app.js, test webpack');
    let collectionHolder = document.querySelector('#images_container');
    let addButton = document.querySelector('#add_image_button');

    let index = collectionHolder.children.length;

    function addImageForm() {

        let prototype = collectionHolder.dataset.prototype;
        let newForm = prototype.replace(/__name__/g, index);
        index++;
        let newFormElement = document.createElement('div');
        newFormElement.classList.add('image-entry');
        newFormElement.innerHTML = newForm;
        collectionHolder.appendChild(newFormElement);

    }
    addButton.addEventListener('click', function (e) {

        e.preventDefault();
        addImageForm();

    });

    // gère la suppression des images dans le formulaire d'édition des pages en fonction des champs flexibles sélectionnés
    const typeField = document.querySelector('[name$="[type]"]');
    const contentFields = document.querySelectorAll('.block-content');
    console.log(contentFields);

    function toggleContentFields() {
        const selectedType = typeField.value;
        contentFields.forEach(field => {
            if (field.classList.contains(`block-content-${selectedType}`)) {
                field.style.display = '';
            } else {
                field.style.display = 'none';
            }
        });
    }

    typeField.addEventListener('change', toggleContentFields);
    toggleContentFields(); // Initial call to set the correct fields on page load
});
