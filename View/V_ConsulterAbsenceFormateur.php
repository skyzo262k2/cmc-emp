<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Consulter Absences Formateur</title>

    <style>
        .row {
            width: 95%;
        }

        .title {
            text-align: center;
        }

        .title h3 {
            color: blue;
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
            width: 30px;
        }

        .col-4 {
            text-align: center;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .statistique {
            width: 220px;
            height: 80px;
            background-color: antiquewhite;
            box-shadow: 1px 1px 16px 1px #ccc;
            /* margin-left: 10px; */
            padding: 20px;
            border-radius: 20px;
            text-align: center;
        }

        .statistique div span {
            font-size: 20px;
            font-weight: 700;
        }

        .statistique .title {
            font-size: 15px;
            font-weight: 600;
        }
    </style>




    <script>
        function Detail(div) {
            const date1 = document.getElementById("date1").value;
            const date2 = document.getElementById("date2").value;
            const seance = document.getElementById("seance").value;
            const mat = div.children[1].textContent;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_ConsulterAbsenceFormateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("popup").innerHTML = this.responseText;
                }
            };
            request.send(`findmat=${mat}&date1=${date1}&date2=${date2}&seance=${seance}`);
            document.getElementById("popup").style.display = "block";
        }

        function Fermer() {
            document.getElementById("popup").style.display = "none"
        }

        function ChangeDate() {
            const date1 = document.getElementById("date1").value;
            const date2 = document.getElementById("date2").value;
            const seance = document.getElementById("seance").value;
            if (date1 == "" && date2 == "")
                document.getElementById("seance").value = "choisir"

            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_ConsulterAbsenceFormateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`date1=${date1}&date2=${date2}&seance=${seance}`);


        }
    </script>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-6">
                <div class="title">
                    <h3>Consultation Absences des Formateurs</h3>
                </div>
            </div>
            <div class="col-2">
                <input type="date" name="date1" id="date1" class='form-control' value="<?= $datedebut ?>" onchange="ChangeDate()">
            </div>
            <div class="col-2">
                <input type="date" name="date2" id="date2" class='form-control' value="<?= $sysdate ?>" onchange="ChangeDate()">
            </div>
            <div class="col-2">
                <select name="seance" id="seance" class='form-control' onchange="ChangeDate()">
                    <option value="choisir">Choisir Seance</option>
                    <option value="1">8:30H - 11:00</option>
                    <option value="2">11:00H - 13:30</option>
                    <option value="3">13:30H - 16:00</option>
                    <option value="4">16:00H - 18:30</option>
                </select>
            </div>
        </div>
    </div>


    <div id="informations" class='m-4'>
        <div class='row m-4 total'>
            <span class="h4 text-danger">Total Absences : <b><?= htmlspecialchars($nb[0]) ?></b></span>
        </div>
        <?php if (count($Formateur) != 0) : ?>
            <div class='table_info m-4'>
                <table class='table table-striped table-sm table-bordered'>
                    <thead>
                        <tr class='table-success'>
                            <th scope='col'>Matricule</th>
                            <th scope='col'>Nom</th>
                            <th scope='col'>Nombre Absence</th>
                            <th scope='col'>Action</th>
                        </tr>
                    </thead>
                    <tbody id="formateur_absence">

                        <?php

                        foreach ($Formateur as $form) {

                            echo "<tr>
                        <td>" . htmlspecialchars($form[0]) . "</td>
                        <td>" . htmlspecialchars($form[1]) . "</td>
                        <td>" . htmlspecialchars($form[2]) . "</td>
                        <td><div onclick='Detail(this)'><span><img class='icon' src='../Images/Icon_Find.png'/></span><span style='display:none;'>" . htmlspecialchars($form[0]) . "</span></div></td>
                        </tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>



    </div>




    <div id='popup' class='popup'>

    </div>
</body>

</html>