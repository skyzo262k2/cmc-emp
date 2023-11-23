<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/re.js"></script>

    <title>Stagiaires</title>
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
            let val = document.getElementById("stagiaire").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Stagiaire.php?info=' + val, true)
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('infomations').innerHTML = this.responseText;
                }
            }
            x.send();
        }

        setTimeout(function() {
            document.querySelector('.message').style.display = 'none';
        }, 5000);
    </script>

</head>

<body>


    <div class="row header">
        <div class="col-4"></div>
        <div class="col-8 recherche">
            <input type="text" id="stagiaire" class="form-control inp-recherche" name="stagiaire" value="<?= htmlspecialchars($info) ?>" onkeyup="Recherche()" placeholder="Recherche ....">
        </div>
    </div>



    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0" id="infomations">

            <?php if (count($_SESSION["Stagiaire"]) > 0) : ?>
                <div class="pagi_sup">

                    <?php if (count($_SESSION['Stagiaire']) != 0) : ?>
                        <div class="pagination">
                            <?php
                            $tab = $page->Pagination_Btn($_SESSION['Stagiaire'], $_GET['get']);
                            $page->Pagination_Nb($tab, $_GET['get']);
                            ?>
                        </div>

                        <div class="deleteAll">
                            <form action="" method="post">
                                <input type="submit" value="Supprimer tous" name="btnSupprimer" class="btn btn-primary end-0" onclick="return confirm('Tu es Sure pour Supprimer Tous ?')" id="btnSupprimer">
                            </form>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="table-affiche">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="table-success">
                                <th>CEF</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Groupe</th>
                                <th>Discipline</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $page->GetTablePage($_SESSION['Stagiaire'], $_GET['get']);
                            ?>
                        </tbody>

                    </table>
                </div>
            <?php else : ?>
                <div><img src='../Images/nodata.jpg' alt='' /></div>
            <?php endif; ?>

        </div>
        <div class="col-4 justify-content-center  position-fixed start-0 ">
            <div class="title">
                Gestion Stagiaire
            </div>

            <div class='message'><?= $message ?></div>
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="number" class="inputs form-control" name="cef" id="cef" placeholder="CEF">
                </div>
                <div class="form-groupe m-4">
                    <input type="text" class="inputs form-control" name="nom" id="nom" placeholder="Nom">

                </div>
                <div class="form-groupe m-4">
                    <input type="text" class="inputs form-control" name="prenom" id="prenom" placeholder="Prénom">

                </div>

                <div class="form-groupe m-4">
                    <select name="groupe" id="groupe" class="inputs form-control">
                        <option value="choisir">Choisir groupe</option>
                        <?php
                        foreach ($groupes as $grp) {
                            echo "<option value='".htmlspecialchars($grp[0])."'>".htmlspecialchars($grp[0])."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-groupe m-4">
                    <select name="discipline" id="discipline" class="inputs form-control">
                        <option value="discipline">discipline</option>
                        <option value="Avertissement 1">Avertissement 1</option>
                        <option value="Avertissement 2">Avertissement 2</option>
                        <option value="Avertissement 3">Avertissement 3</option>
                        <option value="Avertissement 4">Avertissement 4</option>
                        <option value="Avertissement 5">Avertissement 5</option>
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