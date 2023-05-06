<?php
require "../Model/M_EFM.php";
require '../Model/PDF.php';
                            

session_start();
if (!isset($_SESSION["userFormateur"])) {
    header("location:../Controller/C_Login.php");
}

$efm = new EFM();
if (isset($_GET['efm'])) {
    $efm->id = $_GET['efm'];
    $Etab = $_SESSION["Etablissement"]["DescpFr"];
    $anne = explode("/",$_SESSION["Annee"]);
    $efm->Etab = $_SESSION["Etablissement"]["CodeEtb"];
    $efm->AnneeFr =  $anne[0];
    $pdf = new FPDF('P', 'mm', 'A4');


    $Informations = $efm->DetailEFM();
    $validateur = $efm->NomPrenomFormateur($Informations[9]);
    $efm->matricule = $Informations[1];
    $Informations[1] = $_SESSION['userFormateur']["Nom"]." ".$_SESSION['userFormateur']["Prenom"];
    $Informations[9] = $validateur[0];
    $efm->module = $Informations[3];
    $efm->groupe = $Informations[2];
    $avancement = $efm->AvancementAffectation();
    // print_r($Informations[1]);
    
    $Informations[] = $avancement;
    $page = new Proposition_EFM($pdf, $Etab, $_SESSION["Annee"], $Informations);

    $page->pdf->AddPage();
    $page->AddPagePDF();
    $page->AfficherPDF();
}
else{
    header("location:../Controller/C_Login.php");
}