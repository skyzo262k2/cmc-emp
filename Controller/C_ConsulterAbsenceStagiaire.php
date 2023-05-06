<?php

use PhpOffice\PhpWord\Shared\AbstractEnum;

require "../Model/M_AbsenceStagiaire.php";

$absencestg = new AbsenceStagiaire();
session_start();


if (!isset($_SESSION["Admin"]) && !isset($_SESSION["userFormateur"])) {
    header("location:../Controller/C_Login.php");
}


$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$annees = explode("/", $_SESSION["Annee"]);
$AnneeFr = $annees[0];

$absencestg->connexion();
if (isset($_SESSION["Admin"]))
    $groupes = AbsenceStagiaire::$cnx->query("select distinct groupe from stagiaire where Etab = '$CodeEtab' order by groupe")->fetchAll(PDO::FETCH_NUM);
else {
    $mat = $_SESSION["userFormateur"]["Matricule"];
    $groupes = AbsenceStagiaire::$cnx->query("call SP_GroupeAffecterByFormateurAnneeEtab(\"$mat\",\"$annees[0]\",\"$CodeEtab\")")->fetchAll(PDO::FETCH_NUM);
}
$absencestg->Deconnexion();




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


if (isset($_POST["dtdebut"]) && isset($_POST["dtfin"]) && isset($_POST["seance"]) && isset($_POST["groupe"]) && isset($_POST["stg"]) && isset($_POST["type"])) {
    $dtd = $_POST["dtdebut"];
    $dtf = $_POST["dtfin"];
    $seance = $_POST["seance"];
    $grp = $_POST["groupe"];
    $stg = $_POST["stg"];
    $type = $_POST["type"];
    $texttype = $type === "A" ? "Absence" : "Retard";
    $ConsParEtabAbsence = $absencestg->GetConsulterAbsence($dtd, $dtf, $seance, $grp, $stg, $AnneeFr, $CodeEtab, $type);
    $ConsParEtabGrpNonAbsence = $absencestg->GetGroupeNonAbsence($dtd, $dtf, $type, $seance, $AnneeFr, $CodeEtab);
    $ConsParEtabStgNonAbsenceByGrp = $absencestg->GetStagiaireNonAbsencebyGroupe($dtd, $dtf, $type, $seance, $AnneeFr, $CodeEtab, $grp);

    // print_r($ConsParEtabAbsence);

    if (count($ConsParEtabAbsence) != 0) {
        echo "<table class='table table-striped table-sm table-bordered' >";
        if (($seance == "choisir" and $grp == "choisir" and $stg == "choisir") || ($seance != "choisir" and $grp == "choisir" and $stg == "choisir")) {

            if (count($ConsParEtabAbsence) != 0) {
                echo  "<tr>
                    <th>Groupe</th>
                    <th>Nombre $texttype</th></tr>";
                foreach ($ConsParEtabAbsence as $con) {
                    foreach ($groupes as $g) {
                        // print_r($g);
                        if ($con[0] == $g[0]) {
                            echo "<tr>
                     <td>$con[0]</td>
                     <td>$con[1]</td>
                </tr>";
                        }
                    }
                }
            }
        }
        if (($seance == "choisir" and $grp != "choisir" and $stg == "choisir") || ($seance != "choisir" and $grp != "choisir" and $stg == "choisir")) {
            echo "<tr>
                    <th>Cef</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Discipline</th>
                    <th>Nombre $texttype</th></tr>";
            foreach ($ConsParEtabAbsence as $con) {
                echo "<tr>
                     <td>$con[0]</td>
                     <td>$con[1]</td>
                     <td>$con[2]</td>
                     <td>$con[3]</td>
                     <td>$con[4]</td>
                </tr>";
            }
        }
        if (($seance == "choisir" and $grp != "choisir" and $stg != "choisir") || ($seance != "choisir" and $grp != "choisir" and $stg != "choisir")) {
            // else {
            echo "<tr>
            <th>Formateur</th>
            <th>Module</th>
            <th>Seance</th>
            <th>DateAbsence</th>
            <th>justify</th>
            </tr>";
            foreach ($ConsParEtabAbsence as $con) {
                echo "<tr>
             <td>$con[0]</td>
             <td>$con[1]</td>
             <td>" . GetHeureSeance($con[2]) . "</td>
             <td>$con[3]</td>
             <td>$con[4]</td>
             
        </tr>";
            }
        }
        echo   "</table>";
    }
} elseif (isset($_POST["dtdebut"]) && isset($_POST["dtfin"]) && isset($_POST["seance"]) && isset($_POST["groupe"]) && isset($_POST["stg"])) {
    $dtD = $_POST["dtdebut"];
    $dtF = $_POST["dtfin"];
    $seance = $_POST["seance"];
    $grp = $_POST["groupe"];
    $stg = $_POST["stg"];
    echo "<div class='row'>
                <div class='col-4'></div>
                    <div class='col-4'>
                        <div class='form-groupe' id='stagiaire_select'>
                            <select name='stagiaire' id='stagiaire' class='form-control' onchange='ChangeDate()'>
                                <option value='choisir'>Choisir stagiaire</option>";
    if ($grp !== "choisir") {
        $stagiaires = $absencestg->GetStagiairebyGroupe($grp, $AnneeFr, $CodeEtab);
        foreach ($stagiaires as $stagiaire) {
            if ($stg == $stagiaire[0])
                echo "<option selected value='$stagiaire[0]'>$stagiaire[1] $stagiaire[2]</option>";
            else
                echo "<option value='$stagiaire[0]'>$stagiaire[1] $stagiaire[2]</option>";
        }
    }

    echo  "</select>
                        </div>
                    </div>
                </div>
            <div class='col-5'></div></div>";
    // echo $dtD . "  -  " . $dtF . "  -  " . $seance . "  -  " . $grp . "  -  " . $stg."<br>";
    $Absence = [0];
    $Retard = [0];
    if ($grp == "choisir" && isset($_SESSION["userFormateur"])) {
        $Absence = [0];
        $Retard = [0];
    }else{
        $Absence = $absencestg->GetSatatistique($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "A");
        $Retard = $absencestg->GetSatatistique($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "R");
    }
  
    echo "<div class='row nb_statistique'>
                <div class='col-4'></div>
                <div class='col-2 statistique'>
                        <span class='title'>Absence</span>
                    <div>
                        <span id='nbA'>$Absence[0]</span><span onclick='Detail(\"A\")'><img class='icon' src='../Images/Icon_Find.png'/></span>
                    </div>
                </div>
                <div class='col-2 statistique'>
                    <span class='title'>Reterd</span>
                    <div>
                        <span id='nbR'>$Retard[0]</span><span onclick='Detail(\"R\")'><img class='icon' src='../Images/Icon_Find.png'/></span>
                    </div>
                </div>
                <div class='col-4'></div>
            </div>";
    if ($dtD != "" && $dtF != "" && $seance == "choisir" && $grp == "choisir" &&  $stg == "choisir") {
        if (isset($_SESSION["Admin"])) {

            $TopAbsenceStagiaire = $absencestg->GetTopAbsenceStagiaire($dtD, $dtF, "A", $AnneeFr, $CodeEtab);
            echo " <div class='m-5'>
        <div>
            <b>Absences Stagiaire : Top 10 </b>
        </div>
        <table class='table table-striped table-sm table-bordered'>
                    <thead>
                        <tr>
                            <th>CEF</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Groupe</th>
                            <th>Discipline</th>
                            <th>Nombre Absence</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($TopAbsenceStagiaire as $stg) {
                echo "<tr>";
                echo "<td>$stg[0]</td>";
                echo "<td>$stg[1]</td>";
                echo "<td>$stg[2]</td>";
                echo "<td>$stg[3]</td>";
                echo "<td>$stg[4]</td>";
                echo "<td>$stg[5]</td>";
                echo "</tr>";
            }
            echo "</tbody>
                </table></div>";
        }
    }
} else {
    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    $datedebut = $AnneeFr . "-09-01";
    $Absence = [0];
    $Retard = [0];
    if (isset($_SESSION["Admin"])) {
        $Absence = $absencestg->GetSatatistique($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "A");
        $Retard = $absencestg->GetSatatistique($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "R");
        $TopAbsenceStagiaire = $absencestg->GetTopAbsenceStagiaire($datedebut, $sysdate, "A", $AnneeFr, $CodeEtab);
    }
    require "../View/V_ConsulterAbsenceStagiaire.php";
}
