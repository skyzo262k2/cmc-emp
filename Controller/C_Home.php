<?php

session_start();
require '../Model/M_Validateur.php';
if (isset($_POST["btnDeconnexion"])) {
    session_unset();
    session_destroy();
}

$data=[];

if (isset($_SESSION["Admin"])){
    $user = $_SESSION["Admin"];
    $nom = $user['Nom'];
    $prenom = $user['Prenom'];
    $poste = $user['Poste'];
    $annee = $_SESSION["Annee"];
    $etab = $_SESSION["Etablissement"];
}
elseif (isset($_SESSION['userFormateur'])) {
    $user = $_SESSION["userFormateur"];
    $nom = $user['Nom'];
    $prenom = $user['Prenom'];
    $poste = 'formateur';
    $annee = $_SESSION["Annee"];
    $etab = $_SESSION["Etablissement"];
    $validateur=new Validateur();
    $data=$validateur->validateur($_SESSION["userFormateur"]['Matricule']);
}
else{
    header("location:../Controller/Connexion");
}

require "../View/V_Home.php";
?>