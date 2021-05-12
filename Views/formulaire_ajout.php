<?php
$titre = "Page d'accueil";
include 'header.php';
require "../models/connexion_Bdd.php";



$resultat = $db->query("SELECT * FROM record.disc INNER JOIN record.artist ON disc.artist_id = artist.artist_id");
$resultat -> execute();
$disc = $resultat->fetchAll(PDO::FETCH_OBJ);
$result2 = $db->query("SELECT * FROM record.artist");
$artiste = $result2->fetchAll(PDO::FETCH_OBJ);

//var_dump($disc);
?>

<div class="row">
    <form class="col-lg-10 mx-auto" action="../Controllers/script_ajout.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Titre">Titre</label>
            <input type="text" class="form-control" id="Titre" name="Titre">
            <span id="alert"></span>
        </div>
        <div class="form-group">
            <label for="Artist">Artiste :</label>
            <select class="custom-select" name="Artist" id="Artist">
                <option value="">-- Veuillez sélectionner un artiste --</option>
                <?php
                foreach ($artiste as $val_art) // Permet l'affichage du menu déroulant pour obtenir la liste des artistes
                {
                    ?>
                    <option value="<?= $val_art->artist_id ?>"><?= $val_art->artist_name ?></option>

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
            <button type="submit" class="btn btn-success" name="envoie" id="bouton_envoi2">Ajouter</button>
            <button type="reset" onclick='document.location.reload(false)' class="btn btn-danger" name="Annuler">Annuler</button>
        </div>

    </form>
</div>





<?php
include '../Views/footer.php';
?>