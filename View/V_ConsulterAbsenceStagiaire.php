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

        .nb_stat {
            font-size: 25px;
            font-weight: 700;
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
                    // console.log(this.responseText);
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
                        // console.log(this.responseText);
                        document.getElementById("statistique").innerHTML = this.responseText;
                    }
                };
                request.send(`groupe=${groupe}&dtdebut=${dtdebut}&dtfin=${dtfin}&seance=${seance}&stg=${stg}`);
            } else {
                document.getElementById("nbR").innerHTML = "0";
                document.getElementById("nbA").innerHTML = "0";
            }

            Detail("A")
        }
    </script>
</head>

<body>
    <div class="title">
        <h4>Consultation Absences des stagiaires</h4>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-groupe">
                <input type="date" name="datedebut" id="datedebut" class="form-control" value='<?= $datedebut ?>' onchange="ChangeDate()">
            </div>
        </div>
        <div class="col-3">
            <div class="form-groupe">
                <input type="date" name="datefin" id="datefin" class="form-control" value='<?= $sysdate ?>' onchange="ChangeDate()">
            </div>
        </div>
        <div class="col-3">
            <div class="form-groupe" id="groupe_select">
                <select name="groupe" id="groupe" class="form-control" onchange="ChangeGroupe()">
                    <option value="choisir">Choisir Groupe</option>
                    <?php
                    foreach ($groupes as $grp) {
                        echo "<option value='" . htmlspecialchars($grp[0]) . "'>" . htmlspecialchars($grp[0]) . "</option>";
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

        <div class="container">
            <div class='row mt-3 nb_statistique'>

                <div class='col-sm-6 statistique text-center  '>
                    <div class="alert alert-info">
                        <span class='h5 title'>Les absences : </span>
                        <span id="nbA" class='m-5  nb_stat'><?= htmlspecialchars($Absence[0]) ?></span>
                        <span onclick='Detail("A")'><img class='icon' src='../Images/Icon_Find.png' /></span>
                    </div>
                </div>
                <div class='col-sm-6 statistique text-center'>
                    <div class="alert alert-primary">
                        <span class='h5 title'>Les retards :</span>
                        <span id="nbR" class='m-5 nb_stat'><?= htmlspecialchars($Retard[0]) ?></span>
                        <span onclick='Detail("R")'><img class='icon' src='../Images/Icon_Find.png' /></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="informations" class='m-5'>

            <?php if (isset($_SESSION["Admin"])) : ?>
                <div>
                    <div class='h6 fw-bold text-decoration-underline text-primary'>Absences Stagiaire : Top 10 </div>
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
                        $top10 = [];
                        foreach ($TopAbsenceStagiaire as $stg) {

                            if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
                                if ($stg[6] == $_SESSION["Admin"]["secteur"]) {
                                    $top10[] = $stg;
                                }
                            } else {
                                $top10[] = $stg;
                            }
                        }
                        foreach ($top10 as $stg) {
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($stg[0])."</td>";
                            echo "<td>".htmlspecialchars($stg[1])."</td>";
                            echo "<td>".htmlspecialchars($stg[2])."</td>";
                            echo "<td>".htmlspecialchars($stg[3])."</td>";
                            echo "<td>".htmlspecialchars($stg[4])."</td>";
                            echo "<td>".htmlspecialchars($stg[5])."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

            <?php endif; ?>


        </div>
    </div>



</body>

</html>