<?php
require "../Model/M_Secteur.php";
require "../Model/M_Pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}


$info = "";

$secteur = new Secteur();
$page = new Pagination();
$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];


$message = "";

if (!isset($_GET['get'])) {
    $_GET['get'] = 1;
}



if (isset($_POST["sup"])) {
    $secteur->CodeSect = $_POST["sup"];
    $n = $secteur->DeleteSecteur();
    if ($n)
        $message = $page->message("Secteur a été supprimé avec succès", "danger");
}

if (isset($_POST["btnAjouter"])) {
    if ((!empty($_POST['tSect']) and !empty($_POST['tDescp']))) {
        $secteur->CodeSect = $_POST["tSect"];
        $secteur->DescpSect = $_POST["tDescp"];
        $n = $secteur->AddSecteur();
        if ($n)
            $message = $page->message("Secteur a été ajouté avec succès", "primary");
    }
}


if (isset($_POST["btnModifier"])) {
    if ((!empty($_POST['tSect']) and !empty($_POST['tDescp']))) {
        $secteur->CodeSect = $_POST["tSect"];
        $secteur->DescpSect = $_POST["tDescp"];
        $n = $secteur->UpdateSecteur();
        if ($n)
            $message = $page->message("Secteur a été modifié avec succès", "primary");
    }
}

if (isset($_POST["btnSupprimer"])) {
    $n = $secteur->DeleteAllSecteurs();
    if ($n)
        $message = $page->message("Secteurs a été supprimé avec succès", "danger");
}




$tblName = "S";


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfosecteur"] = $info;
    if ($info == "") {
        $_SESSION['Secteur'] = $secteur->GetAllSecteur();
    } else {
        $secteur->connexion();
        $_SESSION['Secteur'] = $secteur::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
    }

    if (count($_SESSION["Secteur"]) > 0) {
        echo "<div class='pagi_sup'>

    <div class='pagination'>
       ";
        $tab = $page->Pagination_Btn($_SESSION['Secteur'], $_GET['get']);
        $page->Pagination_Nb($tab, $_GET['get']);

        echo "</div>
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
                <th scope='col'>Code Secteur</th>
                <th scope='col'>Description De Secteur</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
            <tbody>";

        $page->GetTablePage($_SESSION['Secteur'], $_GET['get']);


        echo "</tbody>
    </table>
</div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfosecteur"])) {
        $info = $_SESSION["rechinfosecteur"];
        if ($info == "") {
            $_SESSION['Secteur'] = $secteur->GetAllSecteur();
        } else {
            $secteur->connexion();
            $_SESSION['Secteur'] = $secteur::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $_SESSION['Secteur'] = $secteur->GetAllSecteur();
    }
    require "../View/V_Secteur.php";
}
