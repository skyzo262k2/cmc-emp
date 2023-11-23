<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
  <title>Profile</title>
  <script>
    
    setTimeout(function() {
            document.querySelector('.message').style.display = 'none';
        }, 5000);
  </script>
</head>


<body>
  <div class='container'>
    
  <div class='row message'><?= $message ?></div>
    <div class="row">
      <div class="col-6 ">
        <div class='form-groupe mt-4'>
          <label class='form-label'>Matricule</label>
          <td><input type="text" disabled class="form-control" name="nom" value="<?= htmlspecialchars($mat) ?>"></td>
        </div>
        <div class='form-groupe mt-4'>
          <label class='form-label'>Nom</label>
          <input type="text" disabled class="form-control" name="nom" value="<?= htmlspecialchars($nom) ?>">
        </div>
        <div class='form-groupe mt-4'>
          <label class='form-label'>Prénom</label>
          <input type="text" disabled class="form-control" name="prenom" value="<?= htmlspecialchars($prenom) ?>">
        </div>
      </div>
      <div class="col-6">
        <form action="" method="post">
          <div class='form-groupe mt-4'>
            <label class='form-label'>Mot de passe actuel</label>
            <input type="password" class="form-control" name="motA" value="">
          </div>
          <div class='form-groupe mt-4'>
            <label class='form-label'>Nouveau Mot de passe</label>
            <input type="password" class="form-control" name="MotN" value="">
          </div>
          <div class='form-groupe mt-4'>
            <label class='form-label'>Confirmer Mot de passe</label>
            <input type="password" class="form-control" name="MotC" value="">
          </div>
          <div class='form-groupe mt-4'>
            <input type="submit" class="btn btn-primary w-100" name="valider" value="Sauvegarder">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>