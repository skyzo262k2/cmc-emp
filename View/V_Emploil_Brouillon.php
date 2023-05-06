<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function Saisir(table) {
            CreationRows()
            for (let index = 0; index < table.length; index++) {
                let content = document.getElementById(`${table[index].Jour}/${table[index].Seance}`)
                if (content.innerText == '') {
                    content.title = `${table[index].Matricule} \n ${table[index].CodeMd }`
                    content.innerHTML =
                        '<span>' +
                        table[index].nomF +
                        '</span><br><span>' +
                        table[index].descpMd +
                        '</span><br><span>' +
                        table[index].CodeSl +
                        '</span> / <span>' +
                        table[index].TypeSc + '</span><span id="span"><span hidden>' +
                        table[index].Matricule + '</span><span hidden>' + table[index].CodeMd + '</span></span>'
                } else {
                    content.innerHTML += '<br>' + table[index].CodeGrp
                }
            }
        }

        function openF(td) {
            if (document.getElementById('grp').value != "") {
                document.getElementById("p").innerText = "";
                document.getElementById('meme').style.display = 'none'
                let spl = td.id.split("/")
                let jour = spl[0]
                let seance = spl[1]
                document.getElementById('jour').value = jour
                document.getElementById('seance').value = seance

                document.getElementById('Form').selectedIndex = -1
                document.getElementById("type").selectedIndex = -1
                document.getElementById("sal").selectedIndex = -1

                if (td.innerHTML == "") {
                    document.getElementById("type").disabled = true
                    document.getElementById("sal").disabled = true
                    document.getElementById('supprimer').hidden = true

                    document.getElementById('ajouter').style.display = "block"
                    document.getElementById('supprimer').style.display = "none"

                } else {

                    document.getElementById('sup_frm').value = td.children[0].innerHTML
                    document.getElementById('frm_hid').value = td.children[6].children[0].innerHTML
                    document.getElementById('sup_typsc').value = td.children[5].innerHTML

                    document.getElementById('sup_sal').innerHTML = "<option value=''></option>"
                    document.getElementById('sup_sal').selectedOptions[0].value = td.children[4].innerHTML
                    document.getElementById('sup_sal').selectedOptions[0].innerText = td.children[4].innerHTML

                    document.getElementById('sup_mdl').innerHTML = ""



                    GetModuleaFormateur_Mod(td.children[6].children[1].innerHTML)
                    document.getElementById('supprimer').style.display = "block"
                    document.getElementById('ajouter').style.display = "none"

                }
                document.getElementById("popup").style.display = "block"

            }
        }



        function Fermer() {
            document.getElementById("meme").innerHTML = ""
            // document.getElementById("Form").innerHTML = ""
            // document.getElementById("type").innerHTML = ""
            document.getElementById("sal").innerHTML = ""
            document.getElementById("popup").style.display = "none"
        }

        function CreationRows() {
            let rows = ""
            let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            semaine.forEach(element => {
                rows += `<tr style="height: 60px;"><td>${element}</td>`;
                for (let index = 1; index < 5; index++) {
                    rows += `<td onclick="openF(this)" class='td' id='${element}/${index}'></td>`;
                }
                rows += `</tr>`;
            });
            document.getElementById('rows').innerHTML = rows
        }

        function CreationFormateur(formateur) {
            document.getElementById('Form').innerHTML = ""
            document.getElementById('Form').innerHTML = "<option value=''></option>"
            formateur.forEach(frm => {
                let option = document.createElement('option')
                option.value = frm.Matricule + "/" + frm.NomPr + "/" + frm.CodeMd + "/" + frm.DescpMd
                option.innerText = frm.NomPr + " : " + frm.DescpMd
                option.id = grp
                document.getElementById('Form').appendChild(option)
            });
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
                    memes += `<input type='checkbox' id='check' name='${grp.Groupe}' value='${grp.Groupe}'/>:${grp.Groupe}<br/>`
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
</head>

<style>
    center {
        text-align: center;
    }

    h1 {
        color: blue;
        font-size: 2em;
        margin-bottom: 25px;
    }

    form {
        width: 100%;
        margin: 0 auto;
    }

    input[type="button"],
    #ajt {
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

    input[type="button"]:active {
        transform: translateY(0px);
        box-shadow: none;
    }

    #grp {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid gray;
        font-size: 1em;
        color: #555;
        background-color: #fff;
        margin-bottom: 20px;
    }

    #grp:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }


    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        table-layout: fixed;
    }

    @media only screen and (min-width: 600px) {
        table {
            width: 100%;
        }
    }

    td {
        border: 1px solid black;
        padding: 10px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table td:hover {
        background-color: #f5f5f5;
    }

    center h1 {
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
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #ccc;
        overflow: auto;
        z-index: 1;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 500Px;
        display: none;
        animation: fadeIn 0.5s ease-in;

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
        width: max-content;
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

    #meme {
        width: 300px;
        height: 100px;
        overflow-y: scroll;
        scrollbar-color: rebeccapurple green;
        scrollbar-width: thin;
        margin-left: 180px;
    }

    #popup #ajouter select {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        width: 150px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<script src="../Js/Emploi.js"></script>

<script>
    const ajax = new EmploiAjax('../Controller/C_Emploil_Brouillon.php');

    function EmploiGroupe() {
        let grp = document.getElementById('grp').selectedOptions[0].value
        if (grp != "") {
            ajax.Ajax(`group=${grp}`, (er, data) => {
                if (er == null) {
                    let table = JSON.parse(data)
                    CreationFormateur(table.formateur)
                    Saisir(table.group)
                }
            })
        } else {
            CreationRows()
            document.getElementById('Form').innerHTML = ""
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
        let group = document.getElementById('grp').selectedOptions[0].value
        let salle = document.getElementById('sal').selectedOptions[0].value
        let frm = document.getElementById('Form').selectedOptions[0].value
        let type = document.getElementById('type').selectedOptions[0].value
        let jour = document.getElementById('jour').value
        let seance = document.getElementById('seance').value
        if (group != "" && salle != "" && frm != "" && type != "") {
            let send = `type=${type}&form=${frm}&grp=${group}&salle=${salle}&ajt=''
                        &jour=${jour}&seance=${seance}`

            if (type == 'Distance') {
                let checked = document.querySelectorAll('#check')
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
                EmploiGroupe()
                document.getElementById('fermer').click()
            })
        }
    }

    function Supprimer() {

        let group = document.getElementById('grp').selectedOptions[0].value
        let jour = document.getElementById('jour').value
        let seance = document.getElementById('seance').value
        if (group != "") {
            ajax.Ajax(`grp=${group}&sup=''
                       &jour=${jour}&seance=${seance}`, (er, data) => {
                EmploiGroupe()
                document.getElementById('fermer').click()
            })
        }
    }

    function GetModuleaFormateur_Mod(mdl) {

        let group = document.getElementById('grp').selectedOptions[0].value
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

        let group = document.getElementById('grp').selectedOptions[0].value
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
                        EmploiGroupe()

                    }
                    document.getElementById('fermer').click()
                })
        }
    }

    function Utiliser() {

        ajax.Ajax(`utl=''`, (er, data) => {})
    }
