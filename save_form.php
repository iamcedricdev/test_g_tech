<?php 

// Récupération des informations du formulaire
if (isset($_POST['submit'])) {
 if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['mail']) || empty($_POST['tel'])) {
  
  $alert = array('alert-error', 'Veuillez renseigner tous les champs');
 }
} else {

include '../admin/config/datab.php';
try {
    $sql = "INSERT INTO participant(nom,prenom,email,telephone)
       VALUES('$_POST[nom]','$_POST[prenom]','$_POST[mail]','$_POST[tel]')";
    $resultat = $bdd->exec($sql);
    //$resultat->execute(array($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp']));

    header('Location: index.php');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
}

?>