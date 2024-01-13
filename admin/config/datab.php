
<?php

// Une bien meilleure manière de se connecter à une base de données
try {
    $database = new PDO('mysql:host=localhost;dbname=g_tech;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur:' . $e->getMessage());
}

?>

<!--
    
Se connecter à la base de données de cette façon c'est bien,
mais c'est trop long et beaucoup plus complexe à comprendre.

Le mieux serait de racoussir les choses, en utilisant le code juste en haut.
C'est simple, très court et compréhensif.😊
-->
<?php
// $database = array(
//     'databaseHost' => 'localhost',
//     'databaseUser' => 'root',
//     'databasePass' => '',
//     'databaseName' => 'g_tech',
//     'databasecharset' => 'utf8'
// );

// try {
//     $bd = new PDO('mysql:host=' . $database['databaseHost'] . ';dbname=' .
//      $database['databaseName'] . ';charset=' . $database['databasecharset'], 
//      $database['databaseUser'], $database['databasePass'],);
//     $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

// } catch (PDOException $e) {
//     $alert = array('alert-error', 'Echec de la connexion à la base de données');

// }

?>