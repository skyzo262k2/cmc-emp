<?php

session_start();
require '../Model/M_Surveille.php';

if (!isset($_SESSION["Admin"]) || !$_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$surveille=new Surveille();
$surveille->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$mat=$_SESSION["Admin"]["Matricule"];
$nom=$_SESSION["Admin"]["Nom"];
$prenom=$_SESSION["Admin"]["Prenom"];

if(isset($_POST['valider'])){
        if($_POST['MotN']==$_POST['MotC']):
            $surveille->Matricule = $mat;
            $surveille->Password =  password_hash($_POST['MotN'],PASSWORD_DEFAULT);
            $surveille->ModifierMotePasse();
        endif;
}
require '../View/V_ProfilSurveille.php';