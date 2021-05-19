
<?php
require "../models/connexion_Bdd.php";
date_default_timezone_set('Europe/Paris'); // Toujours le datetime avant la variable $date
$date = date("Y-m-d H:i:s");
// var_dump($_FILES);

// Récupération de l'extension du fichier
$extension = substr (strrchr ($_FILES['fichier']['name'], "."), 1);
$nouveauNom = $_POST['pro_id'].'.'.$extension;

$requete = $db->prepare("UPDATE record.disc SET disc_title=:disc_title, pro_cat_id=:pro_cat_id, pro_libelle=:pro_libelle, pro_description=:pro_description, 
pro_prix=:pro_prix, pro_stock=:pro_stock, pro_couleur=:pro_couleur, pro_bloque=:pro_bloque, pro_d_modif='".$date."', disc_id=:disc_id WHERE disc_id=:disc_id");

$requete->bindValue(':pro_ref', $_POST['reference'], PDO::PARAM_STR);
$requete->bindValue(':pro_cat_id', $_POST['pro_cat_id'], PDO::PARAM_STR);
$requete->bindValue(':pro_libelle', $_POST['libelle'], PDO::PARAM_STR);
$requete->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
$requete->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_STR);
$requete->bindValue(':pro_stock', $_POST['stock'], PDO::PARAM_STR);
$requete->bindValue(':pro_couleur', $_POST['couleur'], PDO::PARAM_STR);
$requete->bindValue(':pro_id', $nouveauNom, PDO::PARAM_STR);
$requete->bindValue(':pro_id', $_POST['pro_id'], PDO::PARAM_INT);

if ($_POST['bloque']==0) {
    $bloque = NULL;
} else if  ($_POST['bloque']==1) {
    $bloque = 1;
}

$requete->bindValue(':pro_bloque', $bloque, PDO::PARAM_STR);
