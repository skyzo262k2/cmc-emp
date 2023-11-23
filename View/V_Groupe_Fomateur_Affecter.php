<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Modules Affecter</title>

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
</style>

<body>
    <div class="container-fluid">
        <div class='row m-4'>
            <div class='col-4'>
                <h3>Modules de groupe</h3>
            </div>
            <div class='col-5'>
                <form action="" method="post" class="d-flex">
                    <select name="group" class="form-control w-75" onchange="this.form.submit()" id="grp">
                        <option value="<?php if (isset($grp)) echo $grp; ?>"><?php if (isset($grp)) echo $grp; ?></option>
                        <?php
                        if (isset($Groupes)) :
                            foreach ($Groupes as $inf) {
                                echo "<option value='{$inf['CodeGrp']}/{$inf['CodeFlr']}/{$inf['annee']}/{$inf['Fpa']}/{$inf['tauxfpa']}'>
                             {$inf['CodeGrp']} 
                             </option>";
                            }
                        endif;
                        ?>
                    </select>
                    <span class="w-25"><?= $lien; ?></span>

                </form>
            </div>
            <div class='col-3'>
                <a href='../Controller/C_PDF_Affectation_AllGrp.php'>
                    Modules pour tous les groupes
                    <img src='../Images/pdf.png' alt='not found' style='width: 35px;height: 35px;'>
                </a>
            </div>
        </div>



        <?php if (isset($groupe) || isset($ModuleNoaffe)) : ?>
            <table border="1" class="table table-bordered table-light table-striped">
                <tr>
                    <th>Formateur</th>
                    <th>Description Module</th>
                    <th>Code Module</th>
                    <th>Code Filière</th>
                    <th>Annee Formation</th>
                    <th>S1</th>
                    <th>S2</th>
                    <th>Masse Horaire</th>
                    <th>Avc</th>
                    <th>Taux</th>
                </tr>
                <?php

                if (isset($groupe)) {
                    foreach ($groupe as $grop) {
                        if ($Fpa == 'O') {
                            $grop['s1'] = ($tauxfpaGrp / 100) * $grop['s1'];
                            $grop['s2'] = ($tauxfpaGrp / 100) * $grop['s2'];;
                            $grop['masshoraire'] = $grop["s1"] + $grop["s2"];

                            $grop['taux'] = $grop["avc"] != 0 ? number_format($grop["avc"] / ($grop['masshoraire']) * 100, 2) : 0;
                        }
                        echo "
                        <tr>
                            <td>" . htmlspecialchars($grop['nomp']) . "</td>
                            <td>" . htmlspecialchars($grop['descpMd']) . "</td>
                            <td>" . htmlspecialchars($grop['CodeMd']) . "</td>
                            <td>" . htmlspecialchars($grop['flr']) . "</td>
                            <td>" . htmlspecialchars($anneGrp) . "</td>
                            <td>" . htmlspecialchars($grop['s1']) . "</td>
                            <td>" . htmlspecialchars($grop['s2']) . "</td>
                            <td>" . htmlspecialchars($grop['masshoraire']) . "</td> 
                            <td>" . htmlspecialchars($grop['avc']) . "</td> 
                            <td>" . htmlspecialchars($grop['taux']) . "%</td>                                
                        </tr>";
                    }
                }
                if (isset($ModuleNoaffe)) {
                    foreach ($ModuleNoaffe as $grop) {
                        if ($Fpa == 'O') {
                            $grop['s1'] = ($tauxfpaGrp / 100) * $grop['s1'];
                            $grop['s2'] = ($tauxfpaGrp / 100) * $grop['s2'];;
                        }
                        echo "
                        <tr>
                            <td>------</td>
                                <td>" . htmlspecialchars($grop['DescpMd']) . "</td>
                                <td>" . htmlspecialchars($grop['CodeMd']) . "</td>
                                <td>" . htmlspecialchars($grop['CodeFlr']) . "</td>
                                <td>" . htmlspecialchars($grop['Annee']) . "</td>
                                <td>" . htmlspecialchars($grop['s1']) . "</td>
                                <td>" . htmlspecialchars($grop['s2']) . "</td>
                                <td>" . htmlspecialchars($grop["s1"] + $grop["s2"]) . "</td>                            
                                <td>0</td> 
                                <td>0%</td>   
                        </tr>";
                    }
                }

                ?>
            </table>
        <?php else : ?>
            <div class='text-center'><img src='../Images/nodata.jpg' alt='' /></div>";
        <?php endif ?>
    </div>
</body>

</html>