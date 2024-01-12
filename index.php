

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css" />
  <title>Inscription</title>
</head>

<body>
  <div class="login-3 tab-box">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-12 bg-img">
          <div class="information">
           
            <div class="typing">
              <h1>Formulaires</h1>
            </div>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed
              suscipit, laudantium vitae ad mollitia quas. Voluptatum corrupti
              suscipit quis rem adipisci reiciendis, voluptates earum placeat.
            </p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>

        <!-- formulaire-->

        <div class="col-lg-6 col-md-12 form-section">
          <div class="login-inner-form">
            <div class="details">
              <h3>Inscrivez-vous</h3>
              <form action="save_form.php" method="POST">
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