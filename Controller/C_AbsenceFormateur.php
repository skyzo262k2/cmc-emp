<?php

require "../Model/M_AbsenceFormateur.php";



session_start();

if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}


$AbsenceFormateur = new AbsenceFormateur();

$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$annees = explode("/", $_SESSION["Annee"]);
$AnneeFr = $annees[0];




function GetDay($d)
{
    $T_NameDay = [
        "Mon" => "Lundi",
        "Tue" => "Mardi",
        "Wed" => "Mercredi",
        "Thu" => "Jeudi",
        "Fri" => "Vendredi",
        "Sat" => "Samedi",
        "Sun" => "Dimanche"
    ];
    $dayname = date('D', strtotime($d));
    return $T_NameDay[$dayname];
}

function AfficherFormateur($Formateurs, $date, $seance)
{
    global $AbsenceFormateur, $AnneeFr, $CodeEtab;

    $Formateur_affiche = [];
    if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
        foreach ($Formateurs as $f) {
            if ($f[5] == $_SESSION["Admin"]["secteur"]) {
                $Formateur_affiche[] = $f;
            }
        }
    } else {
        $Formateur_affiche = $Formateurs;
    }

    if (count($Formateur_affiche) > 0) {

        echo "<div class='table_info'>
    <div class='buttonvalide'>
        <button class='btn btn-primary m-2' onclick='AddAbsence()'>Sauvgarder</button>
    </div>
    <div class='container-fluid'>
    <table class='table table-striped table-bordered'>
    <thead>
        <tr class='table-success'>
            <th scope='col' class='text-center'>matricule</th>
            <th scope='col' class='text-center'>Nom</th>
            <th scope='col' class='text-center'>Module</th>
            <th scope='col' class='text-center'>Groupe</th>
            <th scope='col' class='text-center'>Salle</th>
            <th scope='col' class='text-center' style='width:70px;'>A <input type='checkbox' id='checktout'  class='m-2' onchange='tout_checked(this)'/></th>
            <th scope='col' class='text-center' style='width:100px;'>Justifie</th>
            <th scope='col' class='text-center' style='width:60px;'>Action</th>
        </tr>
    </thead>
    <tbody>";

        foreach ($Formateur_affiche as $form) {

            $row = $AbsenceFormateur->VerifierAbsenceFormateur($form[0], $date, $seance, $AnneeFr, $CodeEtab);
            // echo $form[0];
            echo "<tr>
                <td class='text-center'>" . htmlspecialchars($form[0]) . "</td>
                <td>" . htmlspecialchars($form[1]) . "</td>
                <td>" . htmlspecialchars($form[2]) . "</td>
                <td>" . htmlspecialchars($form[3]) . "</td>
                <td class='text-center'>" . htmlspecialchars($form[4]) . "</td>";

            if ($row == null) {
                echo '<td  class="text-center"><input type="checkbox" class="inp_chek checked_input" value="' . htmlspecialchars($form[0]) . '//' . htmlspecialchars($form[2]) . '//' . htmlspecialchars($form[3]) . '" /></td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                </tr>';
            } else {
                echo "<td class='text-center'><input type='checkbox' disabled checked=true /></td>
            <td class='text-center'> <span>" . htmlspecialchars($row[6]) . "</span> <span onclick='ChangeJustify(this)'><span style='display:none;'>" . htmlspecialchars($row[6]) . "</span><span style='display:none;'>" . htmlspecialchars($form[0]) . "</span>
                    <span><img class='icon' src='../Images/Icon_Update.png'/></span></span>  </td>
            <td class='text-center'><div onclick='SupprimerAbsence(this)'><span><img class='icon' src='../Images/Icon_Delete.png'/></span><span style='display:none;'>" . htmlspecialchars($form[0]) . "</span></div></td>
            </tr>";
            }
        }
        echo "</tbody>
        </table> 
        </div>

        
    
    </div>";
    } else {
        echo "<div class='text-center m-5'> <h2 class='text-danger m-5'>Aucun Formateur !</h2> <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";
    }
}





if (isset($_POST["add"]) && isset($_POST["date"]) && isset($_POST["seance"])) {

    $date = $_POST["date"];
    $day_name = GetDay($date);
    $t_cef = explode("**", $_POST["add"]);
    // print_r($_POST["add"]);
    foreach ($t_cef as $cef) {
        try {
            $info = explode("//", $cef);
            // print_r($info);
            // echo "<br>";
            $CodeModule = $AbsenceFormateur->GetCodeModule($info[1], $info[2]);
            $AbsenceFormateur->AddAbsence($info[0], $AnneeFr, $_POST["date"], $info[2], $_POST["seance"], $CodeModule[0], "Non", $CodeEtab);
        } catch (Exception $ec) {
        }
    }
    $Formateur = $AbsenceFormateur->GetFormateurByEmploi_jour_seance($day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    echo '<div id="table_info"';
    AfficherFormateur($Formateur, $_POST["date"], $_POST["seance"]);
    echo "</div>";
} elseif (isset($_POST["modmat"]) && isset($_POST["date"]) && isset($_POST["seance"]) && isset($_POST["justify"])) {
    $date = $_POST["date"];
    $day_name = GetDay($date);
    $AbsenceFormateur->ChangeJustifyFormateur($_POST["modmat"], $_POST["date"], $_POST["seance"], $AnneeFr, $CodeEtab, $_POST["justify"]);
    $Formateur = $AbsenceFormateur->GetFormateurByEmploi_jour_seance($day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    echo '<div id="table_info"';
    AfficherFormateur($Formateur, $_POST["date"], $_POST["seance"]);
    echo "</div>";
} elseif (isset($_POST["supmat"]) && isset($_POST["date"]) && isset($_POST["seance"])) {
    $date = $_POST["date"];
    $day_name = GetDay($date);
    $AbsenceFormateur->DeleteAbsence($_POST["supmat"], $AnneeFr, $_POST["date"], $_POST["seance"], $CodeEtab);
    $Formateur = $AbsenceFormateur->GetFormateurByEmploi_jour_seance($day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    echo '<div id="table_info"';
    AfficherFormateur($Formateur, $_POST["date"], $_POST["seance"]);
    echo "</div>";
} elseif (isset($_POST["date"]) && isset($_POST["seance"])) {
    $date = $_POST["date"];
    $day_name = GetDay($date);
    if ($day_name != "Dimanche") {
        $Formateur = $AbsenceFormateur->GetFormateurByEmploi_jour_seance($day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
        // print_r($Formateur);
        echo '<div id="table_info"';
        AfficherFormateur($Formateur, $_POST["date"], $_POST["seance"]);
        echo "</div>";
    } else {
        echo "<div class='text-center m-5'> <h2 class='text-danger m-5'>C'est dimanche !</h2> <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";
    }
} else {
    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    require "../View/V_AbsenceFormateur.php";
}
