<?php

// require '../PHPMailer-master/src/Exception.php';
// require './PHPMailer-master/src/PHPMailer.php';
// require './PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


include './admin/config/datab.php';


if (isset($_REQUEST['id_evenement'])) {
    $id_evenement = isset($_REQUEST['id_evenement']) ? $_REQUEST['id_evenement'] : 0;

    // Récupérer le titre et la description de l'événement
    $query = $database->prepare("SELECT Titre, Contenu FROM event_busy WHERE id_event_busy = ?");
    $query->execute([$id_evenement]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Utiliser le titre et la description dans votre fichier HTML
    $titre = isset($result['Titre']) ? $result['Titre'] : 'Titre par défaut';
    $description = isset($result['Contenu']) ? $result['Contenu'] : 'Description par défaut';

    // Afficher le titre et la description dans le HTML
    echo "<script>
            document.querySelector('.typing h1').innerText = '{$titre}';
            document.querySelector('.information p').innerText = '{$description}';
          </script>";

    // Vérifier si l'ID de l'événement existe dans la base de données
    $checkEventQuery = $database->prepare("SELECT COUNT(*) FROM event_busy WHERE id_event_busy = ?");
    $checkEventQuery->execute([$id_evenement]);

    if ($checkEventQuery->fetchColumn() > 0) {
        // L'ID de l'événement est valide, vous pouvez l'utiliser
        // Ajouter le participant à la table participant avec l'ID de l'événement
        if (isset($_POST['submit'])) {
            // Vérifier si les champs nécessaires sont présents dans le formulaire
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['tel'])) {
                // Récupérer les valeurs du formulaire
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['mail'];
                $telephone = $_POST['tel'];

                // Ajouter le participant à la table participant avec l'ID de l'événement
                $sql = "INSERT INTO participant (nom, prenom, email, telephone, id_event_busy) VALUES (?, ?, ?, ?, ?)";
                $stmt = $database->prepare($sql);
                $stmt->execute([$nom, $prenom, $email, $telephone, $id_evenement]);

                //Create an instance; passing true enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
                    $mail->Username   = 'cedrictchagba@gmail.com';                     //SMTP username
                    $mail->Password   = 'vtjsmxjkoqjzpazd';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

                    //Recipients
                    $mail->setFrom('cedrictchagba@gmail.com', 'G-Tech');
                    $mail->addAddress('cedrictchagba@gmail.com', $nom);     //Add a recipient
                    //$mail->addAddress('ellen@example.com');               //Name is optional
                    $mail->addReplyTo('cedrictchagba@gmail.com', 'Information');
                    $mail->addCC($email);
                    $mail->addBCC($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Confirmation d\'inscription à l\'événement';
                    $mail->Body    = 'Merci de vous être inscrit à notre événement.';
                    $mail->send();

                    
                    // Rediriger vers la page d'accueil
                    header('Location: index.php');
                } catch (Exception $e) {
                    echo "Message non envoyé. Erreur : {$mail->ErrorInfo}";
                }

            } else {
                // Afficher un message d'erreur si des champs sont manquants
                echo 'Veuillez remplir tous les champs.';
            }
        }
    } else {
        // Afficher un message d'erreur si l'ID de l'événement est manquant dans l'URL
        echo 'L\'ID de l\'événement est manquant dans l\'URL.';
    }
}
