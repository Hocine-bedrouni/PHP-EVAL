<?php
require "../models/connexion_Bdd.php";

$requete = $db->prepare("DELETE FROM record.disc WHERE disc_id=:disc_id");
$requete->bindValue(":disc_id", $_POST['disc_id']);
$res = $requete->execute();


if($res){
    //$message = "Le produit a été supprimé dans la base de données";
    header("Location: ../Views/liste.php"); // Si le produit a bien été supprimé, il y a une redirection ver le tableau.php
}
else{
    $message = "Echec de la suppression";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suppression du produit</title>
</head>
<body>
<h1>Suppression du produit</h1>
<p><?php echo $message; ?></p>
</body>
</html>