<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Js/re.js"></script>
    <title>Groupes</title>
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

        .pag {
            margin: 1px;
            border-radius: 50%;
        }
    </style>

    <script>
        function Recherche() {
            let val = document.getElementById("groupe").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Groupe.php?info=' + val, true)
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('infomations').innerHTML = this.responseText;
                }
            }
            x.send();
        }
    </script>

</head>

<body>


    <div class="row header">
        <div class="col-4 title">
            Gestion Groupe
        </div>
        <div class="col-2"></div>
        <div class="col-4 recherche">
            <input type="text" id="groupe" class="form-control inp-recherche" name="groupe" value="<?php echo $info; ?>" onkeyup="Recherche()" placeholder="Recherche ....">

        </div>
        <div class="col-2"></div>
    </div>
    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0"  id="infomations">

            <div class="pagi_sup">

                <div class="pagination">
                    <?php
                    $groupes = $page->Pagination_Btn($_SESSION['Groupe'], $_GET['get']);
                    $page->Pagination_Nb($groupes, $_GET['get']);
                    ?>
                </div>
                <div class="deleteAll">
                    <form action="" method="post">
                        <input type="submit" value="Supprimer tous" name="btnSupprimer" class="btn btn-primary end-0" onclick="return confirm('Tu es Sure pour Supprimer Tous ?')" id="btnSupprimer">
                    </form>
                </div>

            </div>

            <div class="table-affiche">

                <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Code Groupe</th>
                            <th scope="col">Code Filiere</th>
                            <th scope="col">Annee</th>
                            <th scope="col">Fpa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            $page->GetTablePage($_SESSION['Groupe'], $_GET['get']);
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0 m-4">
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="text" name="tCodeGrp" maxlength="15" id="tCodeGrp" class="inputs form-control" placeholder="Code Groupe">
                </div>
                <div class="form-groupe m-4">
                    <select name="tCodeFlr" class="inputs  form-control">
                        <option value="choisir">Choisir Filiere</option>
                        <?php foreach ($Filiers as $filiere) : ?>
                            <option value="<?= $filiere['CodeFlr'] ?>"><?= $filiere['CodeFlr']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-groupe m-4">
                    <select name="tAnnee" class="inputs form-control">
                        <option value="choisir">Choisir Annee de Formation</option>
                        <option value='1'>Premier Annee</option>
                        <option value='2'>Deuxieme Annee</option>
                        <option value='3'>Troisième Annee</option>
                    </select>
                </div>
                <b style="color: red;">Tout Les Champs obligatoire</b>
                <div class="model-footer m-3">
                    <input type="submit" class="btn btn-primary" value="Ajouter" name="btnAjouter">
                    <input type="submit" class="btn btn-primary" value="Modifier" name="btnModifier">
                    <input type="reset" class="btn btn-primary" value="reset">


                </div>
            </form>
        </div>
    </div>
</body>

</html>