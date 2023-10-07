<html>

<head>
    <meta charset="utf-8" />
    <title> Les stagiaires </title>
    <link rel="stylesheet" type="text/css" href="../Css/Bootstrap/css/bootstrap.css">
    <script src="../JS/ChatGraphique/jquery-3.2.1.slim.min.js"></script>


    <script src="../JS/ChatGraphique/popper.min.js"></script>

    <script src="../JS/ChatGraphique/Chart1.js"></script>
    <script src="../Css/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #F0F2F5;
        }

        .effectif {
            font-size: 16px;
            font-weight: bold;
        }

        .nbr {
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px;
        }

        .stat {
            text-align: center;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* font-size: 10px; */
            padding: 10px 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .stat1 {
            background-color: #122d5a;
            color: #fff;
        }

        .stat2 {
            background-color: #757474;
            color: #fff;
        }

        .stat3 {
            background-color: #5f512a;
            color: #fff;
        }



        /* canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        } */


        .grafique {
            margin-left: 200px;
            width: 450px;
        }

        .statistique {
            margin-top: 50px;
        }

        .col-6 {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row mt-3">

            <div class="col-7 "><canvas id="myChart" height="140"></canvas></div>

            <div class="col-5" style='text-align: center;'>
                <div class="green-panel pn">
                    <div class="green-header">
                        <h4  style='font-weight: bold; margin-bottom:25px;color:blueviolet'>Taux d'Avancement</h4>
                    </div>
                    <canvas id="serverstatus03" height="150" width="150"></canvas>
                    <script>
                        var doughnutData = [{
                                value: <?php echo number_format($TauxAvan[0], 2); ?>,
                                color: "#2b2b2b"
                            },
                            {
                                value: <?php echo 100 - number_format($TauxAvan[0], 2); ?>,
                                color: "#fffffd"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <h3 class='m-5' style='font-weight: bold;'><?php echo number_format($TauxAvan[0], 2); ?>%</h3>
                </div>
            </div>

        </div>
        <div class="row statistique">
            <div class="col-md-1"></div>

            <div class="col-md-2">
                <div class="stat stat1">
                    <div class="effectif">
                    Total des absences des formateurs
                        <div class="nbr"><?php echo $nbAbsenceFrm[0]; ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat2">
                    <div class="effectif">
                    Total des absences des stagiaires
                        <div class="nbr"><?php echo $nbAbsenceStg[0]; ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat3">
                    <div class="effectif">
                    Groupes n'ont pas terminé affectations
                        <div class="nbr"><?php echo $nbGrpNonAffecter[0]; ?></div>
                    </div>

                </div>
            </div>

            <div class="col-md-2">
                <div class="stat stat1">
                    <div class="effectif">
                    Les groupes ne sont pas un emploi
                        <div class="nbr"><?php echo $nbGrpNonEmploi[0]; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat2">
                    <div class="effectif">
                    Les formateurs n'ont aucune affectation
                        <div class="nbr"><?php echo $nbFrmNonAffectation[0]; ?></div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-2">
                <div class="stat stat2">
                    <div class="effectif">
                    Les groupes n'ont aucun stagiaire
                        <div class="nbr"><?php //echo $nbGrpSansStg[0]; ?> </div>
                    </div>
                </div>
            </div> -->

            <div class="col-md-2">
                <div class="stat stat1">
                    <div class="effectif">
                        Formateurs
                        <div class="nbr"><?php echo $nbfrm[0]; ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat2">
                    <div class="effectif">
                        Stagiaires
                        <div class="nbr"><?php echo $nbstg[0]; ?></div>
                    </div>

                </div>
            </div>



            <div class="col-md-2">
                <div class="stat stat3">
                    <div class="effectif">
                        Groupes
                        <div class="nbr"><?php echo $nbgrp[0]; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat1">
                    <div class="effectif">
                        Salles
                        <div class="nbr"><?php echo $nbsalle[0]; ?></div>
                    </div>

                </div>
            </div>


            <div class="col-md-2">
                <div class="stat stat2">
                    <div class="effectif">
                        Modules 1<sup>ére</sup> Année
                        <div class="nbr"><?php echo $nbmodule1[0]; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat stat3">
                    <div class="effectif">
                        Modules 2<sup>éme</sup> Année
                        <div class="nbr"><?php echo $nbmodule2[0]; ?></div>
                    </div>
                </div>
            </div>

        </div>


    </div>



</body>
<script src="../JS/ChatGraphique/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    function GetDashbord() {
        // Envoyer une requête AJAX pour récupérer les données depuis le fichier PHP
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../Controller/C_Dashboard.php?get=dashbord');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                myChart.data.labels = data.labels;
                myChart.data.datasets = data.datasets;
                myChart.update();
            }
        };
        xhr.send();
    }
    GetDashbord();
</script>

</html>