<?php
require "../Model/M_Groupe.php";
require "../Model/M_Pagination.php";

$info = "";
$page = new Pagination();
session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}


$groupe = new Groupe();
$groupe->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];

if (!isset($_GET["get"])) {
    $_GET["get"] = 1;
}

if (isset($_POST["sup"])) {
    $groupe->CodeGrp = $_POST["sup"];
    $groupe->DeleteGroupe();
}

if (isset($_POST["btnAjouter"])) {
    if ((!empty($_POST["tCodeGrp"]) and !empty($_POST["tCodeFlr"])) && ($_POST["tCodeFlr"] != "choisir" and $_POST["tAnnee"] != "choisir")) {
        $groupe->CodeGrp = $_POST["tCodeGrp"];
        $groupe->CodeFlr = $_POST["tCodeFlr"];
        $groupe->Annee = $_POST["tAnnee"];
        $groupe->Fpa = $_POST["tFPA"];
        // if ($_SESSION['Etablissement']['TauxFPA'] == "100") {
        //     $groupe->Fpa = "N";
        // } else {
        //     $groupe->Fpa = "O";
        // }
        $boolAdd = $groupe->AddGroupe();
    }
}
// In Modify Button we don't need to check empty, because values are "disabled".
// codeGrp is the one "disabled". CodeEtab is already stocked in $_SESSION

if (isset($_POST["btnModifier"])) {
    if ((!empty($_POST["tCodeGrp"]) and !empty($_POST["tCodeFlr"])) && ($_POST["tCodeFlr"] != "choisir" and $_POST["tAnnee"] != "choisir")) {
        $groupe->CodeGrp = $_POST["tCodeGrp"];
        $groupe->CodeFlr = $_POST["tCodeFlr"];
        $groupe->Annee = $_POST["tAnnee"];
        $groupe->Fpa = $_POST["tFPA"];
        // Fix TauxFPA
        // if ($_SESSION['Etablissement']['TauxFPA'] == "100") {
        //     $groupe->Fpa = "N";
        // } else {
        //     $groupe->Fpa = "O";
        // }
        $boolAdd = $groupe->UpdateGroupe();
    }
}

if (isset($_POST["btnSupprimer"])) {
    $boolSpAll = $groupe->DeleteAllGroupes();
}

$groupe->connexion();
$Filiers = $groupe::$cnx->query("call GetAllFiliere()")->fetchall();
$groupe->Deconnexion();



$tblName = "G";


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfogroupe"] = $info;
    if ($info == "") {
        $_SESSION['Groupe'] = $groupe->GetAllGroupe();
    } else {
        $groupe->connexion();
        $_SESSION['Groupe'] = $groupe::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$groupe->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
    }


    echo "
    <div class='pagi_sup'>

        <div class='pagination'>
            ";
    $groupes = $page->Pagination_Btn($_SESSION['Groupe'], $_GET['get']);
    $page->Pagination_Nb($groupes, $_GET['get']);

    echo "  </div>
        <div class='deleteAll'>
            <form action='' method='post'>
                <input type='submit' value='Supprimer tous' name='btnSupprimer' class='btn btn-primary end-0' onclick='return confirm('Tu es Sure pour Supprimer Tous ?')' id='btnSupprimer'>
            </form>
        </div>

    </div>

    <div class='table-affiche'>

        <table class='table table-striped table-sm table-bordered'>
            <thead>
                <tr class='table-success'>
                    <th scope='col'>Code Groupe</th>
                    <th scope='col'>Code Filiere</th>
                    <th scope='col'>Annee</th>
                    <th scope='col'>Fpa</th>
                    <th scope='col'>Action</th>
                </tr>
            </thead>
                <tbody>";
    $page->GetTablePage($_SESSION['Groupe'], $_GET['get']);

    echo "   </tbody>
        </table>
    </div>";
} else {
    if (isset($_SESSION["rechinfogroupe"])) {
        $info = $_SESSION["rechinfogroupe"];
        if ($info == "") {
            $_SESSION['Groupe'] = $groupe->GetAllGroupe();
        } else {
            $groupe->connexion();
            $_SESSION['Groupe'] = $groupe::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$groupe->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $_SESSION['Groupe'] = $groupe->GetAllGroupe();
    }
    require "../View/V_Groupe.php";
}
