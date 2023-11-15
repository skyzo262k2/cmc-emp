<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/re.js"></script>
    <title>Surveille</title>
    <style>
        .row {
            width: 95%;
        }

        .col-8 {
            text-align: center;
        }

        .col-4 {
            text-align: center;
        }

        .pagi_sup {
            display: flex;
            margin-bottom: 10px;
        }

        .pag {
            margin: 1px;
            border-radius: 50%;
        }

        .pagination {
            width: 80%;
            padding-left: 40%;
        }

        .deleteAll {
            width: 20%;
        }

        .title {
            font-weight: 600;
            color: blue;
            font-size: 2em;
            text-align: center;
            animation: slideInFromTop 1s ease-in-out;

        }

        .recherche {
            align-self: center;
            align-content: center;
            align-items: center;
            text-align: center;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .header {
            margin: 20px;

        }

        .sup {
            padding: 0;
            border: none;
        }
    </style>

    <script>
        function Recherche() {
            let val = document.getElementById("formateur").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Surveille.php?info=' + val, true)
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {                    
                    document.getElementById('infomations').innerHTML = this.responseText;
                }
            }
            x.send();
        }
        function Secteur(slc)
        {
            let secteur=document.getElementById('secteur')
            if(slc.value=="ChefSecteur")
            {
                secteur.hidden=false
            }else{
                secteur.hidden=true
            }
        }
    </script>

</head>

<body>
    <div class="row header">
        <div class="col-4 title">
            Gestion Utilisateur
        </div>
        <div class="col-2"></div>
        <div class="col-4 recherche">
            <form action="" method="post" id="form">
                <input type="text" id="formateur" class="form-control inp-recherche" name="formateur" value="<?php echo $info; ?>" onkeyup="Recherche()" placeholder="Recherche ....">
            </form>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0" id="infomations">

            <div class="pagi_sup">
                <?php if (count($_SESSION['Surveilles']) != 0) : ?>
                    
                    <div class="pagination">
                        <?php
                        $Surveilles = $Pag->Pagination_Btn($_SESSION["Surveilles"], $_GET['get']);
                        $Pag->Pagination_Nb($Surveilles, $_GET['get']);
                        ?>
                    </div>
                    <div class="deleteAll">
                        <form action="" method="post">
                            <input type="submit" value="Supprimer tous" class="btn btn-primary" name="btnSupprimer" class="end-0" onclick="return confirm('Tu es Sure pour Supprimer Tous ?')" id="btnSupprimer">
                        </form>
                    </div>
                <?php endif; ?>

            </div>

            <div class="table-affiche">
                <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope='col'>Type Utilisateur</th>
                            <th scope="col">Réinitialiser</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $Pag->GetTablePage($_SESSION["Surveilles"], $_GET["get"],'formateur'); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0">
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="text" class="inputs form-control" maxlength="15" name="tMatricule" id="tMatricule" placeholder="Matricule">
                </div>
                <div class="form-groupe m-4">
                    <input type="text" class="inputs form-control" maxlength="25" name="tNom" id="tNom" placeholder="Nom">
                </div>
                <div class="form-groupe m-4">
                    <input type="text" class="inputs form-control" maxlength="25" name="tPrenom" id="tPrenom" placeholder="Prénom">
                </div>
                <div class="form-groupe m-4">
                    <select name="typeuser" id="typeuser" onchange="Secteur(this)" class="form-control">
                        <option value="">Type Utilisateur</option>
                        <option value="Surveille">Surveille</option>
                        <option value="ChefSecteur">Chef Secteur</option>
                    </select>
                </div>

                <div class="form-groupe m-4">
                    <select name="secteur" id="secteur" hidden  class="form-control">
                        <option value="">Choisir Seteur</option>
                        <?php foreach($AlSecteurs as  $value) {?>
                            <option value="<?=$value['CodeSect']?>">
                                <?=$value['DescpSect']?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <b style="color: red;">Tout Les Champs obligatoire</b>
                <div class="model-footer m-3">
                    <input type="submit" class="btn btn-primary" value="Ajouter" name="btnAjouter">
                    <!-- <input type="submit" class="btn btn-primary" value="Modifier" name="btnModifier"> -->
                    <input type="reset" class="btn btn-primary" value="reset">
                </div>
            </form>
        </div>
    </div>
</body>
</html>