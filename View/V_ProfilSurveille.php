<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* Applique un style au tableau */
table {
  border-collapse: collapse;
  width: 100%;
}

/* Applique un style à toutes les cellules de tableau */
td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

/* Applique un style à toutes les étiquettes de formulaire */
label {
  display: inline-block;
  margin-bottom: 5px;
}

/* Applique un style aux champs de formulaire */
input[type="text"],
input[type="password"] {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 100%;
}

/* Applique un style au bouton de soumission */
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Applique un style au bouton de soumission lorsque la souris passe dessus */
input[type="submit"]:hover {
  background-color: #45a049;
}

</style>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Matricule</td>
                <td><input type="text"  disabled name="nom" value="<?=$mat?>"></td>
            </tr>
            <tr>
                <td><label for='nom'>Nom</label></td>
                <td><input type="text"  disabled name="nom" value="<?=$nom?>"></td>
            </tr>
            <tr>
                <td><label for='prenom'>Prenom</label></td>
                <td><input type="text" disabled name="prenom" value="<?=$prenom?>"></td>
            </tr>
            <tr>
                <td><label for='motA'>Mot de passe actuel</label></td>
                <td><input type="password" name="motA" value=""></td>
            </tr>
            <tr>
                <td><label for='MotN'>Nouveau Mot de passe</label></td>
                <td><input type="password" name="MotN" value=""></td>
            </tr>
            <tr>
                <td><label for='MotC'>Confirmer Mot de passe</label></td>
                <td><input type="password" name="MotC" value=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit"  name="valider"></td>
            </tr>
        </table>
    </form>
</body>
</html>