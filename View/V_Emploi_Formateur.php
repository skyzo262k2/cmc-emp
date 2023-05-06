<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="../Js/Ajax.js"></script> -->
    <script>
        function Ajax(route, send) {
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/${route}.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    Saisir(JSON.parse(this.response), document.getElementById('frm').selectedOptions[0].innerText);
                }
            }
            request.send(send);
        }


        function Saisir(table, nom = "") {
            Vider()
            for (let index = 0; index < table.length; index++) {
                let content = document.getElementById(`${table[index].Jour}${table[index].Seance}`)
                if (content.innerText == '') {
                    content.innerHTML =
                        '<span >' +
                        table[index].CodeGrp +
                        '</span><br><span>' +
                        nom +
                        '</span><br><span>' +
                        table[index].DescpMd +
                        '</span><br><span>' +
                        table[index].CodeSl +
                        '</span> / <span>' +
                        table[index].TypeSc + '</span>';
                } else {
                    content.children[0].innerHTML += '-' + table[index].CodeGrp
                }
            }
        }

        function Vider() {
            let rows = ""
            let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            semaine.forEach(element => {
                rows += `<tr style="height: 60px;"><td>${element}</td>`;
                for (let index = 1; index < 5; index++) {
                    rows += `<td  class='td' id='${element}${index}'></td>`;
                }
                rows += `</tr>`;
            });
            document.getElementById('col').innerHTML = rows
        }

        function openPop() {
            document.getElementById('cacher').style.display = 'block'
        }

        function FermerPop() {
            document.getElementById('cacher').style.display = 'none'
        }
    </script>
    <script>
        function Formateur(frm) {
            if (frm.selectedOptions[0].value !== "") {
                let route = 'C_Emploi_Formateur';
                let send = `formateur=${frm.selectedOptions[0].value}`;
                let table = Ajax(route, send)
                document.getElementById('seul').hidden = false
                document.getElementById('Groupe').innerHTML=`
                <a href="../Controller/C_Emploi_Groupes.php?Matricule=${frm.selectedOptions[0].value}">
                        Emploi du Temps Groupes
                </a>`

            } else {
                document.getElementById('seul').hidden = true
                Vider()
            }
        }
    </script>
    <title>Emploi de Temps</title>
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

    input[type="submit"] {
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

    input[type="submit"]:active {
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
        background-color: #f5f5f5;
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

    #cacher {
        display: none;
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #ccc;
        text-align: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    #cacher p {
        color: red;
    }

    #cacher label {
        font-weight: bold;
        margin-right: 10px;
        display: inline-block;
    }

    #cacher {
        display: none;
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #ccc;
        text-align: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    #cacher p {
        color: red;
    }

    #cacher label {
        font-weight: bold;
        margin-right: 10px;
        display: inline-block;
        width: 100px;
    }

    #cacher input[type="date"] {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        width: 300px;
    }

    #cacher button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
    }

    #cacher button[type="submit"]:hover {
        background-color: #3e8e41;
    }

    #cacher #x {
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

    #cacher #x:hover {
        background-color: #cc0000;
    }

    #grp,
    #Form,
    #type,
    #sal {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        width: 300px;
    }

    #grp {
        width: 150px;
    }

    #table .td:hover {
        background-color: #f5f5f5;
        color: black;
        cursor: pointer;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
    }


    select {
        width: 150px;
    }

    .salles {
        display: inline-block;
        margin-left: 100px;
    }

    input[type="submit"] {
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

    input[type="submit"]:active {
        transform: translateY(0px);
        box-shadow: none;
    }

    #imp {
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

    #imp:active {
        transform: translateY(0px);
        box-shadow: none;
    }

    button {
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

    button:active {
        transform: translateY(0px);
        box-shadow: none;
    }

    select {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        width: 300px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
</style>



<body>
    <center>
        <h1>Emploi Formateur</h1>
    </center>
    <form action="" method="post">
        <?php if(!isset($_SESSION['userFormateur'])):?>
        <center><button onclick="openPop()" type="button">Imprimer</button></center>
        <table>
            <tr>
                <td style="text-align: center;font-size: larger;">Fomateur</td>
                <td>
                    <select name="formateur" onchange="Formateur(this)" id="frm">
                        <option value="<?php if (isset($mat)) echo $mat . '/' . $nomp; ?>"><?php if (isset($nomp)) echo $nomp; ?></option>
                        <?php
                        if (isset($Formateurs)) :
                            foreach ($Formateurs as $inf) {
                                echo "<option value='" . $inf['Matricule'] . '/' . $inf['NomPr'] . "'>" . $inf['NomPr'] . "</option>";
                            }
                        endif;
                        ?>
                    </select>
                    <?php if(isset($_SESSION["Admin"]) && !$_SESSION["Admin"]["Poste"] == "Surveille"):?>
                        <span  id="Groupe"></span>
                    <?php endif;?>
                </td>
            </tr>
        </table>
        <?php endif;?>
        <div id="cacher">
            <center>
                
                <button type="button" id="x" onclick="FermerPop()">X</button><br>
                <p>
                    <!-- <h2 style="color:red;">les Dates sont Obligatoires </h2> -->
                </p>
                <label for="debut">Date Debut</label><input type="date" name="debut" id="debut"><br><br>
                <label for="fin">Date fin</label><input type="date" name="fin" id="fin"><br><br>
                <strong>Emploi All Formateurs</strong><br><br>


                <button type="submit" name="word_all" style='background: none;border:none;'>
                    <img src='../Images/word.png' style='width: 35px;height: 35px;' alt='not found'>
                </button>
                <button style="background: none;border:none;" name="tous_execl"><img src="../Images/execl.jpeg" style='width: 35px;height: 35px;' alt="not found"></button>

                <br><br>
                <span style="margin-left: auto;margin-right: auto;">
                    <table>
                        <tr>
                            <th>PDF de Tout Formateur </th>
                            <th>PDF Formateur P</th>
                            <th>PDF Formateur V</th>
                        </tr>
                        <tr>
                            <td style="border:none;">
                                <button type="submit" name="pdfall" style='background: none;border:none;'>
                                    <img src='../Images/pdf.png' style='width: 35px;height: 35px;' alt='not found'>
                                </button>
                            </td>
                            <td  style="border:none;">
                                <button type='submit' name='pdfp' style='background: none; border:none;'>
                                    <img src='../Images/pdf.png' style='width: 35px;height: 35px;' alt='not found'>
                                </button>
                            </td>
                            <td style="border:none;">
                                <button type='submit' name='pdfv' style='background: none; border:none;'>
                                    <img src='../Images/pdf.png' style='width: 35px;height: 35px;' alt='not found'>
                                </button>
                            </td>

                        </tr>
                    </table>

                </span>

                <br><br>
                <span style="margin-left: auto;margin-right: auto;" hidden id="seul">
                    <strong>Emploi Formateur</strong><br>
                    <button type='submit' name='pdfone' style='background: none; border:none;'>
                        <img src='../Images/pdf.png' style='width: 50px;height: 50px;' alt='not found'>
                    </button>
                    <button style='background: none; border:none;' name='word'>
                        <img src='../Images/word.png' style='width: 50px;height: 50px;' alt='not found'>
                    </button>
                    <button style='background: none; border:none;' name='execl'>
                        <img src='../Images/execl.jpeg' style='width: 50px;height: 50px;' alt='not found'>
                    </button>
                </span>
            </center>
        </div>

        <table border="1" style="width:1000px;">
            <tr style="height: 60px;">
                <td>Heures<br>Jours</td>
                <td>8H30-11H00</td>
                <td>11H00-13H30</td>
                <td>13H30-16H00</td>
                <td>16H00-18H30</td>
            </tr>
            <tbody id="col">
                <script>
                    let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                    semaine.forEach(element => {
                        document.write(`<tr style="height: 60px;"><td>${element}</td>`);
                        for (let index = 1; index < 5; index++) {
                            document.write(`<td  class='td' id='${element}${index}'></td>`);
                        }
                        document.write(`</tr>`);
                    });
                </script>
            </tbody>
        </table>
    </form>
    </div>
    <?php if(isset($_SESSION['userFormateur'])):
        echo "
            <script>
            var emp={$_SESSION['userFormateur']['emploi']};
            var no_pr='$nomp';
            </script>";
        ?>
        <script>
            
            Saisir(emp,no_pr);
        </script>
    <?php endif;?>
</body>

</html>