<?php
require "../Model/M_Connexion.php";

$conx = new Connexion();
$conx->connexion();
$login = "";
$password = "";
$Annee = "";
$erreurlogin = "";
$erreurpassword = "";
$erreuranne = "";
$Annees = $conx::$cnx->query("SELECT * FROM Annee ORDER BY annee DESC")->fetchAll(PDO::FETCH_NUM);
if (isset($_POST["btnConnecte"])) {
    session_start();
    $login = $_POST["tlogin"];
    $password = $_POST["tPassword"];
    $Annee = $_POST["tAnnee"];
    if (!empty($login) and !empty($password) and $Annee != "choisir") {
        $conx->connexion();
        $st = Connexion::$cnx->prepare("SELECT * FROM User WHERE login = :login");
        $st->bindParam(":login", $login);
        $st->execute();
        $Admin = $st->fetch();
        if($Admin){
            if(password_verify($password, $Admin[2])) {
                $user = $conx::$cnx->query("SELECT * FROM personnel WHERE CodeUser = '$Admin[0]'")->fetch(PDO::FETCH_ASSOC);
                $_SESSION["Admin"] = $user;
                $_SESSION["Annee"] = $Annee;
                $CodeEtab = $user['CodeEtab'];
                $Etab = $conx::$cnx->query("SELECT * FROM etablissement WHERE CodeEtb='$CodeEtab'")->fetch(PDO::FETCH_ASSOC);
                $_SESSION["Etablissement"] = $Etab;        
                header("location:../Controller/C_Home.php");
            } else
                $erreurpassword = "Login or Password incorrect";
        } else {
            $st = Connexion::$cnx->prepare("SELECT * FROM formateur WHERE Matricule = ?");
            $st->execute([$login]);
            $bol = $st->fetch(PDO::FETCH_ASSOC);
            if ($bol && password_verify($password,$bol['Mdp'])){
                $_SESSION["userFormateur"] = $bol;
                $_SESSION["Annee"] = $Annee;
                $CodeEtab = $bol['CodeEtab'];
                $Etab = $conx::$cnx->query("SELECT * FROM etablissement WHERE CodeEtb='$CodeEtab'")->fetch(PDO::FETCH_ASSOC);
                $_SESSION["Etablissement"] = $Etab;
                header("location:../Controller/C_Home.php");
            }
            $erreurpassword = "Login or Password incorrect";
        }
    } else {
        $erreuranne = "faut choisir année";
    }
}
$conx->Deconnexion();
require "../View/V_Login.php";
