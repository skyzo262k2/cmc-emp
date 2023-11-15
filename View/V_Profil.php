<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Css/jquery.min.js"></script>
    <script src="../Css/popper.min.js"></script>
    <script src="../Css/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .principale {
            margin: 20px;
        }

        .header {
            display: flex;
        }

        .change {
            display: flex;
        }

        .header .title {
            width: 85%;
            text-align: center;
        }

        .personnale {
            width: 50%;
            text-align: left;
        }

        .personnale h3 {
            text-align: center;
        }

        .etabliessement h3 {
            text-align: center;
        }

        .etabliessement {
            width: 50%;
            text-align: left;
        }

        .info {
            display: flex;

        }

        .form-group {
            margin-top: 10px;
        }

        .form-control {
            width: 90%;
        }

        .checkinput {
            display: flex;
        }

        .chek {
            width: 20px;
            margin-left: 5px;
        }

        .informations-sauvgarder {
            margin-top: 40px;
        }

        .sauvgarder {
            margin-right: 75px;
            margin-top:50px;
            text-align: right;
        }

        label {
            font-weight: 600;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        h3 {
            font-weight: 900;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color: gray;
        }

        .title {
            font-weight: 900;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        .tt {
            font-size: 12px;
            width: 150px;
            height: 50px;
            margin-left: 5px;
        }

        .popup {
            visibility: hidden;
            position: absolute;
            width: 380px;
            padding: 15px 25px;
            background: #fff;
            box-shadow: 2px 2px 7px 7px gray;
            border-radius: 10px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .popup .btnClose {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 15px;
            height: 15px;
            background: lightcoral;
            color: #eee;
            text-align: center;
            line-height: 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup .formulaire .h6 {
            text-align: center;
            color: #222;
            margin: 10px 0px 20px;
            font-size: 25px;
        }

        .popup .formulaire .form-input {
            margin: 15px 0px;
        }

        .popup .formulaire .form-input label {
            font-size: medium;
        }

        .title {

            margin-bottom: 25px;
            animation: slideInFromTop 1s ease-in-out;
        }

        h3 {
            font-size: 2em;
            color: blue;

        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .inR {
            background-color: aliceblue;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });

        function DisabledInput() {
            if (document.getElementById("chekmat").checked == true) {
                document.getElementById("mat").disabled = false
            } else {
                document.getElementById("mat").disabled = true
            }

            if (document.getElementById("chekcodeetab").checked == true) {
                document.getElementById("codeetab").disabled = false
            } else {
                document.getElementById("codeetab").disabled = true
            }
        }

        function verifierPassword() {
            let val0 = document.getElementById("passold").value;
            let val1 = document.getElementById("passnew1").value;
            let val2 = document.getElementById("passnew2").value;
            if (val0 != "" && val1 != "" && val2 != "" && val1 == val2)
                document.getElementById("btnmotpass").disabled = false
            else
                document.getElementById("btnmotpass").disabled = true
        }


        function AjouterAnnee(event) {
            var PopUp = document.getElementsByClassName('popup')[0];
            if (PopUp.style.visibility != "visible") {
                PopUp.style.top = 150 + "px";
                PopUp.style.left = 400 + "px";
                PopUp.style.visibility = "visible";
            } else {
                PopUp.style.visibility = "hidden";
            }
        }
    </script>
</head>

<body>
    <div class="principale">
        <div class="row header title">
            <div class="col-8 text-center">
                <h3>Profil</h3>
            </div>
            <div class="col-4 change">
                <a href="#addEmployeeModal" data-toggle="modal"><button class="tt btn btn-primary">Changer Mot de passe</button></a>
                <button onclick="AjouterAnnee(event)" class="tt btn btn-primary">Ajouter Année</button>
            </div>


        </div>


        <div class="informations-sauvgarder">
            <form action="" method="post">
                <div class="info">
                    <div class="personnale">

                        <!-- <h3>Information personnel</h3> -->
                        <input type="hidden" name="matold" value="<?php echo $user["Matricule"] ?>">

                        <div class="form-group">
                            <label for="mat">Matricule : </label>
                            <div class="checkinput">
                                <input type="text" name="mat" id="mat" value="<?php echo $user["Matricule"] ?>" readonly class="form-control inR">
                                <!-- <input type="checkbox" name="chekmat" id="chekmat" onchange="DisabledInput()" class="chek"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="poste">Poste : </label>
                            <input type="text" name="poste" value="<?php echo $user["Poste"] ?>" id="poste" readonly class="form-control inR">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom : </label>
                            <input type="text" name="prenom" value="<?php echo $user["Prenom"] ?>" id="prenom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom : </label>
                            <input type="text" name="nom" value="<?php echo $user["Nom"] ?>" id="nom" class="form-control">
                        </div>

                    </div>
                    <div class="etabliessement">
                        <!-- <h3>Information Etablissement</h3> -->

                        <input type="hidden" name="codeetabold" value="<?php echo $etab["CodeEtb"] ?>">
                        <div class="form-group">
                            <label for="codeetab">Code Etablissement : </label>
                            <div class="checkinput">
                                <input type="text" name="codeetab" value="<?php echo $etab["CodeEtb"] ?>" id="codeetab" readonly class="form-control ">
                                <!-- <input type="checkbox" name="chekcodeetab" id="chekcodeetab" onchange="DisabledInput()" class="chek"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descp">Description : </label>
                            <input type="text" name="descp" value="<?php echo $etab["DescpFr"] ?>" id="descp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville : </label>
                            <input type="text" name="ville" value="<?php echo $etab["Ville"] ?>" id="ville" class="form-control ">
                        </div>

                        <div class="form-group">
                            <label for="semanne">Semaine par Année : </label>
                            <input type="text" name="semanne" value="<?php echo $etab["Sem_Annee"] ?>" id="semanne" class="form-control ">
                        </div>

                    </div>
                </div>
                <div class="sauvgarder">
                    <input type="submit" name="sauvgarder" class="btn btn-primary" value="Sauvgarder">
                </div>


            </form>
        </div>

    </div>

    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Changer Mot de passe</h4>
                        <button type="button" class="close btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Mot de passe actuel : </label>
                            <input type="password" name="passold" id="passold" class="form-control" required onkeyup="verifierPassword()">
                        </div>
                        <div class="form-group">
                            <label>Nouveau mot de passe :</label>
                            <input type="password" name="passnew" id="passnew1" class="form-control" required onkeyup="verifierPassword()">
                        </div>
                        <div class="form-group">
                            <label>Retapez le nouveau mot de passe :</label>
                            <input type="password" id="passnew2" class="form-control" required onkeyup="verifierPassword()">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" name="change" id="btnmotpass" class="btn btn-primary" disabled value="Sauvgarder">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="popup">
        <div class="btnClose" onclick="AjouterAnnee(event)">&times;</div>
        <div class="formulaire">
            <form method="POST" action="../Controller/C_Profil.php">
                <h6>Voulez Vous Ajouter l'annee prochaine? (<?php
                                                            echo $PAnne;
                                                            ?>)</h6>
                <p class="text-success"><?= $mes ?></p>
                <div class="form-input">
                    <input type="checkbox" id="confirmer" required>
                    <label for="confirmer">Confirmer</label>
                </div>
                <div class="form-input">
                    <button type="submit" <?= $btn; ?> value="<?= $PAnne ?>" name="btnAjouterAnnee" class="btn btn-primary" id="btnAjouterAnnee">Ajouter</button>
                </div>
            </form>
        </div>
    </div>




    <!-- <div id="addSurveilleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter Surveille</h4>
                        <button type="button" class="close btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="matsur" id="mat" class="form-control" placeholder="Matricule" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nomsur" id="nom" class="form-control" placeholder="Nom" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="prenom" name="prenomsur" class="form-control" placeholder="Prénom" required>
                        </div>

                        <div class="form-group">
                            <input type="text" id="prenom" name="usersur" class="form-control" placeholder="Login" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="passnewsur1" id="passnew1" class="form-control" placeholder="Mot de passe " required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="passnewsur2" id="passnew2" class="form-control" placeholder="Retapez le mot de passe" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" name="AddSurveille" id="btnmotpass" class="btn btn-primary" value="Ajouter">
                    </div>
                </form>
            </div>
        </div>
    </div> -->



</body>

</html>