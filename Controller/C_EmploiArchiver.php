<?php
require "../Model/M_EmploiArchiver.php";


session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$empA=new Emploi_archiver();
$codetb=$_SESSION['Etablissement']['CodeEtb'];
$anne=explode('/',$_SESSION['Annee']);

$disabled="disabled";
$Mois=$empA->Mois($codetb,$anne[0]);



if(isset($_POST['mois']) && $_POST['mois']!=""):
    $mois=$_POST['mois'];
    $disabled="";
    $Groupes=$empA->GetGroupes($codetb,$anne[0],$_POST['mois']);
endif;

if(isset($_POST['group']) && $_POST['group']!="")
{
    $mois=$_POST['mois'];
    $grp=$_POST['group'];
    $emploiA=$empA->getEmploigroup($grp,$codetb,$anne[0],$mois);
    $json=json_encode($emploiA);
}

require "../View/V_EmploiArchiver.php";
?>