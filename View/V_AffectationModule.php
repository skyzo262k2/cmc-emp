<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Affectation Module</title>
    <script>
        function openF(form) {
            let tab = form.value.split("/");
            document.getElementById("info").innerHTML = " EFM à passer " + tab[2] + "<br> Module " + tab[3];
            document.getElementById("btnv").value = form.value;
            document.getElementById("efmF").style.display = 'block';
        }

        function Fermer(form) {
            document.getElementById("efmF").style.display = "none";
        }

        function FermerTrans(form) {
            document.getElementById("popup").style.display = "none";
        }

        function ChangeF(form) {
            let frm = ""
            if (typeof form === 'object') {
                frm = form.selectedOptions[0].value
            } else {
                frm = form
            }
            if (frm != "") {
                var request = new XMLHttpRequest();
                request.open("POST", `../Controller/C_affectationModule.php`, true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.onload = function() {
                    if (this.status == 200) {
                        document.getElementById('tbody').innerHTML = this.responseText
                        document.getElementById('name').innerHTML = `<span class='fw-bold'>Formateur : ${document.getElementById('frm').selectedOptions[0].innerText}</span>`
                        data()
                    }
                }
                request.send(`formateur=${frm}`);
            } else {
                document.getElementById('popup').style.display = 'none'
                document.getElementById('tbody').innerHTML = "<tr> <td colspan='12' class='text-center'><img src='../Images/nodata.jpg' alt='' /></td></tr>"
                document.getElementById('name').innerHTML = ""
                document.getElementById('ss1').innerText = " - "
                document.getElementById('ss2').innerText = " - "
                document.getElementById('mas').innerText = " - "
                document.getElementById('nbs').innerText = " - "
                document.getElementById('impri').innerHTML = " - "
                document.getElementById('avc').innerText = " - "
                document.getElementById('reste').innerHTML = " - "
            }
        }

        function ChangeG(grop) {
            let grp = ""

            if (typeof grop === 'object') {
                grp = grop.selectedOptions[0].value
            } else {
                grp = grop
            }

            if (grp != "") {

                var request = new XMLHttpRequest();
                request.open("POST", `../Controller/C_affectationModule.php`, true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.onload = function() {
                    if (this.status == 200) {
                        if (this.response != "false") {
                            document.getElementById('tbodyG').innerHTML = this.responseText;
                            document.getElementById('affe').innerHTML = `<form methode='post'><input type='button' onclick='Affecter()' value='Affecter' name='bntajt'></form>`;
                            document.getElementById('detail').open = true
                        } else {
                            document.getElementById('affe').innerHTML = ""
                            document.getElementById('tbodyG').innerHTML = ""
                            document.getElementById('detail').open = false

                        }
                    }
                }
                request.send(`groupe=${grp}`);
            } else {
                document.getElementById('tbodyG').innerHTML = "";
                document.getElementById('affe').innerHTML = "";
                document.getElementById('detail').open = false

            }
        }

        function Affecter() {
            let checked = document.querySelectorAll('#check')

            let Modules = []

            for (let index = 0; index < checked.length; index++) {
                let element = checked[index];

                if (element.checked)
                    Modules.push(checked[index].value)
            }

            let frm = document.getElementById('frm').selectedOptions[0].value
            let grp = document.getElementById('grp').value
            if (Modules.length != 0 && frm != "" && grp != "") {
                var request = new XMLHttpRequest();
                request.open("POST", `../Controller/C_affectationModule.php`, true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.onload = function() {
                    if (this.status == 200) {
                        console.log(this.response)
                        ChangeF(frm)
                        ChangeG(grp)
                    }
                }
                request.send(`format=${frm}&group=${grp}&Modules=${JSON.stringify(Modules)}&bntajt=''`);
            }
        }

        function SupprimerAffectation(sup) {
            // console.log(123456)
            let frm = document.getElementById('frm').selectedOptions[0].value
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_affectationModule.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    // console.log(this.response)
                    this.response == 0 && alert('il doit être supprimé de l\'utilisation du temps d\'abord')
                    ChangeF(frm)
                    let grp = document.getElementById('grp').value
                    if (grp !== "")
                        ChangeG(grp)
                }
            }
            request.send(`sup=${sup.value}`);
        }

        function TestTransfereModule(valider) {
            let frm = document.getElementById('frm').selectedOptions[0].value
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_affectationModule.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    if (this.response == 0) {
                        alert('il doit être supprimé de l\'utilisation du temps d\'abord')
                    } else {
                        document.getElementById('popup').style.display = 'block'
                        ChangeF(frm)
                    }
                }
            }
            request.send(`trans_test=${valider.value}`);
        }

        function TransfereModule() {
            let frm = document.getElementById('trans').selectedOptions[0].value
            let frmA = document.getElementById('frm').selectedOptions[0].value
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_affectationModule.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    if (this.response == true) {
                        document.getElementById('popup').style.display = 'none'
                        ChangeF(frmA)
                    }
                }
            }
            request.send(`form_trans=${frm}&valider_trans=''`);
        }

        function EfmPasser(btn) {
            let frm = document.getElementById('frm').selectedOptions[0].value
            let efm = document.getElementById('efmSe').selectedOptions[0].value
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_affectationModule.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    document.getElementById('efmF').style.display = 'none'
                    ChangeF(frm)
                }
            }
            request.send(`efm=${btn.value}&efmSe=${efm}`);
        }

        function Imprition(btn) {
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_affectationModule.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    //  console.log(this.response)   
                }
            }
            request.send(`${btn.name}=${btn.value}`);
        }

        function data() {
            document.getElementById('ss1').innerText = document.getElementById('s1').innerText
            document.getElementById('ss2').innerText = document.getElementById('s2').innerText
            document.getElementById('mas').innerText = document.getElementById('mass').innerText
            document.getElementById('nbs').innerText = document.getElementById('nbsemaine').innerText
            document.getElementById('impri').innerHTML = document.getElementById('imp').innerHTML
            document.getElementById('avc').innerHTML = document.getElementById('to_avc').innerHTML + "%"
            document.getElementById('reste').innerHTML = document.getElementById('resete').innerHTML
        }
    </script>
    <style>
        #col {
            font-size: larger;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: blue;
        }

        #popup,
        #efmF {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            display: none;
        }

        #fermer {
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

        /* #popup input[type="button"]:hover {
            background-color: #cc0000;
        } */

        #trans {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
        }

        #popup select,
        #efmF select {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 5px;
            width: 300px;
            margin-bottom: 10px;
            border-radius: 5px;
        }


        #trans {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
        }



        button[type='submit'],
        button[type='button'],
        input[type='submit'],
        input[type='button'] {
            background-color: blue;
            color: white;
            /* padding: 5px 8px; */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            /* height:max-content; */
        }

        h3 {
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

        button[name='sup'] {
            background-color: red;
            color: white;
            padding: 5px 8px;
            /* height:max-content; */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #flex {
            display: flex
        }

        #ch {
            border-collapse: collapse;
            width: 100%;
        }

        #ch thead tr {
            background-color: #f2f2f2;
        }

        #ch thead th {
            text-align: left;
            padding: 8px;
        }

        #ch thead td {
            text-align: left;
            padding: 8px;
        }

        input[type='checkbox'] {
            width: 20px;
            height: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
            float: left;
            margin-top: 6px;
            transition: background-color 0.3s ease-in-out;
        }

        input[type='checkbox']:checked {
            background-color: blue;
        }


        #ch select {
            /* width: 10%; */
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        b {
            color: blue;
            font-size: 18px;
            font-weight: bold;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        details {
            font-family: Arial, sans-serif;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        summary {
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 10px;
        }

        details[open] summary::before {
            content: '\25bc';
        }
    </style>
</head>

<body>
    <div id="popup">
        <input type="button" value="X" onclick="FermerTrans()" id="fermer">
        <center> <label for="trans"><b> choisir le formateur <br>à transformer le module</b></label></center><br>
        <select name="form_trans" id="trans">
            <option value=""></option>';
            <?php
            $i = 0;
            foreach ($Formateur as $Frm) {
                echo "<option value='" . $Frm['Matricule'] . "'>" . $Frm['Nom'] . ' ' . $Frm['Prenom'] . "</option>";
                $i++;
            }
            ?>
        </select>
        <input type="button" onclick="TransfereModule()" value="Valider" name="valider_trans">
    </div>

    <form id="efmF">
        <input type="button" value="X" onclick="Fermer()" id="fermer">
        <center> <label for="efm"><b id="info"></b></label></center><br>
        <select name="efmSe" id="efmSe">
            <option value="N">Non</option>
            <option value="O">Oui</option>
        </select>
        <button type="button" onclick="EfmPasser(this)" id="btnv" name="efm">Valider</button>
    </form>

    <?php if (!isset($_SESSION["userFormateur"])) : ?>
        <div class='container-fluid'>
            <div class="row m-3">
                <div class="col-3">
                    <h3>Affectations des modules</h3>
                </div>
                <div class="col-5">
                    <div class='d-flex'>
                        <span class='text-danger fw-bold m-2'>Exporter Tableau de service pour tous les formateurs : </span>
                        <a href="../Controller/C_Tableau_Service_All_Form.php"> <img src="../Images/pdf.png" style='width: 35px;height: 35px;' alt="not found"></a>
                        <form action="" method="post"><button style="background: none;border:none;" name="execl_tous"><img src="../Images/execl.jpeg" style='width: 35px;height: 35px;' alt="not found"></button></form>
                    </div>
                    <div class='d-flex'>
                        <span class='text-danger fw-bold m-2'>Taux d'avancement pour tout les fourmateurs : </span>
                        <form action="" method="post">
                            <button style="background: none;border:none;" name="execltaux">
                                <img src="../Images/execl.jpeg" style='width: 35px;height: 35px;' alt="not found">
                            </button>
                        </form>
                    </div>

                </div>

                <div class="col-4">
                    <div class='form-groupe'>
                        <label class='form-label fw-bold'>Choisir le Formateur :</label>
                        <select name="formateur" onchange="ChangeF(this)" id='frm' class='form-control'>
                            <option value="<?= $mat_F ?>"><?= $nom_F ?></option>
                            <?php
                            $i = 0;
                            foreach ($Formateur as $Frm) {
                                echo "<option value='" . $Frm['Matricule'] . "'>" . $Frm['Nom'] . ' ' . $Frm['Prenom'] . "</option>";
                                $i++;
                            }
                            ?>
                        </select>
                    </div>

                    <div class='form-groupe'>
                        <label class='form-label fw-bold'>Choisir le Groupe :</label>
                        <select name="groupe" onchange="ChangeG(this)" id='grp' class='form-control'>
                            <option value="<?= $grp ?>"><?= $grp ?></option>
                            <?php
                            foreach ($Groupes as $group) {
                                echo "<option value='" . $group['CodeGrp'] . "'>" . $group['CodeGrp'] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="">
                <form methode='post'>
                    <details id='detail'>
                        <summary>Modules n'est pas affecté</summary>
                        <div id="affe"></div>
                        <table id="tbl_Saisir" class='table table-bordered'>
                            <tr>
                                <th> Code Module</th>
                                <th>Description</th>
                                <th>code filière</th>
                                <th>Annee scolaire</th>
                                <th>Affecter </th>
                            </tr>
                            <tbody id='tbodyG'>


                            </tbody>

                        </table>
                    </details>
                    <div>

                        <p id='name'>
                            <span class='fw-bold'>Formateur :<?= $nom_F ?> </span>
                        </p>
                    <?php endif; ?>



                    <table id="tbl_Saisir" class='table table-bordered'>
                        <tr>
                            <th>table service</th>
                            <td class="text-center" id='impri' title="Imprimer"> - </td>
                            <th>S1</th>
                            <td class="text-center" id="ss1"> - </td>
                            <th>S2</th>
                            <td class="text-center" id="ss2"> - </td>
                            <th title="Masse Horaire">M.H</th>
                            <td class="text-center" id="mas" title="Masse Horaire"> - </td>
                            <th>nombre Par semaine</th>
                            <td class="text-center" id="nbs"> - </td>
                            <th>Taux Avancement</th>
                            <td class="text-center" id="avc"> - </td>
                            <th>Reste M.H</th>
                            <td class="text-center" id="reste"> - </td>
                        </tr>
                    </table>

                    <table id="tbl_Saisir" class='table table-bordered'>
                        <tr>
                            <th>Groupe</th>
                            <th>Description Module</th>
                            <th>Code Module</th>
                            <th>S1</th>
                            <th>S2</th>
                            <th>Filière</th>
                            <th>Annee scolaire</th>
                            <th>FPA</th>
                            <th>Avancement</th>
                            <th>Taux</th>
                            <th>EFM</th>
                            <th <?php if (isset($_SESSION["userFormateur"])) echo 'hidden' ?>>Action</th>
                        </tr>
                        <tbody id='tbody'>
                            <?php if (isset($_SESSION["userFormateur"])) :
                                echo $_SESSION["userFormateur"]["tableservice"]
                            ?>
                                <script>
                                    data()
                                </script>
                            <?php else : ?>

                                <tr>
                                    <td colspan="12" class='text-center'><img src='../Images/nodata.jpg' alt='' /></td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                    <br>
                    </div>
                </form>

            </div>
        </div>
</body>

</html>