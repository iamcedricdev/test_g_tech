<?php getHeader();

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<div class="">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Ajout d'un évènement</h4>
      <form class="forms-sample" action="" method="post"  enctype="multipart/form-data"> 
        <div class="form-group">
          <label for="exampleInputName1">Nom de l'évènement</label>
          <input type="text" class="form-control" id="nom_event" name="nom_event"
            placeholder="Entrez le nom de l'évènement">
        </div>
        <div class="form-group">
          <label for="exampleTextarea1">Description</label>
          <input type="text" class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
        <div class="form-group">
    <label for="exampleInputName1">Date de début</label>
    <input type="Date" class="form-control flatpickr" id="date_debut" name="date_debut" placeholder="Date de début" onchange="calculerDateFin()">
</div>

<div class="form-group">
    <label for="exampleInputName2">Événement sur plusieurs jours</label>
    <input type="checkbox" id="sur_plusieurs_jours" name="sur_plusieurs_jours" onchange="afficherChampDuree()">
</div>

<div id="champ_duree" style="display: none;">
    <div class="form-group">
        <label for="exampleInputName3">Nombre de jours</label>
        <input type="number" class="form-control" id="nombre_jours" name="nombre_jours" placeholder="Nombre de jours" onchange="calculerDateFin()">
    </div>
</div>

<div class="form-group">
    <label for="exampleInputName4">Date de fin</label>
    <input type="Date" class="form-control" id="date_fin" name="date_fin" placeholder="Date de fin" readonly>
</div>

        <div class="form-group">
          <label for="selectPayant">Payant/Gratuit</label>
          <select name="payGra" class="form-control" id="selectPayant" onchange="toggleMontantField()">
            <option value="payant">Payant</option>
            <option value="gratuit">Gratuit</option>
          </select>
        </div>
        <div class="form-group" id="montantField">
          <label for="exampleInputName1">Montant</label>
          <input type="text" class="form-control" id="montant" name="montant" placeholder="F CFA">
        </div>
        <div class="form-group">
          <label for="selectlieu">Presentiel/ligne</label>
          <select name="ligne" class="form-control" id="selectlieu" onchange="togglelieuField()">
            <option value="Presentiel">Presentiel</option>
            <option value="ligne">Ligne</option>
          </select><br>

          <div class="form-group" id="lieuField">
            <label for="exampleInputName1">Localisation</label>
            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Entrez le lieu">
          </div>



          <div class="form-group">
            <label>Image</label>
            <input type="file" name="fichier" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="file" class="btn btn-primary" name="fichier" class="form form-control"><br><br>

            </div>
          </div>

          <input type="submit" name="submit" class="btn btn-success"><br><br><br>

      </form>
    </div>

    
  </div>
</div>

<script>
  function toggleMontantField() {
    var montantField = document.getElementById('montantField');
    var selectPayant = document.getElementById('selectPayant');

    if (selectPayant.value === 'gratuit') {
      montantField.style.display = 'none';
    } else {
      montantField.style.display = 'block';
    }
  }
  function togglelieuField() {
    var lieuField = document.getElementById('lieuField');
    var selectlieu = document.getElementById('selectlieu');

    if (selectlieu.value === 'ligne') {
      lieuField.style.display = 'none';
    } else {
      lieuField.style.display = 'block';
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr('.flatpickr', {
    dateFormat: 'd-m-Y',
    minDate: "today"
  });
</script>
<script>
    function afficherChampDuree() {
        var champDuree = document.getElementById('champ_duree');
        var checkboxSurPlusieursJours = document.getElementById('sur_plusieurs_jours');

        if (checkboxSurPlusieursJours.checked) {
            champDuree.style.display = 'block';
        } else {
            champDuree.style.display = 'none';
        }

        calculerDateFin();
    }

    function calculerDateFin() {
        var dateDebut = new Date(document.getElementById('date_debut').value);
        var nombreJours = parseInt(document.getElementById('nombre_jours').value, 10) || 0;

        if (!isNaN(nombreJours) && nombreJours > 0) {
            var dateFin = new Date(dateDebut);
            dateFin.setDate(dateFin.getDate() + nombreJours);
            document.getElementById('date_fin').value = dateFin.toISOString().split('T')[0];
        } else {
            document.getElementById('date_fin').value = '';
        }
    }
</script>


<?php getFooter() ?>