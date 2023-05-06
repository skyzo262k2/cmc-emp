<?php
require "../Model/M_Valider.php";

session_start();

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    if (!isset($_SESSION["userFormateur"]))
        header("location:../Controller/C_Login.php");
}


$annes = explode("/", $_SESSION["Annee"]);
$anne = $annes[0];

$valider = new Valider();
$valider->CodeEtab = $_SESSION["userFormateur"]["CodeEtab"];
$valider->annefr = $anne;
$valider->matricule = $_SESSION["userFormateur"]["Matricule"];
$Efms=$valider->GetEfmAValider();

if(isset($_POST['valider'])){
    $validers=json_decode($_POST['valider']);
    $validers[]=$_SESSION["userFormateur"]["Matricule"];
    $n=$valider->Valider($validers);
    echo $n;
}

if(isset($_POST['id_efm'])){
    $Efm=$valider->RecupererEfm($_POST['id_efm']);
    echo json_encode($Efm);
}

if(isset($_POST['remarque'])){
    $validers=explode('/',$_POST['remarque']);
    $validers[]=$_SESSION["userFormateur"]["CodeEtab"];
    $validers[]=$anne;
    $valider->Remarque($validers);
}

if(!isset($_POST['valider']) && !isset($_POST['remarque']) && !isset($_POST['id_efm']))
    require "../View/V_Valider.php";