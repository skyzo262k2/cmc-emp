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

function AfficherFormateur($Formateur, $date, $seance)
{
    global $AbsenceFormateur, $AnneeFr, $CodeEtab;
    echo "<div class='table_info'>
    <div class='buttonvalide'>
        <button class='btn btn-primary m-2' onclick='AddAbsence()'>Valider</button>
    </div>
    <table class='table table-striped table-sm table-bordered'>
    <thead>
        <tr class='table-success'>
            <th scope='col'>matricule</th>
            <th scope='col'>Nom</th>
            <th scope='col'>Module</th>
            <th scope='col'>Groupe</th>
            <th scope='col'>Salle</th>
            <th scope='col' style='width:60px;'>A <input type='checkbox' class='m-2' onchange='tout_checked(this)'/></th>
            <th scope='col' style='width:100px;'>Justify</th>
            <th scope='col' style='width:60px;'>Action</th>
        </tr>
    </thead>
    <tbody>";

    foreach ($Formateur as $form) {
        $row = $AbsenceFormateur->VerifierAbsenceFormateur($form[0], $date, $seance, $AnneeFr, $CodeEtab);
        // echo $form[0];
        echo "<tr>
                <td>$form[0]</td>
                <td>$form[1]</td>
                <td>$form[2]</td>
                <td>$form[3]</td>
                <td>$form[4]</td>";

        if ($row == null) {
            echo '<td><input type="checkbox" class="inp_chek checked_input" value="' . $form[0] . '/' . $form[2] . '/' . $form[3] . '" /></td>
                    <td>-</td>
                    <td>-</td>
                </tr>';
        } else {
            echo "<td><input type='checkbox' disabled checked=true /></td>
            <td> <span>$row[6]</span> <span onclick='ChangeJustify(this)'><span style='display:none;'>$row[6]</span><span style='display:none;'>$form[0]</span>
                    <span><img class='icon' src='../Images/Icon_Update.png'/></span></span>  </td>
            <td><div onclick='SupprimerAbsence(this)'><span><img class='icon' src='../Images/Icon_Delete.png'/></span><span style='display:none;'>$form[0]</span></div></td>
            </tr>";
        }
    }
    echo "</tbody>
        </table>

        
    
    </div>";
}





if (isset($_POST["add"]) && isset($_POST["date"]) && isset($_POST["seance"])) {

    $date = $_POST["date"];
    $day_name = GetDay($date);
    $t_cef = explode(",", $_POST["add"]);
    foreach ($t_cef as $cef) {
        try {
            $info = explode("/", $cef);
            $CodeModule = $AbsenceFormateur->GetCodeModule($info[1]);
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
    }
} else {
    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    require "../View/V_AbsenceFormateur.php";
}
