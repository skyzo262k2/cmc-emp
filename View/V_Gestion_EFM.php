<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Gestion EFM</title>

    <style>
        .row {
            width: 99%;
        }

        .title {
            margin: 5px;
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

        .icon {
            width: 30px;
        }

        .buttonvalide {
            text-align: end;
        }

        th,
        td {
            text-align: center;
        }
        #remarque{
            width:270px
        }
        #pdf{
            width:110px
        }
    </style>


    <script>
        function ChangeGroupe(grp) {
            const groupe = grp.value;
            // alert(groupe);

            if (groupe != "choisir") {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_Gestion_EFM.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        console.log(this.responseText);
                        document.getElementById("CodeModule").innerHTML = this.responseText;
                    }
                };
                request.send(`groupe=${groupe}`);
            } else {
                document.getElementById("CodeModule").innerHTML = "<option value='choisir'>Choisir Code Module</option>";
            }

        }

        function Supprimer(id) {
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Gestion_EFM.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    console.log(this.responseText);
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`id=${id}`);
        }
    </script>
</head>

<body>


    <div class="title">
        <h4>Getion Examen Fin Module</h4>
    </div>
    <form enctype="multipart/form-data" action="" method="POST">
        <div class="row">
            <div class="col-2" style='padding-left:25px'>
                <div class="form-groupe">
                    <select name="Groupe" id="Groupe" class="form-control" onchange='ChangeGroupe(this)'>
                        <option value="choisir">Choisir Groupe</option>
                        <?php
                        foreach ($Groupes as $grp) {
                            echo "<option value='$grp[0]'>$grp[0]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-groupe">
                    <select name="CodeModule" id="CodeModule" class="form-control">
                        <option value="choisir">Choisir Code Module</option>

                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-groupe">
                    <input type="file" accept=".pdf" name="fileurl" class="form-control">
                </div>
            </div>
            <div class="col-3" style="padding-left:30px;padding-top:7px;font-size:13px">
                    <input type="radio" value="Synthèse" name="typeEFM" id='Synthèse'> <label for='Synthèse'>Synthèse</label> &nbsp;&nbsp;
                    <input type="radio" value="Pratique" name="typeEFM" id='Pratique'> <label for='Pratique'>Pratique</label>
            

            </div>

            <div class="col-1">
                <input type="submit" name="add" class="btn btn-info text-light" value="Ajouter">

            </div>

        </div>

    </form>

    <center>
        <p class='text-danger'><b><?php echo $message ?></b></p>
    </center>
    <div class='row'>
        <?php if (count($EFMS) != 0) : ?>
            <table class="table table-striped table-sm table-bordered m-3">
                <thead>
                    <tr class="table-success">
                        <th scope="col">Groupe</th>
                        <th scope="col">Description Module</th>
                        <th scope="col">Type EFM</th>
                        <th scope="col">Date Entrée</th>
                        <th scope="col">EFM </th>
                        <th scope="col">Date Valider</th>
                        <th scope="col">Remarque</th>
                        <th scope="col">Proposition de l’EFM</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id='informations'>
                    <?php

                    $efm->Showtable($EFMS);

                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>