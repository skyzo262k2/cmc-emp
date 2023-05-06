<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Consulter Absences Stagiaire</title>

    <style>
        .row {
            width: 99%;
        }

        .title {
            margin: 15px;
            text-align: center;
        }

        .title h4 {
            color: blue;
            /* font-size: 2em; */
            margin-bottom: 25px;
            animation: slideInFromTop 1s ease-in-out;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }



        #popup {
            min-height: 500px;
            max-height: 500px;
            background-color: aliceblue;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
            overflow: auto;
            z-index: 1;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 800px;
            display: none;
        }

        #popup input[type="button"] {
            background-color: #ff0000;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            float: right;
            cursor: pointer;
            margin-top: -15px;
            margin-right: -15px;
        }

        .info_stg {
            width: 100%;
            display: flex;
        }

        .info {
            /* width: 70%; */
            border-radius: 10px;
        }

        .form-groupe {
            margin: 5px;
            text-align: center;
        }

        .icon {
            width: 40px;
            border-radius: 50px;
        }

        .statistique {
            width: 190px;
            height: 100px;
            background-color: antiquewhite;
            box-shadow: 1px 1px 16px 1px #ccc;
            margin-left: 10px;
            padding: 20px;
            border-radius: 20px;
            text-align: center;
        }

        .statistique div span {
            /* margin: 5px; */
            font-size: 20px;
            font-weight: 700;
            padding-left: 20px;
        }

        .statistique .title {
            font-size: 18px;
            /* margin: 5px; */
            font-weight: 600;
        }

        #informations {
            margin: 10px 50px;
        }

        .nb_statistique {
            margin-top: 20px;
        }
    </style>




    <script>
        function Detail(val) {
            // alert(val)
            const dtdebut = document.getElementById("datedebut").value;
            const dtfin = document.getElementById("datefin").value;
            const stg = document.getElementById("stagiaire").value;
            const seance = document.getElementById("seance").value;
            const groupe = document.getElementById("groupe").value;
            const type = val;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_ConsulterAbsenceStagiaire.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`groupe=${groupe}&dtdebut=${dtdebut}&dtfin=${dtfin}&seance=${seance}&stg=${stg}&type=${type}`);
        }

        function ChangeGroupe() {
            document.getElementById("stagiaire").value = "choisir";
            ChangeDate();
        }



        function ChangeDate() {
            document.getElementById("informations").innerHTML = "";
            const dtdebut = document.getElementById("datedebut").value;
            const dtfin = document.getElementById("datefin").value;
            const seance = document.getElementById("seance").value;
            const groupe = document.getElementById("groupe").value;
            if (groupe != "choisir")
                var stg = document.getElementById("stagiaire").value;

            else {
                document.getElementById("stagiaire").value = "choisir";
                var stg = "choisir";
            }

            if (dtdebut != "" && dtfin != "") {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_ConsulterAbsenceStagiaire.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        console.log(this.responseText);
                        document.getElementById("statistique").innerHTML = this.responseText;
                    }
                };
                request.send(`groupe=${groupe}&dtdebut=${dtdebut}&dtfin=${dtfin}&seance=${seance}&stg=${stg}`);
            } else {
                document.getElementById("nbR").innerHTML = "0";
                document.getElementById("nbA").innerHTML = "0";

            }
        }
    </script>
</head>

<body>
    <div class="title">
        <h4>Consulter Absence Stagiaire</h4>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-groupe">
                <input type="date" name="datedebut" id="datedebut" class="form-control" value='<?php echo $datedebut ?>' onchange="ChangeDate()">
            </div>
        </div>
        <div class="col-3">
            <div class="form-groupe">

                <input type="date" name="datefin" id="datefin" class="form-control" value='<?php echo $sysdate ?>' onchange="ChangeDate()">
            </div>
        </div>
        <div class="col-3">
            <div class="form-groupe" id="groupe_select">
                <select name="groupe" id="groupe" class="form-control" onchange="ChangeGroupe()">
                    <option value="choisir">Choisir Groupe</option>
                    <?php

                    foreach ($groupes as $grp) {
                        echo "<option value='$grp[0]'>$grp[0]</option>";
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-groupe">
                <select name="seance" id="seance" class="form-control" onchange="ChangeDate()">
                    <option value="choisir">Choisir Seance</option>
                    <option value="1">8:30H - 11:00</option>
                    <option value="2">11:00H - 13:30</option>
                    <option value="3">13:30H - 16:00</option>
                    <option value="4">16:00H - 18:30</option>
                </select>
            </div>
        </div>
    </div>


    <div id="statistique">

        <div class='row m-2'>
            <div class="col-4"></div>
            <div class="col-4">
                <div class="form-groupe" id="stagiaire_select">
                    <select name="stagiaire" id="stagiaire" class="form-control" onchange="ChangeDate()">
                        <option value="choisir">Choisir stagiaire</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-4"></div>

        <div class='row nb_statistique'>
            <div class='col-4'></div>
            <div class='col-2 statistique'>

                <span class='title'>Absence</span>
                <div>
                    <span id="nbA"><?php echo $Absence[0]; ?></span><span onclick='Detail("A")'><img class='icon' src='../Images/Icon_Find.png' /></span>
                </div>
            </div>
            <div class='col-2 statistique'>
                <span class='title'>Retard</span>
                <div>
                    <span id="nbR"><?php echo $Retard[0]; ?></span><span onclick='Detail("R")'><img class='icon' src='../Images/Icon_Find.png' /></span>
                </div>
            </div>
            <div class='col-4'></div>
        </div>




    </div>

    <div id="informations">

        <?php if (isset($_SESSION["Admin"])) : ?>
            <div>
                <b>Absences Stagiaire : Top 10 </b>
            </div>
            <table class='table table-striped table-sm table-bordered'>
                <thead>
                    <tr>
                        <th>CEF</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Groupe</th>
                        <th>Discipline</th>
                        <th>Nombre Absence</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($TopAbsenceStagiaire as $stg) {
                        echo "<tr>";
                        echo "<td>$stg[0]</td>";
                        echo "<td>$stg[1]</td>";
                        echo "<td>$stg[2]</td>";
                        echo "<td>$stg[3]</td>";
                        echo "<td>$stg[4]</td>";
                        echo "<td>$stg[5]</td>";
                        echo "</tr>";
                    }



                    ?>
                </tbody>
            </table>

        <?php endif; ?>


    </div>




</body>

</html>