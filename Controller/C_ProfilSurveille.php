<?php

session_start();
require '../Model/M_Surveille.php';

if (!isset($_SESSION["Admin"]) || !$_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

function message($message, $mode)
{
    return "<div class='alert alert-" . htmlspecialchars($mode) . " alert-dismissible fade show m-2'>" .
        htmlspecialchars($message) .
        "</div>";
}
$message = "";
$surveille = new Surveille();
$surveille->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$mat = $_SESSION["Admin"]["Matricule"];
$nom = $_SESSION["Admin"]["Nom"];
$prenom = $_SESSION["Admin"]["Prenom"];

if (isset($_POST['valider'])) {
    $old = $_POST["motA"];
    $new = $_POST['MotN'];
    $confirm = $_POST['MotC'];
    $codeuser = $_SESSION["Admin"]["CodeUser"];
    $surveille->connexion();
    $user = Surveille::$cnx->query("select * from user where CodeUser = '$codeuser'")->fetch(PDO::FETCH_ASSOC);
    $surveille->Deconnexion();
    if (password_verify($old, $user["Mdp"])) {
        if ($new == $confirm) {
            $surveille->Matricule = $mat;
            $surveille->Password =  password_hash($_POST['MotN'], PASSWORD_DEFAULT);
            $surveille->ModifierMotePasse();

            $message = message("Mot de passe a été modifié avec succés", "primary");
        } else
            $message = message("confirmer mot de passe", "danger");
    } else
        $message = message("Mot de passe actual est incorrect", "danger");
}
require '../View/V_ProfilSurveille.php';
