<?php


// GESTION DES MESSAGES D'ERREUR

// Initialisation d'un tableau d'erreur

$err_tab = [];

// Titre

if(empty ($_POST["titre"]))
{
    $err_tab[] = "err_titre = true";
}
elseif (!preg_match("/^[A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+([-'\s][A-zA-ZñéèîïÉÈÎÏ0-9][A-zA-Zñéèêàçîï0-9]+)?$/",($_POST["titre"])))
{
    $err_tab[] ="err_titre2 = true";
}
else
{
    echo "titre : ". $_POST["titre"] ."<br>";
}

// Artiste

if(empty ($_POST["artiste"]))
{
    $err_tab[] = "err_artiste = true";
}
else
{
    echo "artiste : ". $_POST["artiste"] . "<br>";
}

// Année

if(empty ($_POST["annee"]))
{
    $err_tab[] = "err_annee = true";
}
else
{
    echo "annee : ". $_POST["annee"] . "<br>";
}

// Genre

if(empty ($_POST["genre"]))
{
    $err_tab[] = "err_genre = true";
}
else
{
    echo "genre : ". $_POST["genre"] . "<br>";
}

// Label

if(empty ($_POST["disc_label"]))
{
    $err_tab[] = "err_label = true";
}
else
{
    echo "label : ". $_POST["disc_label"] . "<br>";
}

// Prix

if(empty ($_POST["disc_price"]))
{
    $err_tab[] = "err_prix = true";
}
else if(!preg_match("/^[0-9]+$/",($_POST["disc_price"])))
{
    $err_tab[] = "err_prix2 = true";
}
else
{
    echo "Prix : ". $_POST["disc_price"] . "<br>";
}

// CONNEXION A LA BDD ET RECUPERATION DES INFORMATIONS AVEC DES REQUETES SQL

require "../models/connexion_Bdd.php";

// Requête SQL pour insérer les valeurs ajoutées dans le formulaire d'ajout
try{
$db_ajout = $db->prepare("INSERT INTO record.disc(disc_title, disc_year, disc_label, disc_genre, disc_price)VALUES(:disc_title, :disc_year, :disc_label, :disc_genre, :disc_price)");

// bindValue : Associe une valeur à un paramètre
$db_ajout->bindParam(':disc_title', $_POST['disc_title'], PDO::PARAM_STR);
$db_ajout->bindParam(':disc_year', $_POST['disc_year'], PDO::PARAM_STR);
$db_ajout->bindParam(':disc_label', $_POST['disc_label'], PDO::PARAM_STR);
$db_ajout->bindParam(':disc_genre', $_POST['disc_genre'], PDO::PARAM_STR);
$db_ajout->bindParam(':disc_price', $_POST['disc_price'], PDO::PARAM_INT);


$db_ajout->execute();

// Libération de la connexion au serveur de BDD
$db_ajout->closeCursor();
}
// Gestion des erreurs
catch (Exception $e) {

    echo "La connexion à la base de données a échoué ! <br>";
    echo "Merci de bien vérifier vos paramètres de connexion ...<br>";
    echo "Erreur : " . $e->getMessage() . "<br>";
    echo "N° : " . $e->getCode();
    die("Fin du script");
}

//// Redirection vers la page index.php
//header("Location: index.php");
//exit;