<?php

require "../Model/M_EFM.php";
session_start();

$efm = new EFM();
$efm->matricule = $_SESSION['userFormateur']["Matricule"];
$annees = explode("/", $_SESSION["Annee"]);
$efm->AnneeFr = $annees[0];
$efm->Etab = $_SESSION['Etablissement']["CodeEtb"];

$Groupes = $efm->GroupeAffecterByFormateurAnneeEtab();

$message = "";

if (isset($_POST["add"])) {
    // print_r($_POST);
    if ($_POST["Groupe"] != "choisir" && $_POST["CodeModule"] != "choisir" && !empty($_FILES['fileurl']['name']) && isset($_POST['typeEFM'])) {
        $name_exten = explode(".", $_FILES['fileurl']['name']);
        if ($name_exten[1] == "pdf") {
            $efm->groupe = $_POST["Groupe"];
            $efm->module = $_POST["CodeModule"];
            $efm->typeEFM = $_POST["typeEFM"];
            $flr = $efm->GetFiliereByGrpAndModule();
            $efm->CodeFlr = $flr[0];
            if(!file_exists("../EFM/".$efm->Etab)){
                mkdir("../EFM/".$efm->Etab);
            }
            if(!file_exists("../EFM/".$efm->Etab."/".$efm->AnneeFr)){
                mkdir("../EFM/".$efm->Etab."/".$efm->AnneeFr);
            }
            if(!file_exists("../EFM/".$efm->Etab."/".$efm->AnneeFr."/".$efm->groupe)){
                mkdir("../EFM/".$efm->Etab."/".$efm->AnneeFr."/".$efm->groupe);
            }

            $efm->url = "EFM/" .$efm->Etab."/".$efm->AnneeFr."/".$efm->groupe."/".$efm->module . "_" . $_SESSION['userFormateur']["Nom"]. "_" .$_SESSION['userFormateur']["Prenom"].  "." . $name_exten[1];
            $n = $efm->Add();
            if ($n) {
                move_uploaded_file($_FILES['fileurl']['tmp_name'], "../EFM/" . $efm->Etab."/".$efm->AnneeFr."/".$efm->groupe ."/". $efm->module . "_" . $_SESSION['userFormateur']["Nom"]. "_" .$_SESSION['userFormateur']["Prenom"]. "." . $name_exten[1]);
            }
        } else 
            $message = "Il doit le fichier PDF";
    } else {
        $message = "Tous les champs Obligatoires";
    }
}
if (isset($_POST["id"])) {
    $efm->id = $_POST["id"];
    $url = $efm->GetURLforDelete();
    // echo $url[0];
    $n = $efm->Delete();
    if ($n) {
        unlink("../" . $url[0]);
    }
    $EFMS = $efm->GetEFMByFormateurAnneeEtab();
    $efm->Showtable($EFMS);
} elseif (isset($_POST["groupe"])) {
    // echo $_POST["groupe"];
    $efm->groupe = $_POST["groupe"];
    $Modules = $efm->ModuleAffecterByGroupeFormateurAnneeEtab();
    print_r($Modules);
    echo "<option value='choisir'>Choisir Code Module</option>";
    foreach ($Modules as $md) {
        echo "<option value='$md[0]'>$md[1]</option>";
    }
} else {
    $EFMS = $efm->GetEFMByFormateurAnneeEtab();
    // print_r($EFMS);
    require "../View/V_Gestion_EFM.php";
}
