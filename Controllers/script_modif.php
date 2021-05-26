
<?php
require "../models/connexion_Bdd.php";

// var_dump($_FILES);

// Récupération de l'extension du fichier
//$extension = substr (strrchr ($_FILES['fichier']['name'], "."), 1);
$nouveauNom = $_POST['disc_id'].'.jpeg';

$requete = $db->prepare("UPDATE record.disc SET disc_title=:disc_title, disc_year=:disc_year, disc_genre=:disc_genre, disc_label=:disc_label, 
disc_price=:disc_price WHERE disc_id=:disc_id");

$requete->bindParam(':disc_title', $_POST['Titre'], PDO::PARAM_STR);
//$requete->bindParam(':artist_name', $_POST['artist_name'], PDO::PARAM_STR);
$requete->bindParam(':disc_year', $_POST['Annee'], PDO::PARAM_INT);
$requete->bindParam(':disc_genre', $_POST['Genre'], PDO::PARAM_STR);
$requete->bindParam(':disc_label', $_POST['Label'], PDO::PARAM_STR);
$requete->bindParam(':disc_price', $_POST['Prix'], PDO::PARAM_STR);
$requete->bindParam(':disc_id', $_POST['disc_id'], PDO::PARAM_INT);




// ----------------------------- SECURITE - VERIFICATION DU TYPE DE FICHIER AUTORISE -----------------------------

// On met les types autorisés dans un tableau (ici pour une image)
// Liste des types autorisés : https://developer.mozilla.org/fr/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
$type_ok = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");




if($_FILES["fichier"]["tmp_name"]!= Null){
    // On ouvre l'extension FILE_INFO
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // On extrait le type MIME du fichier via l'extension FILE_INFO
    $type_file = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
    // On ferme l'utilisation de FILE_INFO
    finfo_close($finfo);
    if (in_array($type_file, $type_ok))
    {
        /* Le type est parmi ceux autorisés, donc OK, on va pouvoir déplacer et renommer le fichier */
    }
    else
    {
        // Le type n'est pas autorisé, donc ERREUR

        echo "Type de fichier non autorisé";
        exit;
    }
}



//----------------------------- LIMITATION TAILLE FICHIER -----------------------------

$taille_max    = 1024000; // Convertir Ko en Mo : 1000 Ko est égal à 1 Mo
$taille_fichier = filesize($_FILES['fichier']['tmp_name']);

// var_dump($taille_fichier); // Pour connaitre la taille du fichier


if ($taille_fichier > $taille_max)
{

    echo "Vous avez dépassé la taille de fichier autorisée";
    exit;
}

// ----------------------------- UPLOAD ET RENOMMAGE DE FICHIER -----------------------------

$cheminEtNomTemporaire = $_FILES['fichier']['tmp_name']; // ['fichier'] récupère le name du fichier qui s'appelle fichier à la ligne 189 dans l'input de produits_ajout.php

$cheminEtNomDefinitif = '../assets/img/'.$nouveauNom;

$moveIsOk = move_uploaded_file($cheminEtNomTemporaire, $cheminEtNomDefinitif); // Fonction qui permet de renommer et déplacer le fichier dans le dossier souhaité


if ($moveIsOk) {

    $message = "Le fichier a été uploadé dans ".$cheminEtNomDefinitif;

}
else {

    $message ="Suite à une erreur, le fichier n'a pas été uploadé";

}

$InsertIsOk = $requete ->execute();

if($InsertIsOk){
    //$message = "Le produit a été rajouté dans la base de données";
    header("Location: /Views/liste.php"); // Si le produit a bien été ajouté, il y a une redirection vers la liste

}
else{
    $message = "Echec de l'insertion";
}



