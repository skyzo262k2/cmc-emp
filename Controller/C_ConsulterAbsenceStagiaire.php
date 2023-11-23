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
    if ($_SESSION["Admin"]["Poste"] != "ChefSecteur")
        $groupes = AbsenceStagiaire::$cnx->query("select distinct s.groupe from stagiaire s where s.Etab = '$CodeEtab' and s.AnneF = '$AnneeFr' order by s.groupe")->fetchAll(PDO::FETCH_NUM);
    else
        $groupes = AbsenceStagiaire::$cnx->query("select distinct s.groupe from stagiaire s inner join groupe g on g.CodeGrp = s.groupe inner join filiere f using(CodeFlr)
    where s.Etab = '$CodeEtab' and s.AnneF = '$AnneeFr' and f.CodeSect ='" . $_SESSION["Admin"]["secteur"] . "'   order by s.groupe")->fetchAll(PDO::FETCH_NUM);
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
    // $ConsParEtabGrpNonAbsence = $absencestg->GetGroupeNonAbsence($dtd, $dtf, $type, $seance, $AnneeFr, $CodeEtab);
    // $ConsParEtabStgNonAbsenceByGrp = $absencestg->GetStagiaireNonAbsencebyGroupe($dtd, $dtf, $type, $seance, $AnneeFr, $CodeEtab, $grp);

    // print_r($ConsParEtabAbsence);

    if (count($ConsParEtabAbsence) != 0) {
        echo "<table class='table table-striped table-sm table-bordered' >";
        if (($seance == "choisir" and $grp == "choisir" and $stg == "choisir") || ($seance != "choisir" and $grp == "choisir" and $stg == "choisir")) {

            if (count($ConsParEtabAbsence) != 0) {
                $ab_groupes = [];
                foreach ($ConsParEtabAbsence as $grp_loop) {
                    if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
                        if ($grp_loop[2] == $_SESSION["Admin"]["secteur"]) {
                            $ab_groupes[] = $grp_loop;
                        }
                    } else {
                        $ab_groupes[] = $grp_loop;
                    }
                }
                echo  "<tr>
                    <th>Groupe</th>
                    <th>Nombre $texttype</th></tr>";
                foreach ($ab_groupes as $con) {
                    foreach ($groupes as $g) {
                        if ($con[0] == $g[0]) {
                            echo "<tr>
                                        <td>".htmlspecialchars($con[0])."</td>
                                        <td>".htmlspecialchars($con[1])."</td>
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
                     <td>".htmlspecialchars($con[0])."</td>
                     <td>".htmlspecialchars($con[1])."</td>
                     <td>".htmlspecialchars($con[2])."</td>
                     <td>".htmlspecialchars($con[3])."</td>
                     <td>".htmlspecialchars($con[4])."</td>
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
                if ($con[5] == "-") {
                    $f = "-";
                    $m = "-";
                } else {
                    $absencestg->connexion();
                    $data = AbsenceStagiaire::$cnx->query("select m.DescpMd,a.matricule from Modules m inner join affectModule a on a.ModuleCode = m.CodeMd 
                    inner join groupe g on g.Codegrp = a.groupe
                    where CodeMd='$con[5]' and a.groupe = '$con[3]'
                    and a.CodeEtab = '$CodeEtab' and a.AnneeFr = '$AnneeFr'
                    and g.CodeFlr = m.CodeFlr")->fetch(PDO::FETCH_NUM);
                    $fo = AbsenceStagiaire::$cnx->query("select concat(Nom,' ',Prenom) from formateur where CodeEtab = '$CodeEtab' and matricule ='$data[1]'")->fetch(PDO::FETCH_NUM);
                    $absencestg->Deconnexion();
                    $f = $fo[0];
                    $m = $data[0];
                }
                echo "<tr>
                    <td>".htmlspecialchars($f)."</td>
                    <td>".htmlspecialchars($m)."</td>
                    <td>" . GetHeureSeance($con[4]) . "</td>
                    <td>".htmlspecialchars($con[2])."</td>
                    <td>".htmlspecialchars($con[6])."</td>
                    </tr>";
            }
        }
        echo   "</table>";
    } else {
        echo "<div class='text-center m-5'>  <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";
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
                echo "<option selected value='".htmlspecialchars($stagiaire[0])."'>".htmlspecialchars($stagiaire[1]." ".$stagiaire[2])."</option>";
            else
                echo "<option value='".htmlspecialchars($stagiaire[0])."'>".htmlspecialchars($stagiaire[1] ." ".$stagiaire[2])."</option>";
        }
    }

    echo  "</select>
            </div>
           </div>
         </div>";
    $Absence = [0];
    $Retard = [0];
    if (isset($_SESSION["userFormateur"])) {
        if ($grp == "choisir" && isset($_SESSION["userFormateur"])) {
            $Absence = [0];
            $Retard = [0];
        }
    } else {
        if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
            $Absence = $absencestg->GetSatatistiqueBySecteur($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "A", $_SESSION["Admin"]["secteur"]);
            $Retard = $absencestg->GetSatatistiqueBySecteur($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "R", $_SESSION["Admin"]["secteur"]);
        } else {
            $Absence = $absencestg->GetSatatistique($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "A");
            $Retard = $absencestg->GetSatatistique($dtD, $dtF, $seance, $grp, $stg, $AnneeFr, $CodeEtab, "R");
        }
    }

    echo "<div class='container'>
            <div class='row mt-3 nb_statistique'>
                <div class='col-6 statistique  text-center'>
                    <div class='alert alert-info '>
                        <span class='h5 title'>Les absences : </span>
                        <span id='nbA' class='m-5 nb_stat'>".htmlspecialchars($Absence[0])."</span>
                        <span onclick='Detail(\"A\")'><img class='icon' src='../Images/Icon_Find.png'/></span>
                
                    </div>
                </div>
                <div class='col-6 statistique  text-center'>
                    <div class='alert alert-primary'>
                        <span class='h5 title'>Les retards :</span>
                        <span id='nbR' class='m-5 nb_stat'>".htmlspecialchars($Retard[0])."</span>
                        <span onclick='Detail(\"R\")'><img class='icon' src='../Images/Icon_Find.png'/></span>
                    </div>
                </div>
            </div>
        </div>";

    echo "  <div id='informations' class='m-5'>";
    if ($dtD != "" && $dtF != "" && $seance == "choisir" && $grp == "choisir" &&  $stg == "choisir") {
        if (isset($_SESSION["Admin"])) {
            $TopAbsenceStagiaire = $absencestg->GetTopAbsenceStagiaire($dtD, $dtF, "A", $AnneeFr, $CodeEtab);
            $top10 = [];
            foreach ($TopAbsenceStagiaire as $stg) {

                if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
                    if ($stg[6] == $_SESSION["Admin"]["secteur"]) {
                        $top10[] = $stg;
                    }
                } else {
                    $top10[] = $stg;
                }
            }
            echo "           <div>
                            <div class='h3 text-primary'>Absences Stagiaire : Top 10 </div>
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

            foreach ($top10 as $stg) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($stg[0])."</td>";
                echo "<td>".htmlspecialchars($stg[1])."</td>";
                echo "<td>".htmlspecialchars($stg[2])."</td>";
                echo "<td>".htmlspecialchars($stg[3])."</td>";
                echo "<td>".htmlspecialchars($stg[4])."</td>";
                echo "<td>".htmlspecialchars($stg[5])."</td>";
                echo "</tr>";
            }
            echo "</tbody>
                </table>";
        }
    }
    echo "</div>";
} else {
    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    $datedebut = $AnneeFr . "-09-01";
    $Absence = [0];
    $Retard = [0];
    if (isset($_SESSION["Admin"])) {
        if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
            $Absence = $absencestg->GetSatatistiqueBySecteur($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "A", $_SESSION["Admin"]["secteur"]);
            $Retard = $absencestg->GetSatatistiqueBySecteur($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "R", $_SESSION["Admin"]["secteur"]);
        } else {
            $Absence = $absencestg->GetSatatistique($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "A");
            $Retard = $absencestg->GetSatatistique($datedebut, $sysdate, "choisir", "choisir", "choisir", $AnneeFr, $CodeEtab, "R");
        }
        $TopAbsenceStagiaire = $absencestg->GetTopAbsenceStagiaire($datedebut, $sysdate, "A", $AnneeFr, $CodeEtab);
    }
    require "../View/V_ConsulterAbsenceStagiaire.php";
}
