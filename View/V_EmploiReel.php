<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function Saisir(table) {
            Vider()
            for (let index = 0; index < table.length; index++) {
                let content = document.getElementById(`${table[index].Jour}/${table[index].Seance}`)
                if (content.innerText == '') {
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

        function openPop() {
            document.getElementById('cacher').style.display = 'block'
        }

        function FermerPop() {
            document.getElementById('cacher').style.display = 'none'
        }

        function Vider() {
            let rows = ""
            let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            semaine.forEach(element => {
                rows += `<tr style="height: 60px;"><td>${element}</td>`;
                for (let index = 1; index < 5; index++) {
                    rows += `<td  class='td' id='${element}/${index}'></td>`;
                }
                rows += `</tr>`;
            });
            document.getElementById('col').innerHTML = rows
        }

        function Groupes() {
            var grp = document.getElementById('grp').selectedOptions[0].value
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_EmploiReel.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    // console.log(this.responseText)
                    Saisir(JSON.parse(this.response));
                    document.getElementById('hid').innerHTML = `
                    <strong>Emploi Groupes </strong>
                     <br> 
                     <button type='submit' name = 'pdfone'  style = 'background: none;border:none;' >
                        <img src='../Images/pdf.png' style = 'width: 50px;height: 50px;' alt = 'not found' >
                    </button> 
                    <button value='${grp}' name = 'word' style = 'background: none;border:none;' >
                        <img src='../Images/word.png' style = 'width: 50px;height: 50px;'alt = 'not found' >
                    </button>
                    <button value='${grp}' name = 'word' style = 'background: none;border:none;' >
                        <img src = '../Images/execl.jpeg'style = 'width: 50px;height: 50px;'alt = 'not found' >
                    </button>`;
                    document.getElementById('hid').hidden=false
                }
            }
            if(grp=="")
                document.getElementById('hid').hidden=true
            request.send(`group=${grp}`)
        }
        function Archiver()
        {
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_EmploiReel.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    
                }
            }
            request.send(`archiver='archiver'`)
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

    input[type="button"] {
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
</style>
<body>

    <center>
        <h1>Emploi Réel</h1>
    </center>
    <form action="" method="post">
        <input type="hidden" name="frm_hid" id="frm_hid">
        <center>
            <input type="button" value="Archiver" onclick="Archiver()" name="archiver">
            <button onclick="openPop()" type="button" id="imp">Imprimer</button>
        </center>
        <table>
            <tr>
                <td style="text-align: center;font-size: larger;">Groupes</td>
                <td>
                    <select name="group" onchange="Groupes()" id="grp">
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

        <div id="cacher">
            <center>
                <button type="button" id="x" onclick="FermerPop()">X</button><br>
                <p>
                <!-- <h2 style="color:red;"> les Dates sont Obligatoires </h2> -->
                </p>
                <label for="debut">Date Debut</label><input type="date" name="debut" id="debut"><br><br>
                <label for="fin">Date fin</label><input type="date" name="fin" id="fin"><br><br>
                <strong>Emploi All Groupes</strong><br><br>
                <button type="submit" name="pdfall" style='background: none;border:none;'>
                    <img src='../Images/pdf.png' style='width: 50px;height: 50px;' alt='not found'>
                </button>
                <button style="background: none;border:none;" name="execl_tous"><img src="../Images/execl.jpeg" style='width: 50px;height: 50px;' alt="not found"></button>
                <button style="background: none;border:none;" name="tous_word"><img src="../Images/word.png" style='width: 50px;height: 50px;' alt="not found"></button>
                <br><br>
                <span style="margin-left: auto;margin-right: auto;" id="hid" hidden>

                </span>
            </center>
        </div>
        <table border="1" id="table">
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
                            document.write(`<td class='td' id='${element}/${index}'></td>`);
                        }
                        document.write(`</tr>`);
                    });
                </script>
            </tbody>
            <!-- <?php
                    if (isset($_POST['group']) && $_POST['group'] != "") :
                        echo "
            <script>
                let table=$json;
                Saisir(table);
            </script>";
                    endif;
                    ?> -->
        </table>
</body>

</html>