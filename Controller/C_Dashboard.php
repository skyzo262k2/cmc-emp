<?php
require "../Model/M_Module.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}


$cnnx = new Connexion();

$CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
$anne = explode("/", $_SESSION['Annee']);

if (isset($_GET['get'])) {
    
    $dates = [];
    $absences1 = [];
    $cnnx->connexion();
    $dixjours = $cnnx::$cnx->query("call SP_DixDernieresJoursAbsenceStg('$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);

    foreach($dixjours as $jour){
        $dates[]=$jour[0];
        $absences1[] = $jour[1];
    }
    
    $data = array(
        'labels' => $dates,
        'datasets' => array(
            array(
                'label' => 'Absence Stagiaire',
                'data' => $absences1,
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ),
            // array(
            //     'label' => 'Absence Formateur',
            //     'data' => $absences2,
            //     'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
            //     'borderColor' => 'rgba(255, 99, 132, 1)',
            //     'borderWidth' => 1
            // )
        )
    );
    echo json_encode($data);
} else {
    $cnnx->connexion();
    $nbfrm = $cnnx::$cnx->query("call SP_NbFormateurByEtab('$CodeEtab')")->fetch(PDO::FETCH_NUM);
    $nbgrp = $cnnx::$cnx->query("call SP_NbGroupeByEtab('$CodeEtab')")->fetch(PDO::FETCH_NUM);
    $nbsalle = $cnnx::$cnx->query("call SP_NbSalleByEtab('$CodeEtab')")->fetch(PDO::FETCH_NUM);
    $nbmodule1 = $cnnx::$cnx->query("call SP_NbModuleByAnne(1)")->fetch(PDO::FETCH_NUM);
    $nbmodule2 = $cnnx::$cnx->query("call SP_NbModuleByAnne(2)")->fetch(PDO::FETCH_NUM);
    $nbstg = $cnnx::$cnx->query("call SP_NbStagiaireByEtabAnne('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $nbGrpNonAffecter = $cnnx::$cnx->query("call SP_NBGroupesNonTermineAffectation('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $nbGrpNonEmploi = $cnnx::$cnx->query("call SP_NbGroupeNonEmploi('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $nbFrmNonAffectation = $cnnx::$cnx->query("call SP_NbFormateurNonAffectation('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $nbAbsenceStg = $cnnx::$cnx->query("call SP_TotalAbsenceStg('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $nbAbsenceFrm = $cnnx::$cnx->query("call SP_TotalAbsenceFormateur('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $TauxAvan = $cnnx::$cnx->query("call SP_TauxAvancementByEtabAnneF('$CodeEtab','$anne[0]')")->fetch(PDO::FETCH_NUM);
    $cnnx->Deconnexion();
   
    require "../View/V_Dashboard.php";
}
