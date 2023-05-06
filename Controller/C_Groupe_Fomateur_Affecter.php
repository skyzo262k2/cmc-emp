<?php
require '../Model/M_Groupe_Fomateur_Affecter.php';

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$empG = new Groupe_fomateur_affecter();
$codetb = $_SESSION['Etablissement']['CodeEtb'];
$anne = explode('/', $_SESSION['Annee']);
$Groupes = $empG->GetGroupes($codetb, $anne[0]);
$anneGrp = $lien = "";



if (isset($_POST['group']) and $_POST['group'] != "") {
    $inf = explode('/', $_POST['group']);
    $grp = $inf[0];
    $flr = $inf[1];
    $anneGrp = $inf[2];
    $groupe = $empG->GetFormateur_Affecter_groupe($grp, $flr, $codetb, $anne[0]);
    $ModuleNoaffe = $empG->GetModule_NoAffecter($grp, $flr, $codetb, $anne[0], $inf[2]);
    $lien = "<a href='../Controller/C_PDF_Affectation_Grp.php?grp=$grp'> 
        <img src='../Images/pdf.png' alt='not found' style='width: 35px;height: 35px;'>$grp
        </a>";
}
require "../View/V_Groupe_Fomateur_Affecter.php";