<?php

require('./admin/config/datab.php');

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id_evenement'])) {
  $id_evenement = $_GET['id_evenement'];

  // Préparer et exécuter la requête pour récupérer les détails de l'événement
  $stmt = $database->prepare("SELECT * FROM event_busy WHERE id_event_busy = ?");
  $stmt->execute([$id_evenement]);

  // Récupérer les résultats de la requête
  $evenement = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifier si l'événement existe
  if ($evenement && isset($evenement['Titre'])) {
    // Utiliser les détails de l'événement pour remplir le titre et la description
    $titre = $evenement['Titre'];
    $description = $evenement['Contenu'];
  } else {
    // Gérer le cas où l'ID ne correspond à aucun événement
    $titre = "Titre par défaut";
    $description = "Description par défaut";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css" />
  <title>Document</title>
</head>

<body>
  <div class="login-3 tab-box">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-12 bg-img">
          <div class="information">



            <div class="typing">
              <h1><?= $titre ?></h1>
            </div>
            <p><?= $description ?></p>


          </div>
        </div>

        <!-- formulaire-->

        <div class="col-lg-6 col-md-12 form-section">
          <div class="login-inner-form">
            <div class="details">
              <h3>Inscrivez-vous</h3>
              <form action="save_form.php" method="POST">
                <input type="hidden" name="id_evenement" value="<?= isset($_GET['id_evenement']) ? $_GET['id_evenement'] : ''; ?>">
                <div class="form-group form-box">
                  <input type="text" name="nom" class="form-control" placeholder="Nom" />
                </div>
                <div class="form-group form-box">
                  <input type="text" name="prenom" class="form-control" placeholder="Prénoms" />
                </div>

                <div class="form-group form-box">
                  <input type="email" name="mail" class="form-control" placeholder="Email" />
                </div>
                <div class="form-group form-box">
                  <input type="number" name="tel" class="form-control" placeholder="Contact" />
                </div>

                <div class="form-group">
                  <button type="submit" name="submit" class="btn-md btn-theme w-100">
                    S'inscrire
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>