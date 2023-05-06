<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Js/Emploi.js"></script>
    <title>Gestion EFM</title>
    <style>
        #valider {
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #valider:hover {
            background-color: #0069d9;
        }

        #check {
            width: 20px;
            height: 20px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        #check:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

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
  
        /* Styles pour le tableau */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Styles pour les boutons radio */
        input[type=radio] {
            transform: scale(1.5);
            margin: 0 5px;
        }

        label {
            display: flex;
            align-items: center;
        }

        /* Styles pour la popup */
        #popup {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            height:max-content;
        }

        #ajouter {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 600px;
            max-width: 90%;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        input[type=radio][value='oui'] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid blue;
            outline: none;
            background-color: white;
            margin-right: 10px;
        }

        input[type=radio]:checked {
            background-color: blue;
        }

        input[type=radio][value='non'] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid red;
            outline: none;
            background-color: white;
            margin-right: 10px;
        }

        input[type=radio][value='non']:checked {
            background-color: red;
        }

        #popup #fermer {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            position: absolute;
            right: 26.4%;
            /* justify-content: end; */
        }

        .message {
            text-align: center;
            font-size: 20px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: 500;
            color: blue;
        }

        #vald {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #vald:hover {
            background-color: #0069d9;
        }
    </style>
    <script>
        function Openf(efm) {
            RecupererEfm(efm.value)
            document.getElementById('efm').value = efm.value
            document.getElementById("popup").style.display = "flex"
        }

        function Fermer() {
            document.getElementById("popup").style.display = "none"
        }

        function RecupererEfm(id_efm) {
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Valider.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    let data = JSON.parse(this.response)
                    Checker(data)
                }
            };
            request.send(`id_efm=${id_efm}`);
        }

        function Checker(table) {
            let inputs = document.querySelectorAll('#radio');

            for (let i = 0; i < inputs.length; i++) {
                for (let j = 0; j < 2; j++) {
                    document.getElementsByName(inputs[i].name)[j].checked = false
                }
            }

            if (table.length > 0) {
                for (let i = 0; i < inputs.length; i++) {
                    document.getElementsByName(inputs[i].name)[1].checked = true
                    inputs[i].checked = table[0][inputs[i].name] == 'Oui' ? true : false
                }
            }
        }

        function Remarque(text) {
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_Valider.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                }
            };
            request.send(`remarque=${text.name}/${text.value}`);
        }

        function recupererValeursRadios() {

            const inputs = document.querySelectorAll('#radio');
            let valeurs = [];
            inputs.forEach(input => {
                if (input.checked) {
                    valeurs.push('Oui');
                } else {
                    document.getElementsByName(input.name)[1].checked=true
                    valeurs.push('Non')
                }
            });
            Valider(valeurs)
        }


        function Valider(valeurs) {
            const request = new XMLHttpRequest();
            valeurs.push(document.getElementById('efm').value)
            let vals = JSON.stringify(valeurs);
            request.open('POST', '../Controller/C_Valider.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    if(this.response==1)
                        Message('Sauvgarder avec succès')
                    else
                    Message('Instruction ne passe pas')
                }
            };
            request.send(`valider=${vals}`);
        }

        function Message(msg) {
            document.querySelector('.message').style.display = 'block'
            document.querySelector('.message').innerText = msg
            setTimeout(function() {
                document.querySelector('.message').style.display = 'none';
            }, 3000);
        }
    </script>
</head>
<body>
    <div class="title">
        <h4>Gestion Validation Examen Fin Module</h4>
    </div>
    <div class='row'>
        <form action="" method="post">
            <table class="table table-striped table-sm table-bordered m-3">
                <thead>
                    <tr class="table-success">
                        <th scope="col">Formateur</th>
                        <th scope="col">Groupe</th>
                        <th scope="col">Description Module</th>
                        <th scope="col">EFM </th>
                        <th scope="col">Valider</th>
                        <th scope="col">Remarque</th>
                    </tr>
                </thead>
                <tbody id='informations'>

                    <?php
                    if (count($Efms) > 0) :
                        foreach ($Efms as $value) :
                    ?>
                            <tr>
                                <td><?= $value['NomP'] ?></td>
                                <td><?= $value['groupe'] ?></td>
                                <td><?= $value['DescpMd'] ?></td>
                                <td><a href="../<?= $value['url'] ?>"><img src="../Images/pdf.png" width="35px" /></a></td>
                                <td>
                                    <button type="button" onclick="Openf(this)" value="<?= $value['id'] ?>" class='btn btn-primary'>Valider</button>
                                </td>
                                <td>
                                    <textarea class='form-control' name="<?= $value['matricule'] ?>/<?= $value['groupe'] ?>/<?= $value['module'] ?>" onchange="Remarque(this)" cols="15" rows="1"><?= $value['Remarque'] ?></textarea>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    <div id="popup">
        <center>
            <input type="button" value="X" onclick="Fermer()" id='fermer'>
            <input type="hidden" value="" id="efm" />
            <div id="ajouter">
                <h2>Valider EFM </h2>
                <div class="message">
                </div>
                <table border="1">
                    <tr>
                        <th>Critères de validation</th>
                        <th>OUI</th>
                        <th>NON</th>
                    </tr>
                    <tr>
                        <td>Date de passation</td>
                        <td>
                            <label><input type="radio" id="radio" name="date_passation" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="date_passation" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Barème</td>
                        <td>
                            <label><input type="radio" id="radio" name="bareme" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="bareme" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Salle de l'examen</td>
                        <td>
                            <label><input type="radio" id="radio" name="salle_examen" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="salle_examen" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Durée</td>
                        <td>
                            <label><input type="radio" id="radio" name="duree" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="duree" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Structure de l'examen (théorie pratique)</td>
                        <td>
                            <label><input type="radio" id="radio" name="structure_examen" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="structure_examen" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Degré de difficulté (touché 80% des objectifs)</td>
                        <td>
                            <label><input type="radio" id="radio" name="degre_difficulte" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="degre_difficulte" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Deux variantes</td>
                        <td>
                            <label><input type="radio" id="radio" name="deux_variantes" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="deux_variantes" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Corrigé déposé</td>
                        <td>
                            <label><input type="radio" id="radio" name="corrigé_deposé" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="corrigé_deposé" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>Décision</td>
                        <td>
                            <label><input type="radio" id="radio" name="Decision" value="oui"></label>
                        </td>
                        <td>
                            <label><input type="radio" name="Decision" value="non"></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="button" id="vald" value="Valider" onclick="recupererValeursRadios()" />
                        </td>
                    </tr>
                </table>
            </div>
        </center>
    </div>
</body>

</html>