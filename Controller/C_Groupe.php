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

$message = "";
if (!isset($_GET["get"])) {
    $_GET["get"] = 1;
}

if (isset($_POST["sup"])) {
    $groupe->CodeGrp = $_POST["sup"];
    $n = $groupe->DeleteGroupe();
    if ($n)
        $message = $page->message("Groupe a été supprimé avec succès", "danger");
}

if (isset($_POST["btnAjouter"])) {
    if ((!empty($_POST["tCodeGrp"]) and !empty($_POST["tCodeFlr"])) && ($_POST["tCodeFlr"] != "choisir" and $_POST["tAnnee"] != "choisir")) {
        $groupe->CodeGrp = $_POST["tCodeGrp"];
        $groupe->CodeFlr = $_POST["tCodeFlr"];
        $groupe->Annee = $_POST["tAnnee"];
        $groupe->Fpa = $_POST["tFPA"];
        if (isset($_POST["tTauxFPA"])) {
            $groupe->taux = $_POST["tTauxFPA"];
        } else {
            $groupe->taux = 100;
        }
        $n = $groupe->AddGroupe();
        if ($n)
            $message = $page->message("Groupe a été ajouté avec succès", "primary");
    }
}

if (isset($_POST["btnModifier"])) {
    if ((!empty($_POST["tCodeGrp"]) and !empty($_POST["tCodeFlr"])) && ($_POST["tCodeFlr"] != "choisir" and $_POST["tAnnee"] != "choisir")) {
        $groupe->CodeGrp = $_POST["tCodeGrp"];
        $groupe->CodeFlr = $_POST["tCodeFlr"];
        $groupe->Annee = $_POST["tAnnee"];
        $groupe->Fpa = $_POST["tFPA"];
        if (isset($_POST["tTauxFPA"])) {
            $groupe->taux = $_POST["tTauxFPA"];
        } else {
            $groupe->taux = 100;
        }
        $n = $groupe->UpdateGroupe();
        if ($n)
            $message = $page->message("groupe a été modifé avec succès", "primary");
    }
}

if (isset($_POST["btnSupprimer"])) {
    $n = $groupe->DeleteAllGroupes();
    if ($n)
        $message = $page->message("groupes a été supprimés avec succès", "danger");
}

$groupe->connexion();
$Filiers = $groupe::$cnx->query("call GetAllFiliere()")->fetchall();
$groupe->Deconnexion();



$tblName = "G";


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfogroupe"] = $info;
    if ($info == "") {
        $toutgroupes = $groupe->GetAllGroupe();
    } else {
        $groupe->connexion();
        $toutgroupes = $groupe::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$groupe->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
    }

    $_SESSION['Groupe'] = [];
    if ($_SESSION["Admin"]["Poste"] ==  "ChefSecteur") {
        foreach ($toutgroupes as $g) {
            if ($g["CodeSect"] == $_SESSION["Admin"]["secteur"]) {
                $_SESSION['Groupe'][] = [$g['CodeGrp'], $g['CodeFlr'], $g['Annee'], $g['Fpa'], $g['taux']];
            }
        }
    } else {
        foreach ($toutgroupes as $g) {
            $_SESSION['Groupe'][] = [$g['CodeGrp'], $g['CodeFlr'], $g['Annee'], $g['Fpa'], $g['taux']];
        }
    }



    if (count($_SESSION["Groupe"]) > 0) {
        echo "
    <div class='pagi_sup'>

        <div class='pagination'>
            ";
        $groupes = $page->Pagination_Btn($_SESSION['Groupe'], $_GET['get']);
        $page->Pagination_Nb($groupes, $_GET['get']);

        echo "  </div>
        <div class='deleteAll'>
            <form action='' method='post'>
                <input type='submit' value='Supprimer tous' name='btnSupprimer' class='btn btn-primary end-0' onclick='return confirm(`Tu es Sure pour Supprimer Tous ?`)' id='btnSupprimer'>
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
                    <th scope='col'>Taux</th>
                    <th scope='col'>Action</th>
                </tr>
            </thead>
                <tbody>";
        $page->GetTablePage($_SESSION['Groupe'], $_GET['get']);

        echo "   </tbody>
        </table>
    </div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfogroupe"])) {
        $info = $_SESSION["rechinfogroupe"];
        if ($info == "") {
            $toutgroupes = $groupe->GetAllGroupe();
        } else {
            $groupe->connexion();
            $toutgroupes = $groupe::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$groupe->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $toutgroupes = $groupe->GetAllGroupe();
    }
    $_SESSION['Groupe'] = [];
    if ($_SESSION["Admin"]["Poste"] ==  "ChefSecteur") {
        foreach ($toutgroupes as $g) {
            if ($g["CodeSect"] == $_SESSION["Admin"]["secteur"]) {
                $_SESSION['Groupe'][] = [$g['CodeGrp'], $g['CodeFlr'], $g['Annee'], $g['Fpa'], $g['taux']];
            }
        }
    } else {
        foreach ($toutgroupes as $g) {
            $_SESSION['Groupe'][] = [$g['CodeGrp'], $g['CodeFlr'], $g['Annee'], $g['Fpa'], $g['taux']];
        }
    }
    require "../View/V_Groupe.php";
}
