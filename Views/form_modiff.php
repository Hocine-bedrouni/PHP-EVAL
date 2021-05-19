<?php
$title = "Modif";
include'header.php';
require "../models/connexion_Bdd.php"; // Inclusion de notre bibliothèque de fonctions

$disc_id = $_GET["disc_id"]; // Pour récupérér la variable passée dans l'URL, il faut utiliser le tableau associatif $_GET
$requete3 = "SELECT * FROM record.disc /*WHERE disc_id=*/"/*.$disc_id*/; // Requête SQL pour sélectionner les infos sur les disques en fonction de leur ID
$requete4 = "SELECT * FROM record.artist /*ORDER BY artist_id*/"; // Requête SQL pour sélectionner les artistes
$result = $db->query($requete3); // Exécute la requête SQL et retourne un jeu de résultat
$result2 = $db->query($requete4);

// Renvoi de l'enregistrement sous forme d'un objet
$disc = $result->fetchAll(PDO::FETCH_OBJ);
$artist = $result2->fetchAll(PDO::FETCH_OBJ);

date_default_timezone_set('Europe/Paris');
$date = date("d-m-Y H:i:s");
?>

<div class="row">

    <form class="col-lg-12" action="../controllers/script_modif.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="disc_id" value="<?php echo $disc_id; ?>">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" name="titre" value ="<?=$disc->disc_title?>" id="titre">
        </div>

        <div class="form-group">
            <label for="artist">Artiste :</label>
            <select class="custom-select" name="artist" id="artist">
                <?php
                foreach($disc as $val_disc) // Pour afficher la liste des atistes sous forme d'un menu déroulant
                {
                    ?>
                    <option value = "<?= $val_disc->disc_id?>"
                        <?php

                        if ($val_disc->disc_id == $artist->artist_id) // Si il y a correspondance on sélectionne la catégorie indiquée
                        {
                            echo "selected";
                        }
                        ?>

                    > <?=$val_disc->disc_id."-".$artist->artist_name?></option>
                    <?php
                }
                ?>

            </select>
        </div>

        <div class="form-group">
            <label for="Annee">Année :</label>
            <input type="text" class="form-control" name="Annee" value ="<?=$disc->disc_year?>" id="Annee">
        </div>

        <div class="form-group">
            <label for="Genre">Genre :</label>
            <input type='text' class="form-control" name="Genre"  id="Genre"  placeholder="<?= $disc->disc_genre; ?>"></input><br>
        </div>

        <div class="form-group">
            <label for="Labe">Label :</label>
            <input type="text" class="form-control" name="Label" value ="<?=$disc->disc_label?>" id="Label">
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="text" class="form-control" name="prix" value ="<?=$disc->disc_price?>" id="prix">
        </div>







</div><br>

<!-- TELECHARGEMENT IMAGE -->

<p>Photo du article :</p>

<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />

<p><input type="file" name="fichier" id="fichier"></p>


<div class="form-group">
    <a href="./list.php" class="btn btn-dark m-0">Retour</a>
    <input type="submit" class="btn btn-warning m-0" value="Actualiser">
</div>


</form>

<?php
include("footer.php");
?>
