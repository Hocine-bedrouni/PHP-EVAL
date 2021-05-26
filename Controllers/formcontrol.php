<?php
// défintion regex
$regex = [
    'Titre' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Annee' => '#([^0-9] | ^[0-9]{1,3}$ | [0-9]{5,})#x',
    'Genre' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Label' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Prix ' => '/^[0-9]*\.?[0-9]{2}+$/'
];
// si le formulaire est envoyé
if (isset($_POST['validate'])) {
    // appel de la fonction de validation de formulaire
    $formError = validForm($regex, $_POST);
    // s'il n'y a pas d'erreur
    if(count($formError) === 0) {
        // stockage de données saisies dans des variable avant utilisation
        $titre = htmlspecialchars($_POST['Titre']);
        $artiste = htmlspecialchars($_POST['Artist']);
        $annee = htmlspecialchars($_POST['Annee']);
        $genre = htmlspecialchars($_POST['Genre']);
        $label = htmlspecialchars($_POST['Label']);
        $prix = htmlspecialchars($_POST['Prix']);}}
//
//        // requête vers bdd
//    }
//
//    if (!empty($_POST['firstname'])) {
//
//        if (preg_match($regexFirstname, $_POST['firstname'])) {
//            // stockage de la valeur saisie dans une variable
//            $firstname = htmlspecialchars($_POST['firstname']);
//        } else {
//
//            $formError['firstname'] = 'Caractère non valide';
//        }
//    } else {
//        $formError['firstname'] = 'Champ vide';
//    }
//
//    // si le champs lastname n'est pas vide
//    if (!empty($_POST['lastname'])) {
//        // si la valeur saisie passe la regex
//        if (preg_match($regexLastname, $_POST['lastname'])) {
//            // stockage de la valeur saisie dans une variable
//            $lastname = htmlspecialchars($_POST['lastname']);
//        } else {
//            //défintion d'un message d'erreur et stockage dans un tableau
//            $formError['lastname'] = 'Caractère non valide';
//        }
//    } else {
//        $formError['lastname'] = 'Champ vide';
//    }