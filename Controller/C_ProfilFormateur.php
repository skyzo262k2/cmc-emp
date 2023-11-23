<?php

session_start();
require '../Model/M_ProfilFormateur.php';
if (!isset($_SESSION["userFormateur"]))
        header("location:../Controller/C_Login.php");


function message($message, $mode)
{
        return "<div class='alert alert-" . htmlspecialchars($mode) . " alert-dismissible fade show m-2'>" .
                htmlspecialchars($message) .
                "</div>";
}
$message = "";
$prf = new ProfileFormateur();
$mat = $_SESSION["userFormateur"]["Matricule"];
$nom = $_SESSION["userFormateur"]["Nom"];
$prenom = $_SESSION["userFormateur"]["Prenom"];

if (isset($_POST['valider'])) {
        $old = $_POST["motA"];
        $new = $_POST['MotN'];
        $confirm = $_POST['MotC'];
        $prf->connexion();
        $for = ProfileFormateur::$cnx->query("select * from formateur where matricule = '$mat'")->fetch(PDO::FETCH_ASSOC);
        $prf->Deconnexion();
        if (password_verify($old, $for["Mdp"])) {
                if ($new == $confirm) {
                        $hash = password_hash($new, PASSWORD_DEFAULT);
                        $prf->connexion();
                        $n = ProfileFormateur::$cnx->exec("update formateur set Mdp='$hash' where matricule = '$mat'");
                        $prf->Deconnexion();
                        if ($n)
                                $message = message("Mot de passe a été modifié avec succés", "primary");
                } else
                        $message = message("confirmer mot de passe", "danger");
        } else
                $message = message("Mot de passe actual est incorrect", "danger");
}

require '../View/V_ProfilFormateur.php';
