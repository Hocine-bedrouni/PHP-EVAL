<?php

include "validForm.php";

// défintion regex
$regex = [
    'Titre' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Annee' => '#[0-9]{4}#x',
    'Genre' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Label' => '/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/',
    'Prix' => '/^[0-9]*\.?[0-9]{2}+$/'
];

// Initialisation d'un tableau d'erreur
$err_tab = [];
// si le formulaire est envoyé
if (isset($_POST['envoie'])) {
    $tablo = [
        'Titre' => $_POST['Titre'],
        'Annee' => $_POST['Annee'],
        'Genre' => $_POST['Genre'],
        'Label' => $_POST['Label'],
        'Prix' => $_POST['Prix'],
    ];
    var_dump($tablo);
    // appel de la fonction de validation de formulaire
    $err_tab = validForm($regex, $tablo);
    var_dump($err_tab);
    if ($_POST['Artist'] === '') {
        $err_tab['Artist'] = 'Selectionner un artiste';
    }
    // s'il n'y a pas d'erreur
    if(count($err_tab)!=0){
        var_dump($err_tab);
//        die;
        $sUrl = implode("&", $err_tab); // Alors on regroupe toutes les erreurs

//        die;
        header("Location: ../Views/formulaire_ajout.php?" . $sUrl); // On affiche les erreurs dans le formulaire.php
    }
    if (count($err_tab) === 0) {
        // stockage de données saisies dans des variable avant utilisation
        $titre = htmlspecialchars($_POST['Titre']);
        $annee = htmlspecialchars($_POST['Annee']);
        $genre = htmlspecialchars($_POST['Genre']);
        $label = htmlspecialchars($_POST['Label']);
        $prix = htmlspecialchars($_POST['Prix']);


// CONNEXION A LA BDD ET RECUPERATION DES INFORMATIONS AVEC DES REQUETES SQL

        require "../models/connexion_Bdd.php";
// Requête SQL pour insérer les valeurs ajoutées dans le formulaire d'ajout
        try {
            $db_ajout = $db->prepare("INSERT INTO record.disc(disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id)VALUES(:disc_title, :disc_year, :disc_label, :disc_genre, :disc_price, :artist_id)");

// bindValue : Associe une valeur à un paramètre
            $db_ajout->bindParam(':disc_title', $_POST['Titre'], PDO::PARAM_STR);
            $db_ajout->bindParam(':disc_year', $_POST['Annee'], PDO::PARAM_INT);
            $db_ajout->bindParam(':disc_label', $_POST['Label'], PDO::PARAM_STR);
            $db_ajout->bindParam(':disc_genre', $_POST['Genre'], PDO::PARAM_STR);
            $db_ajout->bindParam(':disc_price', $_POST['Prix'], PDO::PARAM_INT);
            $db_ajout->bindParam(':artist_id', $_POST['Artist'], PDO::PARAM_INT);


            if ($db_ajout->execute()) {
                //$message = "Le produit a été rajouté dans la base de données";
                $new_id = (int)($db->lastInsertId()); // En lien avec l'insertion d'image et le renommage du fichier qui sera l'ID
                $message = "Insertion réussie";
            } else {
                $message = "Echec de l'insertion";
            }

// Récupération de l'extension du fichier
//$extension = substr (strrchr ($_FILES['fichier']['name'], "."), 1);
            $nouveauNom = $new_id . '.jpeg';

// Requête SQL pour récupérer le nouveau nom qui est l'ID
            $requete2 = $db->prepare("UPDATE record.disc SET disc_picture=:nouveauNom WHERE disc_id=:disc_id");
            $requete2->bindValue(':nouveauNom', $nouveauNom, PDO::PARAM_STR);
            $requete2->bindValue(':disc_id', $new_id, PDO::PARAM_INT);

// INSERTION IMAGE

// ----------------------------- SECURITE - VERIFICATION DU TYPE DE FICHIER AUTORISE -----------------------------

// On met les types autorisés dans un tableau (ici pour une image)
// Liste des types autorisés : https://developer.mozilla.org/fr/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
            $type_ok = array("image/gif", "image/jpeg", "image/jpg", "image/jpeg", "image/png", "image/x-png", "image/tiff");

            if ($_FILES["fichier"]["tmp_name"] != Null) {
                // On ouvre l'extension FILE_INFO
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                // On extrait le type MIME du fichier via l'extension FILE_INFO
                $type_file = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
                // On ferme l'utilisation de FILE_INFO
                finfo_close($finfo);
                if (in_array($type_file, $type_ok)) {
                    /* Le type est parmi ceux autorisés, donc OK, on va pouvoir déplacer et renommer le fichier */
                } else {
                    // Le type n'est pas autorisé, donc ERREUR

                    echo "Type de fichier non autorisé";
                    exit;
                }
            }

// ----------------------------- LIMITATION TAILLE FICHIER -----------------------------

            $taille_max = 1024000; // Convertir Ko en Mo : 1000 Ko est égal à 1 Mo
            $taille_fichier = filesize($_FILES['fichier']['tmp_name']);

// var_dump($taille_fichier); // Pour connaitre la taille du fichier

            if ($taille_fichier > $taille_max) {

                echo "Vous avez dépassé la taille de fichier autorisée";
                exit;
            }

// ----------------------------- UPLOAD ET RENOMMAGE DE FICHIER -----------------------------

            $cheminEtNomTemporaire = $_FILES['fichier']['tmp_name']; // ['fichier'] récupère le nom du fichier qui est un nom temporaire

            $cheminEtNomDefinitif = '../assets/img/' . $nouveauNom;

            $moveIsOk = move_uploaded_file($cheminEtNomTemporaire, $cheminEtNomDefinitif); // Fonction qui permet de renommer et déplacer le fichier dans le dossier souhaité


            if ($moveIsOk) {

                $message = "Le fichier a été uploadé dans " . $cheminEtNomDefinitif;

            } else {

                $message = "Suite à une erreur, le fichier n'a pas été uploadé";

            }

//$Insertion = $requete2 ->execute();


            if ($requete2->execute()) {
                //$message = "Le produit a été rajouté dans la base de données";
                header("Location: ./Views/liste.php"); // Si le produit a bien été ajouté, il y a une redirection ver la liste
            } else {
                $message = "Echec de la modification";
            }


// Libération de la connexion au serveur de BDD
//$db_ajout->closeCursor();
        } // Gestion des erreurs
        catch (Exception $e) {

            echo "La connexion à la base de données a échoué ! <br>";
            echo "Merci de bien vérifier vos paramètres de connexion ...<br>";
            echo "Erreur : " . $e->getMessage() . "<br>";
            echo "N° : " . $e->getCode();
            die("Fin du script");

        }
    }    }
