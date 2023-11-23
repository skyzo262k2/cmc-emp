<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <script>
        function GetGroupFormateur() {
            let urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('Matricule')) {
                let mat = urlParams.get('Matricule')
                mat = mat.split('/')[0]
                ajax.Ajax(`Matricule=${mat}`, (er, data) => {
                    console.log(data);

                    let groupes = JSON.parse(data);
                    console.log(groupes);
                    for (group of groupes) {
                        document.getElementsByName(group.Groupe)[0].checked = true;
                    }
                    document.getElementById('vld').click();
                })
            }
        }

        function Creation(tab) {

            let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            let rows = ''
            for (let index = 0; index < tab.length; index++) {
                rows += `<tr><th class='text-success'>${tab[index][0].CodeGrp}</th>`
                for (let indx = 0; indx < semaine.length; indx++) {
                    for (let id = 1; id < 5; id++) {
                        rows += `<td onclick="openF(this)" class='tdinf' id="${tab[index][0].CodeGrp}/${semaine[indx]}/${id}"></td>`
                    }
                }
                rows += `</tr>`
            }
            document.getElementById('data').innerHTML = rows
            for (let index = 0; index < tab.length; index++) {
                let len = Object.keys(tab[index][0])
                if (len.length > 1) {
                    for (let i = 0; i < tab[index].length; i++) {
                        let td = document.getElementById(`${tab[index][i].CodeGrp}/${tab[index][i].Jour}/${tab[index][i].Seance}`)
                        td.title = `${tab[index][i].nomF} \n${tab[index][i].descpMd}\n ${tab[index][i].CodeSl}\n${tab[index][i].TypeSc}`
                        td.innerHTML = `<span>${tab[index][i].nomF.slice(0,3)}</span><br>
                        <span class="popup">
                            <span>${tab[index][i].nomF}</span><span>${tab[index][i].TypeSc}</span>
                            <span>${tab[index][i].CodeSl}</span><span>${tab[index][i].descpMd}</span>
                            <span>${tab[index][i].CodeMd}</span><span>${tab[index][i].Matricule}</span>
                        </span>`
                    }
                }

            }

        }

        function openF(td) {
            document.getElementById("p").innerText = "";
            document.getElementById('meme').style.display = 'none'
            document.getElementById("hidd").value = td.id
            let spl = td.id.split("/")
            let grp = spl[0]
            let jour = spl[1]
            let seance = spl[2]
            document.getElementById('grp').value = grp
            document.getElementById('jour').value = jour
            document.getElementById('seance').value = seance
            if (document.getElementById("Form").length > 1) {
                let t = document.getElementById("Form")
                t.innerHTML = "";
            }
            if (td.innerHTML == "") {
                // document.getElementById("Form").children[0].value = ""
                // document.getElementById("Form").children[0].innerText = ""
                document.getElementById("type").children[0].innerText = ""
                document.getElementById("type").children[0].value = ""
                document.getElementById("sal").children[0].innerText = ""
                document.getElementById("sal").children[0].value = ""

                document.getElementById('Form').selectedIndex = -1
                document.getElementById("type").selectedIndex = -1
                document.getElementById("sal").selectedIndex = -1

                document.getElementById('Form').innerHTML = "<option value=''></option>"
                formateur[grp].forEach(frm => {
                    let option = document.createElement('option')
                    option.value = frm.Matricule + "/" + frm.NomPr + "/" + frm.CodeMd + "/" + frm.DescpMd
                    option.innerText = frm.NomPr + " : " + frm.DescpMd
                    option.id = grp
                    document.getElementById('Form').appendChild(option)
                });

                document.getElementById('type').disabled = true
                document.getElementById('sal').disabled = true
                document.getElementById('ajouter').style.display = "block"
                document.getElementById('supprimer').style.display = "none"

            } else {
                document.getElementById('sup_frm').value = td.children[2].children[0].innerHTML
                document.getElementById('frm_hid').value = td.children[2].children[5].innerHTML
                document.getElementById('sup_typsc').value = td.children[2].children[1].innerHTML

                document.getElementById('sup_sal').innerHTML = "<option value=''></option>"
                document.getElementById('sup_sal').selectedOptions[0].value = td.children[2].children[2].innerHTML
                document.getElementById('sup_sal').selectedOptions[0].innerText = td.children[2].children[2].innerHTML

                document.getElementById('sup_mdl').innerHTML = ""

                GetModuleaFormateur_Mod(td.children[2].children[4].innerHTML)

                document.getElementById('supprimer').style.display = "block"
                document.getElementById('ajouter').style.display = "none"
            }
            document.getElementById("popup").style.display = "block"

        }



        function Fermer() {
            document.getElementById("popup").style.display = "none"
        }

        function CreationSalles(salles) {
            document.getElementById('sal').innerHTML = ""
            document.getElementById('sal').innerHTML = "<option value=''></option>"

            salles.forEach(sal => {
                let option = document.createElement('option')
                option.value = `${sal.codesl}/${sal.DescpSl}`
                option.innerText = sal.DescpSl
                document.getElementById('sal').appendChild(option)
            });

        }

        function CreationMemegroupe(data) {
            let group = document.getElementById('grp').value
            document.getElementById('sal').disabled = false
            let memes = ''
            data.forEach(grp => {
                if (grp.Groupe != group) {
                    memes += `<input type='checkbox' id='checkM' name='${grp.Groupe}' value='${grp.Groupe}'/>:${grp.Groupe}<br/>`
                }
            })
            document.getElementById('meme').innerHTML = memes
            document.getElementById('meme').style.display = 'block'
        }

        function CreationPourModifier(data, mdl) {
            let sals = ""
            data.salles.forEach(sal => {
                sals += `<option value='${sal.codesl}'>${sal.DescpSl}</option>`
            })

            let mods = ""
            let sel = ""
            data.modules.forEach(mod => {
                sel = mdl == mod.CodeMd ? 'selected' : ''
                mods += `<option value='${mod.CodeMd}' ${sel}>${mod.DescpMd}</option>`
            })

            document.getElementById('sup_sal').innerHTML += sals
            document.getElementById('sup_mdl').innerHTML = mods

        }
    </script>
    <script src="../Js/Emploi.js"></script>
    <script>
        const ajax = new EmploiAjax('../Controller/C_Emploi_Groupes.php');
        var formateur;

        function EmploiGroupes() {
            let relaod = document.getElementById('relaod')
            relaod.hidden = true
            let checked = document.querySelectorAll('#check')
            let groupes = []
            for (let index = 0; index < checked.length; index++) {
                let element = checked[index];
                if (element.checked)
                    groupes.push(checked[index].value)
            }

            if (groupes.length > 0) {

                relaod.hidden = false
                ajax.Ajax(`Valider=''&groupes=${JSON.stringify(groupes)}`, (er, data) => {
                    if (er == null) {
                        let table = JSON.parse(data)
                        formateur = table['formateur']
                        Creation(table['group'])
                        document.getElementById('detail').open = false
                    }
                })
            }
        }

        function FormateurC(e) {
            let frm = e.selectedOptions[0].value
            if (frm != '') {
                let jour = document.getElementById('jour').value
                let seance = document.getElementById('seance').value
                ajax.Ajax(`frm=${frm}&jour=${jour}&seance=${seance}`, (er, data) => {
                    if (er == null) {
                        data = JSON.parse(data)
                        if ("salles" in data) {
                            document.getElementById("p").innerText = ''
                            CreationSalles(data.salles)
                            document.getElementById('type').disabled = false
                        } else {
                            document.getElementById('type').disabled = true
                            let nomfrm = data.occuper[data.occuper.length - 1]
                            data.occuper.pop()
                            let groupes = data.occuper.map(grp => grp.CodeGrp)
                            document.getElementById("p").innerText = `
                            Formateur ${nomfrm} est occupé pendant ce cours avec le groupe
                            ${groupes.join(' - ')} `;
                        }
                    }
                })
            } else {
                document.getElementById("p").innerText = ''
                document.getElementById("type").disabled = true
            }
        }

        function TypeSeance(e) {
            let typsceance = e.selectedOptions[0].value
            if (typsceance == 'Distance') {
                let frm = document.getElementById('Form').selectedOptions[0].value
                let jour = document.getElementById('jour').value
                let seance = document.getElementById('seance').value
                ajax.Ajax(`typesc=${typsceance}&form=${frm}&jour=${jour}&seance=${seance}`, (er, data) => {
                    if (er == null) {
                        data = JSON.parse(data)
                        CreationMemegroupe(data)
                    }
                })
            }
            if (typsceance == 'Présentiel') {
                document.getElementById('sal').disabled = false
                document.getElementById('meme').innerHTML = ""
            }
            if (typsceance == '') {
                document.getElementById('sal').disabled = true
                document.getElementById('meme').innerHTML = ""
            }
        }

        function Ajouter() {
            let group = document.getElementById('grp').value
            let salle = document.getElementById('sal').selectedOptions[0].value
            let frm = document.getElementById('Form').selectedOptions[0].value
            let type = document.getElementById('type').selectedOptions[0].value
            let jour = document.getElementById('jour').value
            let seance = document.getElementById('seance').value
            if (group != "" && salle != "" && frm != "" && type != "") {
                let send = `type=${type}&form=${frm}&grp=${group}&salle=${salle}&ajt=''
                        &jour=${jour}&seance=${seance}`
                if (type == 'Distance') {
                    let checked = document.querySelectorAll('#checkM')
                    let groupes = []
                    groupes.push(group)
                    for (let index = 0; index < checked.length; index++) {
                        let element = checked[index];
                        if (element.checked)
                            groupes.push(checked[index].value)
                    }
                    send += `&groupes=${JSON.stringify(groupes)}`
                }
                ajax.Ajax(send, (er, data) => {
                    EmploiGroupes()
                    document.getElementById('fermer').click()
                })
            }
        }

        function Supprimer() {
            let group = document.getElementById('grp').value
            let jour = document.getElementById('jour').value
            let seance = document.getElementById('seance').value
            if (group != "") {
                ajax.Ajax(`grp=${group}&sup=''
                    &jour=${jour}&seance=${seance}`, (er, data) => {
                    EmploiGroupes()
                    document.getElementById('fermer').click()
                })
            }
        }

        function GetModuleaFormateur_Mod(mdl) {

            let group = document.getElementById('grp').value
            let jour = document.getElementById('jour').value
            let seance = document.getElementById('seance').value
            let mat = document.getElementById('frm_hid').value
            if (group != "") {
                ajax.Ajax(`grop=${group}&jour=${jour}&seance=${seance}&mat=${mat}&ModuleGrpFormateur=''`, (er, data) => {
                    let table = JSON.parse(data)
                    CreationPourModifier(table, mdl)
                })
            }
        }

        function Modifier() {

            let group = document.getElementById('grp').value
            let jour = document.getElementById('jour').value
            let seance = document.getElementById('seance').value
            let mdlM = document.getElementById('sup_mdl').selectedOptions[0].value
            let salM = document.getElementById('sup_sal').selectedOptions[0].value
            let mat = document.getElementById('frm_hid').value
            if (group != "" && mdlM != "" && salM != "") {

                ajax.Ajax(`mat=${mat}&grop=${group}&jour=${jour}&seance=${seance}&mdl=${mdlM}&sal=${salM}&ModifierModuleGrpFormateur=''`,
                    (er, data) => {
                        let ver = JSON.parse(data)
                        if (ver.length > 0) {
                            alert('vous ne pouvez pas modifier car il a d`\'autre groupe a distance avec ce formateur au même sceance')
                        } else {
                            EmploiGroupes()

                        }
                        document.getElementById('fermer').click()
                    })
            }
        }

        function Utiliser() {
            ajax.Ajax(`utl=''`, (er, data) => {})
        }

        GetGroupFormateur();
    </script>
    <style>
        input[type="button"],
        #relaod,
        input[type="reset"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transform: translateY(4px);
            transition: all 0.2s ease-in-out;
        }

        center h3 {
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

        input[type="button"]:active,
        input[type="reset"]:active,
        #relaod:active {
            transform: translateY(0px);
            box-shadow: none;
        }

        body {
            overflow-y: scroll;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            width: 100%;
        }

        #table td {
            width: 30px;
            overflow: hidden;
            white-space: nowrap;
        }

        #span {
            display: none;
        }

        .td:hover #span {
            display: block;
            background-color: cadetblue;
            border: 2px solid black;
        }


        #popup {
            display: none;
            width: 600px;
            height: 500px;
            position: fixed;
            top: 10%;
            left: 30%;
            background-color: white;
            border: 1px solid black;
            overflow: hidden;
            /* box-sizing: border-box; */
        }

        #popup #fermer {
            background-color: none;
            border: none;
            position: absolute;
            top: 13px;
            left: 95%;
        }

        #fermer:hover {
            color: white;
            background-color: red;
        }

        .inputs {
            width: 175px;
            height: 30px;
        }

        label {
            font-size: large;
        }

        .popup {
            display: none;
        }

        #inp input {
            width: 50px;
        }

        #meme {
            width: 300px;
            height: 100px;
            overflow-y: scroll;
            scrollbar-color: rebeccapurple green;
            scrollbar-width: thin;
        }

        .container {
            width: max-content;
            height: 400px;
            overflow-y: scroll;
            scrollbar-color: rebeccapurple green;
            scrollbar-width: thin;
            justify-content: center;
        }

        #popup {
            background-color: #f5f5f5;
            /* padding: 20px; */
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
            overflow: auto;
            z-index: 1;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* width: 600px; */
            display: none;
            height: 550px;
        }

        #popup #fermer {
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

        #popup #fermer:hover {
            background-color: #cc0000;
        }

        #popup #inp {
            margin-top: 30px;
        }

        #popup #inp label {
            font-weight: bold;
            margin-right: 10px;
            display: inline-block;
            width: 100px;
        }

        #popup input[type="text"],
        #popup select {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 5px;
            width: 300px;
            margin-bottom: 10px;
            border-radius: 5px;
        }


        #popup #supprimer {
            margin-top: 30px;
            display: none;
        }

        #popup #ajouter {
            margin-top: 30px;
        }

        #popup #ajouter h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        #popup #ajouter label {
            font-weight: bold;
            margin-right: 10px;
            display: inline-block;
            width: 100px;
        }

        #popup #ajouter input[type='button'] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transform: translateY(4px);
            transition: all 0.2s ease-in-out;
        }

        #popup #ajouter input[type="button"]:active {
            transform: translateY(0px);
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="m-3">
            <center>
                <h3>Emploi Brouillon Large</h3>
            </center>
        </div>
        <form action="" method="post">
            <details id="detail" class="border p-2">
                <summary>Groupes</summary>
                <center>
                    <div class="">
                        <table border="1" class="table table-bordered">
                            <?php
                            $i = 0;
                            foreach ($_SESSION['groupes'] as $grp) {

                                if ($i == 9) echo "<tr>";
                                echo "<td>
                    <input type='checkbox' id='check'  name='" . $grp['CodeGrp'] . "'  value='" . $grp['CodeGrp'] . "'></td>
                    <td>" . $grp['CodeGrp'] . "</td>";
                                $i++;
                                if ($i == 9) {
                                    echo "</tr>";
                                    $i = 0;
                                };
                            }
                            ?>
                        </table>
                    </div>
                    <input type="button" onclick="EmploiGroupes()" id="vld" name="Valider" value="Valider">
                    <input type="reset" value="reset" />
                </center>
            </details>
        </form>

        <form action="" method="post">
            <div class="text-end">
                <input type="button" onclick="Utiliser()" value='Utiliser' name='utl'>
                <button onclick="EmploiGroupes()" id="relaod" hidden type="button">
                    reload
                </button>
            </div>
            <table border="1" id="table" class="table table-bordered">
                <tr>
                    <th width="10%">Jour</th>
                    <th id='td' colspan="4">Lundi</th>
                    <th id='td' colspan="4">Mardi</th>
                    <th id='td' colspan="4">Mercredi</th>
                    <th id='td' colspan="4">Jeudi</th>
                    <th id='td' colspan="4">Vendredi</th>
                    <th id='td' colspan="4">Samedi</th>
                </tr>
                <tr>
                    <th>Séance<br />Groupes</th>
                    <script>
                        for (let index = 0; index < 6; index++) {
                            for (let index = 1; index < 5; index++) {
                                document.write(`<th>${index}</th>`)
                            }
                        }
                    </script>
                </tr>
                <tbody id="data">

                </tbody>
            </table>

            <div id="popup">
                <center>
                    <input type="button" value="X" onclick="Fermer()" id='fermer'>
                    <input type="hidden" value="<?= $hidden ?>" id="hidd" name="hidden">
                    <input type="hidden" value="" id="frm_hid" name="hidden">
                    <div id="inp">
                        <label>Groupe:</label>
                        <input type="text" readonly value="<?= $grop ?>" name="grp" id="grp"><br>
                        <label>Jour :</label>
                        <input type="text" readonly value="<?= $jour ?>" name="jour" id="jour"><br>
                        <label>Seance :</label>
                        <input type="text" readonly value="<?= $seance ?>" name="seance" id="seance">
                        <p id="p" style="color:red;">

                        </p>
                    </div>
                    <div id="supprimer" <?= $hiddensup ?> class="m-3">

                        <div id="inp">
                            <p class='d-flex'><span class="fw-bold w-25  p-2 text-end"  width='120px'>Formateur : </span> <input type="text" class="w-75" readonly id="sup_frm" name="sup_frm"></p>
                            <p class='d-flex'><span class="fw-bold w-25  p-2 text-end" width='120px'>Type Seance : </span><input type="text" class="w-75" readonly id="sup_typsc" name="sup_typsc"></p>
                            <p class='d-flex'>
                                <span class="fw-bold  w-25 text-end p-2">Salle : </span>
                                <!-- <input type="text" readonly id="sup_sal" name="sup_sal"> -->
                                <select name="sup_sal" id="sup_sal" class="w-75">
                                    <option value=""></option>
                                </select>
                            </p>
                            <p class='d-flex'>
                                <span class="fw-bold w-25 text-end p-2">Module : </span>
                                <!-- <input type="text" readonly id="sup_mdl" name="sup_mdl"><br><br> -->
                                <select name="sup_mdl" id="sup_mdl" class="w-75">
                                    <option value=""></option>
                                </select>
                            </p>
                        </div>
                        <input type="button" onclick="Supprimer()" value="supprimer" id="sup" name="sup">
                        <input type="button" onclick="Modifier()" value="Modifier" name="mod">

                    </div>
                    <div id="ajouter">
                        <div id="inp">
                            <label for="Form" width="w-100"><span class="fw-bold">Formateur: </span></label>
                            <select class="inputs" name="frm" onchange="FormateurC(this)" id="Form">
                                <option value="<?php if (isset($mat)) echo $mat . '/' . $nomp; ?>"><?php if (isset($nomp)) echo $nomp; ?></option>
                                <!-- Remplit par un script js -->
                            </select></br>
                            <label for="type" width="w-100"><span class="fw-bold">Type : </span></label>
                            <select class="inputs" name="typesc" <?= $blocktype ?> onchange="TypeSeance(this)" id="type">
                                <option value="<?php if (isset($types)) echo $types; ?>"><?php if (isset($types)) echo $types; ?></option>
                                <option value="Présentiel">Présentiel</option>
                                <option value="Distance">Distance</option>
                            </select></br>
                            <div class="salles">
                                <label for="sal" width="w-100"><span class="fw-bold">Salle: </span></label>
                                <select class="inputs" name="salle" <?= $blocksalle ?> id="sal">
                                    <option value=""></option>
                                </select>

                                <div id="meme">

                                </div>
                            </div>

                        </div>
                        <br><br>
                        <input type="button" onclick="Ajouter()" value="Ajouter" id='ajt' name="ajt">
                    </div>
                </center>
            </div>
        </form>

    </div>
</body>

</html>