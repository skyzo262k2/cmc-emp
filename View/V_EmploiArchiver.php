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
            for (let index = 0; index < table.length; index++) {
                let content = document.getElementById(`${table[index].Jour}${table[index].Seance}`)
                if (content.innerText == '') {
                    content.innerHTML =
                        '<span>' +
                        table[index].nomF +
                        '</span><br><span>' +
                        table[index].descpMd +
                        '</span><br><span>' +
                        table[index].CodeSl +
                        '</span> / <span>' +
                        table[index].TypeSc +
                        '</span> <span hidden id="span">' + table[index].Matricule + '<br>' + table[index].CodeMd + '</span>';
                }
            }
        }
    </script>
</head>
<style>


   
  


    h3 {
        color: blueviolet;
        animation: slideInFromTop 1s ease-in-out;
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

    @keyframes slideInFromTop {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }







</style>


<body>

    <div class='container-fluid'>
        <form action="" method="post">
            <div class="row m-3">
                <div class='col-4'>
                    <h3>Emploi Archiver</h3>
                </div>
                <div class='col-4 d-flex'>
                    <lable class="p-2 fw-bold">Mois : </lable>
                    <select name="mois" id="m" onchange="this.form.submit()" class="mois form-control w-50" >
                        <option value="<?php if (isset($mois)) echo $mois; ?>"><?php if (isset($mois)) echo $mois; ?></option>
                        <?php
                        foreach ($Mois as $mois) {
                            $n = $mois['Mois'];
                            echo "<option value='$n'>$n</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class='col-4 d-flex'>
                    <lable class="p-2 fw-bold">Groupes : </lable>
                    <select name="group" <?= $disabled ?> onchange="this.form.submit()" id="grp" class="form-control w-50">
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

            </div>

            <table border="1" id="table" class="table table-bordered">
                <tr style="height: 60px;">
                    <th width="10%" class='text-center'>Heures<br>Jours</th>
                    <th width="22%" class='text-center'>8H30-11H00</th>
                    <th width="22%" class='text-center'>11H00-13H30</th>
                    <th width="22%" class='text-center'>13H30-16H00</th>
                    <th width="22%" class='text-center'>16H00-18H30</th>
                </tr>
                <script>
                    let semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                    semaine.forEach(element => {
                        document.write(`<tr style="height: 80px;" class='text-center'><th>${element}</th>`);
                        for (let index = 1; index < 5; index++) {
                            document.write(`<td  class='td' id='${element}${index}'></td>`);
                        }
                        document.write(`</tr>`);
                    });
                </script>
                <?php
                if (isset($_POST['group']) && $_POST['group'] != "") :
                    echo "
            <script>
                var table=$json;
                Saisir(table);
            </script>";
                endif;
                ?>
            </table>
        </form>
    </div>
</body>

</html>