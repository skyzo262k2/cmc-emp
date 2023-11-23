<?php
require '../Model/M_Groupe_Fomateur_Affecter.php';

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}
$tauxfpaGrp = $Fpa = "";

$empG = new Groupe_fomateur_affecter();
$codetb = $_SESSION['Etablissement']['CodeEtb'];
$anne = explode('/', $_SESSION['Annee']);

if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur') {
    $Groupes = $empG->GetGroupes($codetb, $anne[0]);
} else {
    $Groupes = $empG->GetGroupesSecteur($codetb, $_SESSION['Admin']['secteur']);
}
$anneGrp = $lien = "";



if (isset($_POST['group']) and $_POST['group'] != "choisir groupe") {
    $inf = explode('/', $_POST['group']);
    $grp = $inf[0];
    $flr = $inf[1];
    $anneGrp = $inf[2];
    $Fpa = $inf[3];
    $tauxfpaGrp = $inf[4];

    $groupe = $empG->GetFormateur_Affecter_groupe($grp, $flr, $codetb, $anne[0]);
    $ModuleNoaffe = $empG->GetModule_NoAffecter($grp, $flr, $codetb, $anne[0], $inf[2]);

    $lien = "<a href='../Controller/C_PDF_Affectation_Grp.php?grp=".htmlspecialchars($grp)."'> ".htmlspecialchars($grp)."
        <img src='../Images/pdf.png' alt='not found' style='width: 35px;height: 35px;'>
        </a>";
}else{
    $grp  = "choisir groupe";
}
require "../View/V_Groupe_Fomateur_Affecter.php";
