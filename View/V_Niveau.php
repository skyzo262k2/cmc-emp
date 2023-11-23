<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/re.js"></script>

    <title>Niveaux</title>
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
            let val = document.getElementById("niveau").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Niveau.php?info=' + val, true)
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
            <input type="text" id="niveau" class="form-control inp-recherche" name="niveau" value="<?= htmlspecialchars($info) ?>" onkeyup="Recherche()" placeholder="Recherche ....">
        </div>
    </div>





    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0" id="infomations">

            <?php if (count($_SESSION["Niveau"]) > 0) : ?>
                <div class="pagi_sup">

                    <div class="pagination">
                        <?php
                        $tab = $page->Pagination_Btn($_SESSION['Niveau'], $_GET['get']);
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

                    <form action="" method="post">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">Code Niveau</th>
                                    <th scope="col">Description De Niveau</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $page->GetTablePage($_SESSION['Niveau'], $_GET['get']);
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>

            <?php else : ?>
                <div><img src='../Images/nodata.jpg' alt='' /></div>
            <?php endif; ?>
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0 m-4">
            <div class="title">
                Gestion des niveaux
            </div>

            <div class='message'><?= $message ?></div>
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="text" name="tCodeNiv" maxlength="2" id="tCodeNiv" class="inputs form-control" placeholder="Code Niveau">
                </div>
                <div class="form-groupe m-4">
                    <textarea name="tDescNiv" maxlength="25" class="inputs form-control" cols="30" rows="2" placeholder="Description"></textarea>
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