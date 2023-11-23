<?php

require "../Model/M_Connexion.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

function message($message, $mode)
{
    return "<div class='alert alert-" . htmlspecialchars($mode) . " alert-dismissible fade show w-100 m-2'>" .
        htmlspecialchars($message) .
        "</div>";
}

$conx = new Connexion();
$message = "";



$conx->connexion();


if (isset($_POST["change"])) {
    $old = $_POST["passold"];
    $new = $_POST["passnew"];
    $codeuser = $_SESSION["Admin"]["CodeUser"];
    $user = Connexion::$cnx->query("select * from user where CodeUser = '$codeuser'")->fetch(PDO::FETCH_ASSOC);
    if (password_verify($old, $user["Mdp"])) {
        $password_hash = password_hash($new, PASSWORD_DEFAULT);
        $n = Connexion::$cnx->query("update user set Mdp = '$password_hash' where CodeUser = '$codeuser'");
        if ($n)
            $message = message("Mot de passe a été modifié avec succés", "primary");
    } else {
        $message = message("Mot de passe actual est incorrect", "danger");
    }
}


if (isset($_POST['btnAjouterAnnee'])) {
    try {
       $n = Connexion::$cnx->query("INSERT INTO Annee VALUES ('{$_POST['btnAjouterAnnee']}')");
        if ($n)
        $message = message("Année Prochaine a été ajoutée avec succés", "primary");
    } catch (Exception) {
        $message = "Error";
    }
}




if (isset($_POST["sauvgarder"])) {
    if ($_POST["codeetab"] != "" && $_POST["semanne"] != "") {
        $codeetab = $_POST["codeetab"];
        $descp = $_POST["descp"];
        $ville = $_POST["ville"];
        $semanne = $_POST["semanne"];
        $m = Connexion::$cnx->exec("update Etablissement set Ville = '$ville',DescpFr = '$descp',Sem_Annee = '$semanne' where CodeEtb = '$codeetab'");
        if ($m) {
            $message = message("Les informations a été sauvgarder avec succès", "primary");
            $_SESSION["Etablissement"] = $conx::$cnx->query("SELECT * FROM etablissement WHERE CodeEtb='$codeetab'")->fetch(PDO::FETCH_ASSOC);
        }
    }
}
$user = $_SESSION["Admin"];
$etab = $_SESSION["Etablissement"];

$PAnne = 0;
if (intval(date('m')) >= 1 && intval(date('m')) <= 7)
    $PAnne = intval(date('Y'));
else $PAnne = intval(date('Y')) + 1;
$anne = Connexion::$cnx->query("select * from Annee where annee = '$PAnne'")->fetch();
if ($anne == null) {
    $btn = "";
    $mes = "";
} else {
    $btn = "disabled";
    $mes = "Année prochaine est déjà existe";
}



$conx->Deconnexion();
require "../View/V_Profil.php";