</script>

<body>
    <center>
        <h1>Emploi Brouillon</h1>
    </center>

    <form action="" method="post">
        <input type="hidden" name="frm_hid" id="frm_hid">
        <input type="button" onclick="Utiliser()" value="utiliser" name="utl">
        <table>
            <tr>
                <td style="text-align: center;font-size: larger;">Groupes</td>
                <td>
                    <select name="group" onchange="EmploiGroupe()" id="grp">
                        <option value="<?php if (isset($grp)) echo $grp; ?>"><?php if (isset($grp)) echo $grp; ?></option>
                        <?php
                        if (isset($Groupes)) :
                            foreach ($Groupes as $inf) {
                                echo "<option value='" . $inf['CodeGrp'] . "'>" . $inf['CodeGrp'] . "</option>";
                            }
                        endif;
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="1" id="table">
            <tr style="height: 60px;">
                <td>Heures<br>Jours</td>
                <td>8H30-11H00</td>
                <td>11H00-13H30</td>
                <td>13H30-16H00</td>
                <td>16H00-18H30</td>
            </tr>
            <tbody id='rows'>
                <script>
                    CreationRows()
                </script>
            </tbody>
        </table>
        <div id="popup" class="popup">
            <center>
                <input type="button" value="X" onclick="Fermer()" id='fermer'>
                <div id="inp">
                    <label>Jour :</label>
                    <input type="text" readonly value="<?= $jour ?>" name="jour" id="jour"><br><br>
                    <label>Seance :</label>
                    <input type="text" readonly value="<?= $seance ?>" name="seance" id="seance">
                    <p id="p" style="color:red;">
                        <!-- par script js -->
                    </p>
                </div>
                <div id="supprimer" <?= $hiddensup ?>>

                    <p><strong>Formateur :</strong></p> <input type="text" readonly id="sup_frm" name="sup_frm">
                    <p><strong>Type Seance :</strong></p> <input type="text" readonly id="sup_typsc" name="sup_typsc">
                    <p><strong>Salle :</strong></p>
                    <!-- <input type="text" readonly id="sup_sal" name="sup_sal"> -->
                    <select name="sup_sal" id="sup_sal">
                        <option value=""></option>
                    </select>
                    <p><strong>Module :</strong></p>
                    <!-- <input type="text" readonly id="sup_mdl" name="sup_mdl"><br><br> -->
                    <select name="sup_mdl" id="sup_mdl">
                        <option value=""></option>
                    </select>
                    <br><br>
                    <input type="button" onclick="Supprimer()" value="supprimer" name="sup">
                    <input type="button" onclick="Modifier()" value="Modifier" name="mod">

                </div>

                <div id="ajouter">
                    <h2>Ajouter leçon</h2>
                    <label for="Form"><strong>Formateur :</strong></label><br>
                    <select class="inputs" name="frm" onchange="FormateurC(this)" id="Form">
                        <option value=""></option>
                        <!-- Remplit par un script js -->
                    </select>

                    <br>

                    <label for="type"><strong>Type Séance :</strong></label><br>
                    <select class="inputs" name="typesc" <?= $blocktype ?> onchange="TypeSeance(this)" id="type">
                        <option value=""></option>
                        <option value="Présentiel">Présentiel</option>
                        <option value="Distance">Distance</option>
                    </select>
                    <br>
                    <div class="salles">
                        <label for="sal"><strong>Salle :</strong></label><br>
                        <select class="inputs" name="salle" <?= $blocksalle; ?> id="sal">
                            <option value=""></option>
                            <!-- par script js -->
                        </select>
                    </div>
                    <br>

                    <div id="meme">
                        <!-- par script js -->
                    </div>

                    <input type="button" onclick="Ajouter()" value="Ajouter" name="ajt" id='ajt'>
                </div>
                <br><br>
            </center>
        </div>
    </form>
</body>

</html>