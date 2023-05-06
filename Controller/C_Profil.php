<?php

require "../Model/M_Connexion.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}


$conx = new Connexion();
$conx->connexion();


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


if (isset($_POST["change"])) {
    $old = $_POST["passold"];
    $new = $_POST["passnew"];
    $codeuser = $_SESSION["Admin"]["CodeUser"];
    $user = Connexion::$cnx->query("select * from user where CodeUser = '$codeuser'")->fetch(PDO::FETCH_ASSOC);
    if ($user["Mdp"] == $old) {
        Connexion::$cnx->query("update user set Mdp = '$new' where CodeUser = '$codeuser'");
    } else {
        echo "<script>alert('Mot de passe actuel non correct')</script>";
    }
}


if (isset($_POST['btnAjouterAnnee'])) {

    try {
        Connexion::$cnx->query("INSERT INTO Annee VALUES ('{$_POST['btnAjouterAnnee']}')");
    } catch (Exception) {
        $message = "Error";
    }
    $conx->Deconnexion();
}




if (isset($_POST["sauvgarder"])) {
    $matold = $_POST["matold"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $poste = $_POST["poste"];
    $codeetabold = $_POST["codeetabold"];
    $descp = $_POST["descp"];
    $ville = $_POST["ville"];
    $tauxfpa = $_POST["tauxfpa"];
    $semanne = $_POST["semanne"];

    if (isset($_POST["mat"]) && isset($_POST["codeetab"])) {
       
        $codeetab = $_POST["codeetab"];
        $mat = $_POST["mat"];
        $n = Connexion::$cnx->exec("update personnel set Matricule = '$mat',Nom = '$nom', Prenom = '$prenom',Poste = '$poste' where Matricule = '$matold'");
        $m = Connexion::$cnx->exec("update Etablissement set CodeEtb = '$codeetab',Ville = '$ville',DescpFr = '$descp',TauxFPA = '$tauxfpa',Sem_Annee = '$semanne' where CodeEtb = '$codeetabold'");
        if ($n || $m) {
            $_SESSION["Admin"] = $conx::$cnx->query("SELECT * FROM personnel WHERE matricule = '$mat'")->fetch(PDO::FETCH_ASSOC);
            $_SESSION["Etablissement"] = $conx::$cnx->query("SELECT * FROM etablissement WHERE CodeEtb='$codeetab'")->fetch(PDO::FETCH_ASSOC);
         
        }
    }
}
$user = $_SESSION["Admin"];
$etab = $_SESSION["Etablissement"];




require "../View/V_Profil.php";
