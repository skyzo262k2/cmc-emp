<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Js/re.js"></script>
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
        function Add() {
            const action_add = "add";
            const mat = document.getElementById("matricule").value;
            const flr = document.getElementById("filiere").value;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Validateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("infomations").innerHTML = this.responseText;
                }
            };
            request.send(`mat=${mat}&flr=${flr}&add=${action_add}`);
        }

        function Delete(mat, flr) {
            const action_delete = "delete";
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Validateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("infomations").innerHTML = this.responseText;
                }
            };
            request.send(`mat=${mat}&flr=${flr}&delete=${action_delete}`);
        }

        function Recherche(inp) {
            let val = inp.value;
            var x = new XMLHttpRequest()
            x.open('GET', '../Controller/C_Validateur.php?info=' + val, true)
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('infomations').innerHTML = this.responseText;
                }
            }
            x.send();
        }

        function DeleteAll() {
            const action_deleteAll = "deleteall";
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Validateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("infomations").innerHTML = this.responseText;
                }
            };
            request.send(`deleteall=${action_deleteAll}`);
        }
    </script>
</head>

<body>


    <div class="row header">
        <div class="col-4 title">
            Gestion Validateur
        </div>
        <div class="col-2"></div>
        <div class="col-4 recherche">
            <input type="text" id="salle" class="form-control inp-recherche" name="salle" value="<?php echo $info; 
                                                                                                    ?>" onkeyup="Recherche(this)" placeholder="Recherche ....">
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row content">
        <div class="col-8 justify-content-center position-absolute end-0" id="infomations">
            <?php
            AjaxInfor($table);
            ?>
           
        </div>
        <div class="col-4 justify-content-center  position-fixed start-0">
            <div class="form-groupe m-4">
                <select name="filiere" id="filiere" class="inputs form-control">
                    <option value="choisir">Choisir Filière</option>
                    <?php
                    foreach ($Filieres as $flr) {
                        echo "<option value='$flr[0]'>$flr[1]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-groupe m-4">
                <select name="matricule" id="matricule" class="inputs form-control">
                    <option value="choisir">Choisir Formateur</option>
                    <?php
                    foreach ($Formateurs as $for) {
                        echo "<option value='$for[0]'>$for[1] $for[2]</option>";
                    }
                    ?>
                </select>
            </div>
            <b style="color: red;">Tout Les Champs obligatoire</b>
            <div class="model-footer m-3">
                <input type="submit" class="btn btn-primary" value="Ajouter" onclick="Add()">
            </div>
        </div>
    </div>
</body>

</html>