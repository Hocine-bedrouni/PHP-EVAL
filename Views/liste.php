<?php
$titre = "Liste de disques";
include 'header.php';




require "../models/connexion_Bdd.php";

$requete = $db->query("SELECT * FROM record.disc INNER JOIN record.artist ON disc.artist_id = artist.artist_id");

$requete->execute();

$list = $requete->fetchAll(PDO::FETCH_OBJ);

$count_list = $db->query("SELECT COUNT(disc_id) FROM record.disc");
//$count_list->execute();
$count = $count_list->fetch();
?>


<H1>Liste des disques(<?= $count['0'] ?>)</H1>


<div class="col-12 d-flex flex-wrap">
<?php foreach ($list as $val_list){?>
    <div class=" col-6 d-flex justify-content-center mb-4">


        <div class="d-flex justify-content-center col-6"><img src="../assets/img/<?= $val_list->disc_picture ?>" alt="pochette disque" class="img " title=" "></div>
        <div class="col-6 d-flex flex-column align-items-start">
            <span id="Titre" > <?= $val_list->disc_title?> </span>
            <span id="Artist"> <?= $val_list->artist_name?> </span>
            <span id="Label"> Label : <?= $val_list->disc_label?> </span>
            <span id="Annee" >Year: <?= $val_list->disc_year?> </span>
            <span id="Genre" class=" mb-5" > Genre: <?= $val_list->disc_genre?> </span>
            <div class="mt-5"><a class="btn btn-info align-self-end" href="../Views/detail.php?disc_id=<?= $val_list->disc_id?>">Détails</a></div>
        </div>
    </div>
    <?php } ?>
</div>

<?php
include 'footer.php';
?>

