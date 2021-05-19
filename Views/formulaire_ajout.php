<?php
$title = "Page d'accueil";
include 'header.php';
require "../models/connexion_Bdd.php";

$resultat = $db->query("SELECT * FROM record.artist"); // Requête pour avoir la valeur des champs de la table 'artist'
$resultat2 = $db->query("SELECT * FROM record.disc");  // Requête pour avoir la valeur des champs de la table 'disc'
$artist = $resultat->fetchAll(PDO::FETCH_OBJ);
$disc = $resultat2->fetchAll(PDO::FETCH_OBJ);
var_dump($artist);
var_dump($disc);
?>

<div class="row">
    <form class="col-lg-10 mx-auto" action="../controllers/script_ajout.php" method="GET" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Titre">Titre</label>
            <input type="text" class="form-control" id="Titre" name="Titre">
            <span id="alert"></span>
        </div>
        <div class="form-group">
            <label for="artist">Artiste :</label>
            <select class="custom-select" name="artist" id="artist">
                <option value="">-- Veuillez sélectionner un artiste --</option>
                <?php
                foreach ($artist as $val_art) // Permet l'affichage du menu déroulant pour obtenir la liste des artistes
                {
                    ?>
                    <option value="<?= $val_art->artist_id ?>"><?= $val_art->artist_id . "-" . $val_art->artist_name ?></option>
                    <?php
                }
                ?>
            </select>
            <span id="alert13"></span>
            <span id="categorie_manquante"></span>
        </div>
        <div class="form-group">
            <label for="Annee">Année</label>
            <input type = "text" class="form-control" id="Annee" name="Annee">
            <span id="alert"></span>
        </div>
        <div class="form-group">
            <label for="Genre">Genre</label>
            <input type = "text" class="form-control" id="Genre" name="Genre">
            <span id="alert"></span>
        </div>
        <div class="form-group">
            <label for="Label">Label</label>
            <input type = "text" class="form-control" id="Label" name="Label">
            <span id="alert"></span>
        </div>
        <div class="form-group">
            <label for="Prix">Prix</label>
            <input type = "text" class="form-control" id="Prix" name="Prix">
            <span id="alert"></span>
        </div>

        <!-- TELECHARGEMENT IMAGE -->

        <p>Photo du produit :</p>

        <input type="hidden" name="MAX_FILE_SIZE" value="104857600"/>

        <p><input type="file" name="fichier" id= "fichier"></p>
        <div class="form-group">
            <!-- Quand on clique sur le bouton retour on affiche la page liste -->
            <a href="liste.php" class="btn btn-dark m-0">Retour</a>
            <input type="submit" class="btn btn-success" value="Ajouter" id="bouton_envoi2">
            <input type="reset" onclick='document.location.reload(false)' class="btn btn-danger" value="Annuler">
        </div>

    </form>
</div>





<?php
include '../Views/footer.php';
?>