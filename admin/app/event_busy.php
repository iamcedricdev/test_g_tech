<?php

if ($_GET['page'] == 'event_busy') {
    include('./config/datab.php');
    if (isset($_POST['submit'])) {
        if (!empty($_POST['nom_event']) && !empty($_POST['description']) && !empty($_POST['date_debut']) && !empty($_POST['date_fin']) && !empty($_POST['payGra']) && !empty($_POST['ligne']) && !empty($_POST['montant']) && !empty($_POST['lieu']) && !empty($_FILES['fichier']['tmp_name'])) {
            var_dump($_POST);
            extract($_POST);

            //print_r($_FILES['fichier']);

            $content_dir = './app/images/';

            $tmp_files = $_FILES['fichier']['tmp_name'];

            if (!is_uploaded_file($tmp_files)) {

                exit('le fichier est introuvable');
            }

            $type_file = $_FILES['fichier']['type'];

            if (!strstr($type_file, 'jpeg') && !strstr($type_file, 'png')) {


                exit('le fichier n\'est pas une image');

            }
            $name_file = time() . '.jpg';

            if (!move_uploaded_file($tmp_files, $content_dir . $name_file)) {
                exit('impossible de copier le fichier');
            }
            include('./config/datab.php');
            $save_actu = $bd->prepare("INSERT INTO event_busy(Nom_event, description ,image_name, date_debut, date_fin, payGra, montant, LignePre, Lieu) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $save_actu->execute(array($nom_event, $description, $name_file, $date_debut, $date_fin, $payGra, $montant, $ligne, $lieu));
            $bd->errorInfo();
            $err = $save_actu->errorInfo();
            if ($err[0] != "00000") {
                print_r($err);
            }





        } else {
            $alert = array('alert-error', 'Veuillez remplir tous les champs');
        }
    }
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            $deleteActu = $bd->prepare("DELETE FROM event_busy WHERE id=?");
            $deleteActu->execute(array($_GET['id']));

            header('Location: admin.php?page=AddActu');
        } elseif ($_GET['action'] == 'modifer') {


        }
    }
} else {
    header('Location: ../admin/template/404/error404.php');
}
?>