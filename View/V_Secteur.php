<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/re.js"></script>

    <title>Secteurs</title>
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
            let val = document.getElementById("secteur").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Secteur.php?info=' + val, true)
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
            Gestion Secteur
        </div>
        <div class="col-2"></div>
        <div class="col-4 recherche">
            <input type="text" id="secteur" class="form-control inp-recherche" name="secteur" value="<?php echo $info; ?>" onkeyup="Recherche()" placeholder="Recherche ....">
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0"  id="infomations">

            <div class="pagi_sup">

                <div class="pagination">
                    <?php
                    $tab = $page->Pagination_Btn($_SESSION['Secteur'], $_GET['get']);
                    $page->Pagination_Nb($tab, $_GET['get']);
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
                            <th scope="col">Code Secteur</th>
                            <th scope="col">Description De Secteur</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php

                            $page->GetTablePage($_SESSION['Secteur'], $_GET['get']);

                            ?>
                        </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0">
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="text" name="tSect" maxlength="15" id="tSect" class="inputs form-control" placeholder="Code Secteur">
                </div>
                <div class="form-groupe m-4">
                    <textarea name="tDescp" maxlength="50" class="inputs form-control" cols="30" rows="4" placeholder="Description"></textarea>
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