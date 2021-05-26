<?php
require $_SERVER['DOCUMENT_ROOT'].'/models/connexion_Bdd.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/record.css">
    <title><?= $titre  ?></title>
</head>
<body>
<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="#">Evaluation PHP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/index.php">Accueil</a></li>

                <li class="nav-item active">
                    <a class="nav-link" href="/Views/liste.php">Liste</a></li>
                <li class="nav-item active">
                    <a class="nav-link" href="/Views/formulaire_ajout.php">Ajouter</a></li></ul>
            <ul class="navbar-nav">
                <li class="nav-item active ">
                    <a class="nav-link text-warning" ><?= $conex ?></a></li>

            </ul>
        </div>
    </nav>

</header>