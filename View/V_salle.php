<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../Js/re.js"></script> -->
    <title>Salle</title>
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
            let val = document.getElementById("salle").value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_salle.php?info=' + val, true)
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


        function aff(parentTr) {
            const value_list = [];
            input_fields = document.getElementsByClassName('inputs');
            indice = 0;
            for (const value of parentTr.children) {
                value_list.push(value.textContent);
            }

            let val = value_list[3].split("-");
            value_list[3] = val[0];
            for (const input of input_fields) {
                input.value = value_list[indice];
                indice++;
            }
        }
    </script>
</head>

<body>


    <div class="row header">

        <div class="col-4"></div>
        <div class="col-8 recherche">
            <input type="text" id="salle" class="form-control inp-recherche" name="salle" value="<?= htmlspecialchars($info) ?>" onkeyup="Recherche()" placeholder="Recherche ....">
        </div>
    </div>

    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0" id="infomations">

            <?php if (count($_SESSION["salles"]) > 0) : ?>
                <div class="pagi_sup">

                    <div class="pagination">
                        <?php
                        $salles = $page->Pagination_Btn($_SESSION['salles'], $_GET['get']);
                        $page->Pagination_Nb($salles, $_GET['get']);
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
                                <th scope="col">code salle</th>
                                <th scope="col">Description salle</th>
                                <th scope="col">Type</th>
                                <th scope="col">Secteur</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $page->GetTablePage($_SESSION['salles'], $_GET['get']);
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div><img src='../Images/nodata.jpg' alt='' /></div>
            <?php endif; ?>
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0">
            <div class="title">
                Gestion des salles
            </div>

            <div class='message'><?= $message ?></div>
            <form action="" method="post" id="form">
                <div class="form-groupe m-4">
                    <input type="text" name="cdsl" maxlength="15" id="cdsl" class="inputs form-control" placeholder="Code Salle">
                </div>
                <div class="form-groupe m-4">
                    <textarea name="descrpsl" id="descrpsl" maxlength="50" class="inputs form-control" cols="30" rows="4" placeholder="Description"></textarea>
                </div>

                <div class="form-groupe m-4">
                    <select name="type" class="inputs form-control">
                        <option value="">Choisir Type Salle</option>
                        <option value="SALLE">SALLE</option>
                        <option value="ATELIER">ATELIER</option>
                    </select>
                </div>
                <div class="form-groupe m-4">
                    <select name="tSecteur" class="inputs form-control">
                        <option value="choisir">Choisir Secteur</option>
                        <option value="Sans">Sans Secteur</option>
                        <?php foreach ($AlSecteurs as $sec) {
                            echo '<option value=' . htmlspecialchars($sec[0]) . '>' . htmlspecialchars($sec[1]) . '</option>';
                        }
                        ?>
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