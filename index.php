<?php
include './Views/header.php';
$title = "Page d'accueil";
require "./models/connexion_Bdd.php";
$requete =$db->query('SELECT * FROM record.artist');
$resultat = $requete->fetchAll(PDO::FETCH_OBJ);
var_dump($resultat);

?>


<img src="./assets/img/vinil-record.png" alt="vinil-record" title="" >




























<?php
include './views/footer.php';
?>