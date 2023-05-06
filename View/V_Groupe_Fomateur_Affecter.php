<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
  
</head>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
    }

    h1 {
    font-size: 28px;
    text-align: center;
    margin: 20px 0;
    }

    a {
    display: block;
    text-align: center;
    margin-bottom: 20px;
    }

    select {
    font-size: 16px;
    padding: 5px;
    margin-bottom: 20px;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    }

    table td, table th {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
    }

    table th {
    background-color: #eee;
    font-weight: bold;
    }

    table tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    center h1 {
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
</style>
<body>
    <center>
        <h1>Module Affecter pour le groupe</h1>
        <a href='../Controller/C_PDF_Affectation_AllGrp.php'>
        <img src='../Images/pdf.png' alt='not found' style='width: 35px;height: 35px;'>
        </a>
    </center>

    <form action="" method="post">
        <select name="group" onchange="this.form.submit()" id="grp">
            <option value="<?php if (isset($grp)) echo $grp; ?>"><?php if (isset($grp)) echo $grp; ?></option>
            <?php
            if (isset($Groupes)) :
                foreach ($Groupes as $inf) {
                    echo "<option value='" . $inf['CodeGrp'] . "/" . $inf['CodeFlr'] . "/" . $inf['annee'] . "'>" . $inf['CodeGrp'] . "</option>";
                }
            endif;
            ?>
        </select><br><br>
        <span><?= $lien; ?></span>
        
            <table border="1">
                <tr>
                    <td>Formateur</td>
                    <td>Description Module</td>
                    <td>Code Module</td>
                    <td>Code Filière</td>
                    <td>Annee Formation</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>Masse Horaire</td>
                    <td>Avc</td>
                    <td>Taux</td>
                </tr>
                <?php
                if (isset($groupe)) {
                    foreach ($groupe as $grop) {
                        echo "
                        <tr>
                            <td>" . $grop['nomp'] . "</td><td>" . $grop['descpMd'] . "</td><td>" . $grop['CodeMd'] . "</td>
                            <td>" . $grop['flr'] . "</td><td>" . $anneGrp . "</td><td>" . $grop['s1'] . "</td><td>" . $grop['s2'] . "</td>
                            <td>" . $grop['masshoraire'] . "</td> 
                            <td>" . $grop['avc'] . "</td> 
                            <td>" . $grop['taux'] . "%</td>                                
                        </tr>";
                    }
                }
                if (isset($ModuleNoaffe)) {
                    foreach ($ModuleNoaffe as $grop) {
                        echo "
                        <tr>
                            <td>------</td><td>" . $grop['DescpMd'] . "</td><td>" . $grop['CodeMd'] . "</td>
                            <td>" . $grop['CodeFlr'] . "</td><td>" . $grop['Annee'] . "</td>
                            <td>" . $grop['s1'] . "</td><td>" . $grop['s2'] . "</td><td>" . $grop['s1'] + $grop['s2'] . "</td>                            
                            <td>0</td> 
                            <td>0%</td>   
                        </tr>";
                    }
                }
                ?>
            </table>
    </form>
</body>
</html>