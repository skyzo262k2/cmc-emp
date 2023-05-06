<?php


require "../Model/M_AbsenceFormateur.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$absenceformateur = new AbsenceFormateur();

$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$annees = explode("/", $_SESSION["Annee"]);
$AnneeFr = $annees[0];

function GetHeureSeance($nb)
{
    switch ($nb) {
        case "1":
            return "08:30 - 11:00";
        case "2":
            return "11:00 - 13:30";
        case "3":
            return "13:30 - 16:00";
        case "4":
            return "16:00 - 18:30";
        default:
            return null;
    }
}


if (isset($_POST["findmat"]) && isset($_POST["date1"]) && isset($_POST["date2"]) && isset($_POST["seance"])) {

    $mat = $_POST["findmat"];
    $seance = $_POST["seance"];
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
    $formateur = $absenceformateur->GetFormateur($mat, $CodeEtab);
    $absence_formateur = $absenceformateur->GetAbsenceByOneFormateur($mat, $date1, $date2, $seance, $AnneeFr, $CodeEtab);



    echo "<input type='button' value='X' onclick='Fermer()' id='fermer'>
    <div class='info_stg'>
        <div class='form-groupe'>
            <label for=''>CEF : </label>
            <input type='text' id='cef_stg' class='info form-control' readonly value='$formateur[0]'>
        </div>
        <div class='form-groupe'>
            <label for='nom_stg'>Nom :</label>
            <input type='text' id='nom_stg' class='info form-control' readonly value='$formateur[1]'>
        </div>
    </div>

    <div class='table_info m-2'>
        <table class='table table-striped table-sm table-bordered'>
            <thead>
                <tr class='table-success'>
                    <th scope='col'>Groupe</th>
                    <th scope='col'>Module</th>
                    <th scope='col'>Seance</th>
                    <th scope='col'>Date Absence</th>
                    <th scope='col'>Justify</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($absence_formateur as $format) {

        echo "<tr>
                <td>$format[1]</td>
                <td>$format[2]</td>
                <td>" . GetHeureSeance($format[3]) . "</td>
                <td>$format[4]</td>
                <td>$format[5]</td>
            </tr>";
    }


    echo "</tbody>
    </div>";
} elseif (isset($_POST["date1"]) && isset($_POST["date2"]) && isset($_POST["seance"])) {

    $nb = $absenceformateur->TotalAbsenceFormateurByAnne($_POST["date1"], $_POST["date2"], $_POST["seance"], $AnneeFr, $CodeEtab);
    $Formateur = $absenceformateur->GetFormateurAbsenceBydateSeance($_POST["date1"], $_POST["date2"], $_POST["seance"], $AnneeFr, $CodeEtab);
    // echo  $_POST["seance"];
    echo "<div class='row m-4 total'>
                    <span>Total Absences : <b>$nb[0]</b></span>
    </div>";


    if (count($Formateur) != 0) {
        echo "<div class='table_info  m-4'>
        <table class='table table-striped table-sm table-bordered'>
            <thead>
                <tr class='table-success'>
                    <th scope='col'>Matricule</th>
                    <th scope='col'>Nom</th>
                    <th scope='col'>Nombre Absence</th>
                    <th scope='col'>Action</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($Formateur as $form) {
            echo "<tr>
        <td>$form[0]</td>
        <td>$form[1]</td>
        <td>$form[2]</td>";
            if ($form[2] == 0)
                echo "<td><img class='icon' src='../Images/Icon_Find.png'/></td>";
            else
                echo "<td><div onclick='Detail(this)'><span><img class='icon' src='../Images/Icon_Find.png'/></span><span style='display:none;'>$form[0]</span></div></td>";

            echo "</tr>";
        }
        echo "</tbody>
                </table>
            </div>";
    }else{
        echo "<div style='text-align:center;'>
            <h4 class='text-danger'>N'est pas Absences</h4>
        </div>";
    }
} else {

    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    $datedebut = $AnneeFr . "-09-01";
    $nb = $absenceformateur->TotalAbsenceFormateurByAnne($datedebut, $sysdate, "choisir", $AnneeFr, $CodeEtab);
    $Formateur = $absenceformateur->GetFormateurAbsenceBydateSeance($datedebut, $sysdate, "choisir", $AnneeFr, $CodeEtab);
    require "../View/V_ConsulterAbsenceFormateur.php";
}
