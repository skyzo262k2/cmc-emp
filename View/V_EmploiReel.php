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
                rows += `<tr style="height: 80px;"><th  class='text-center'>${element}</th>`;
                for (let index = 1; index < 5; index++) {
                    rows += `<td  class='td' id='${element}/${index}'></td>`;
                }
                rows += `</tr>`;
            });
            document.getElementById('col').innerHTML = rows
        }

        function Groupes() {
            var grp = document.getElementById('grp').value
            let relaod = document.getElementById('relaod')
            var request = new XMLHttpRequest();
            request.open("POST", `../Controller/C_EmploiReel.php`, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    relaod.value = grp
                    relaod.hidden = false
                    Saisir(JSON.parse(this.response));
                    document.getElementById('hid').innerHTML = `
                    <strong>Emploi de temps : ${grp} </strong>
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
                    document.getElementById('hid').hidden = false
                }
            }
            if (grp == "") {
                document.getElementById('hid').hidden = true
                relaod.value = ""
                relaod.hidden = true
            }
            request.send(`group=${grp}`)
        }

        function Archiver() {
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






    @media only screen and (min-width: 600px) {
        table {
            width: 100%;
        }
    }


    h3 {
        color: blueviolet;
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




    td {
        text-align: center;
    }

    @keyframes slideInFromTop {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }

    td:empty {
        background-color: #f2f2f2;
    }

    .td {
        font-size: 14px;
    }
</style>

<body>


    <form action="" method="post">
        <div class="container-fluid">
            <div class="row m-3">
                <div class='col-4'>
                    <h3>Emploi Réel</h3>
                </div>
                <div class='col-4 d-flex'>
                    <lable class="p-2 fw-bold">Groupes : </lable>
                    <select name="group" onchange="Groupes()" id="grp" class="form-control w-75">
                        <option value="<?php if (isset($grp)) echo $grp; ?>"><?php if (isset($grp)) echo $grp; ?></option>
                        <?php
                        if (isset($Groupes)) :
                            foreach ($Groupes as $inf) {
                                echo "<option value='" . $inf['CodeGrp'] . "'>" . $inf['CodeGrp'] . "</option>";
                            }
                        endif;
                        ?>
                    </select>
                </div>
                <div class='col-4 text-end'>
			<?php if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur'):?>
                    <input type="button" value="Archiver" onclick="Archiver()" name="archiver" class='btn btn-danger'>
			<?php endif;?>
                    <button onclick="openPop()" type="button" id="imp" class='btn btn-primary'>Imprimer</button>
                    <button onclick="Groupes()" id="relaod" hidden type="button" class='btn btn-info'>
                        reload
                    </button>
                </div>

            </div>

            <div id="cacher">
                <center>
                    <button type="button" id="x" onclick="FermerPop()">X</button><br>
                    <p>
                        <!-- <h2 style="color:red;"> les Dates sont Obligatoires </h2> -->
                    </p>
                    <label for="debut">Date Debut : </label><input type="date" name="debut" id="debut" required><br><br>
                    <label for="fin">Date fin :</label><input type="date" name="fin" id="fin" required><br><br>
                    <strong>Emploi de temps des Groupes</strong><br><br>
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
            <table border="1" id="table" class="table table-bordered">
                <tr style="height: 60px;">
                    <th width="10%" class='text-center'>Heures<br>Jours</th>
                    <th width="22%" class='text-center'>8H30-11H00</th>
                    <th width="22%" class='text-center'>11H00-13H30</th>
                    <th width="22%" class='text-center'>13H30-16H00</th>
                    <th width="22%" class='text-center'>16H00-18H30</th>
                </tr>
                <tbody id="col">
                    <script>
                        let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                        semaine.forEach(element => {
                            document.write(`<tr style="height: 80px;"><th class='text-center'>${element}</th>`);
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
        </div>

    </form>
</body>

</html>