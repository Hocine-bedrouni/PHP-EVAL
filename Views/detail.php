<?php
$titre = "Détails disques";
include 'header.php';

$disc_id = $_GET["disc_id"];
$requete = "SELECT * FROM record.disc INNER JOIN record.artist ON disc.artist_id = artist.artist_id WHERE disc_id=".$disc_id; // Construction de la requête SQL
$result = $db->query($requete); // $db->query($requete) revient à appeler la fonction query() de l'objet $db en lui passant la requête SQL en argument. Le résultat $db->query() est stocké dans un objet $result.
$disc = $result->fetch(PDO::FETCH_OBJ); // Renvoi de l'enregistrement sous forme d'un objet






?>


<form action ="..//atelier4/modele/script_modif.php" class="justify-content-center"method="post">

    <div class="text-center">
    <img src="../images/<?=$disc->disc_picture?>" width="300" alt="produit"> <!-- Pour ajouter la photo de couverture du cd : width="300 permet de redimensionner la photo et en n'indiquant qu'un seul paramètre le navigateur se charge de calculer le deuxième c'est à dire height en conservant les proportions de départ -->
    </div>

    <label for="titre">Titre : </label>
    <input type="text"  name="titre" class="form-control" readonly placeholder="<?= $disc->disc_title; ?>"><br>


    <label for="artist">Artiste:</label>
    <input type="text"  name="artist" class="form-control" readonly placeholder="<?= $disc->artist_name; ?>"><br>

    <label for="annee">Année :</label>
    <input type="text" class="form-control" name="annee" readonly placeholder="<?= $disc->disc_year; ?>"><br>

    <label for="Genre">Genre:</label>
    <input type="text" class="form-control" name="Genre" readonly placeholder="<?= $disc->disc_genre; ?>"><br>

    <label for="Label">Label :</label>
    <input type="text" class="form-control" name="Label" readonly placeholder="<?= $disc->disc_label; ?>"><br>

    <label for="nom">Prix :</label>
    <input type="text" required class="form-control" name="prix" readonly placeholder="<?= $disc->disc_price; ?>"><br>


    <div class="text-center">
        <!-- Quand on clique sur le bouton retour on affiche la liste -->
        <a href="liste.php" class="btn btn-dark m-0 ">Retour</a>
        <!-- <a href="/php/produits_modif_script.php?id=<?php echo $r['pro_id']?>" class="btn btn-warning">EDITER</a> -->
        <!-- Quand on clique sur le bouton modifier on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $disc->disc_id?> -->
        <a href="form_modiff.php?disc_id=<?= $disc->disc_id?>" class="btn btn-warning m-0">Modifier</a>
        <!-- Quand on clique sur le bouton supprimer on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $disc->disc_id?> -->
        <a href="../controllers/script_supp.php?disc_id=<?= $disc->disc_id?>" class="btn btn-danger m-0" onclick="return confirm('Etes-vous certain(e) de vouloir supprimer le produit ?')">Supprimer</a>

