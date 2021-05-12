<?php

try {
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root','admin');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conex = 'connexion DB success';
}
catch(Exception $e) {
    echo "Erreur : ". $e->getMessage() ."<br>";
    echo "N° :" .$e->getCode();
    die("Fin du script");
}
?>
