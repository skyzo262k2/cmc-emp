<?php

require "../Model/M_Salle.php";
require "../Model/M_pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}



$message = "";
$info = "";

$poste = $_SESSION['Admin']['Poste'];
$secteur = isset($_SESSION['Admin']['secteur']) ? $_SESSION['Admin']['secteur'] : null;

if (!isset($_GET['get']))
    $_GET['get'] = 1;
$sal = new Salle();
$sal->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];

$query = "select CodeSect,DescpSect from secteur ";
$query .= isset($_SESSION['Admin']['secteur']) ? "WHERE CodeSect='{$_SESSION['Admin']['secteur']}'" : ";";


$sal->connexion();
$AlSecteurs = $sal::$cnx->query($query)->fetchAll(PDO::FETCH_NUM);
$sal->Deconnexion();

$sal->CodeEtab = $_SESSION['Admin']['CodeEtab'];
$page = new Pagination();
if (isset($_POST["sup"])) {
    $sal->codesalle = $_POST["sup"];
    $n = $sal->Deletesalle();
    if ($n)
        $message = $page->message("Salle a été supprimé avec succès", "danger");
}


if (isset($_POST['btnAjouter'])) {
    if (!empty($_POST['cdsl']) and !empty($_POST['descrpsl']) and isset($_POST['type'])) {
        $sal->codesalle = $_POST['cdsl'];
        $sal->descrpsal = $_POST['descrpsl'];
        $sal->type = $_POST['type'];
        $sal->Secteur = $_POST['tSecteur'];
        // echo $_POST['tSecteur'];
        $n = $sal->AddSalle();
        if ($n)
            $message = $page->message("Salle a été ajouté avec succès", "primary");
    }
}

if (isset($_POST['btnModifier'])) {

    if (!empty($_POST['cdsl']) and !empty($_POST['descrpsl']) and isset($_POST['type'])) {
        $sal->codesalle = $_POST['cdsl'];
        $sal->descrpsal = $_POST['descrpsl'];
        $sal->type = $_POST['type'];
        $sal->Secteur = $_POST['tSecteur'];
        $n = $sal->Updatesalle();
        if ($n)
            $message = $page->message("Salle a été modifié avec succès", "primary");
    }
}
if (isset($_POST['btnSupprimer'])) {
    $n = $sal->DeleteAllSalle();
    if ($n)
        $message = $page->message("Salles a été supprimés avec succès", "danger");
}




$tblName = "SL";


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfosalle"] = $info;
    if ($info == "") {
        if ($poste != "ChefSecteur")
            $_SESSION['salles'] = $sal->GetAllSalles();
        else
            $_SESSION['salles'] = $sal->GetSalleSecteur($secteur);
    } else {
        $sal->connexion();
        if ($poste != "ChefSecteur")
            $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$sal->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        else
            $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobalSecteur('$info','$tblName','$sal->CodeEtab','$secteur')")->fetchAll(PDO::FETCH_ASSOC);
    }
    for ($i = 0; $i < count($_SESSION['salles']); $i++) {
        if ($_SESSION['salles'][$i]["secteur"] == "") {
            $_SESSION['salles'][$i]["secteur"] = "Sans";
        }
    }

    if (count($_SESSION["salles"]) > 0) {
        echo " <div class='pagi_sup'>

    <div class='pagination'>
       ";
        $salles = $page->Pagination_Btn($_SESSION['salles'], $_GET['get']);
        $page->Pagination_Nb($salles, $_GET['get']);

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
                <th scope='col'>code salle</th>
                <th scope='col'>Description salle</th>
                <th scope='col'>Type</th>
                <th scope='col'>Secteur</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
            <tbody>
                ";

        $page->GetTablePage($_SESSION['salles'], $_GET['get']);

        echo "</tbody>
    </table>
</div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfosalle"])) {
        $info = $_SESSION["rechinfosalle"];
        if ($info == "") {
            if ($poste != "ChefSecteur")
                $_SESSION['salles'] = $sal->GetAllSalles();
            else
                $_SESSION['salles'] = $sal->GetSalleSecteur($secteur);
        } else {
            $sal->connexion();
            if ($poste != "ChefSecteur")
                $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$sal->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
            else
                $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobalSecteur('$info','$tblName','$sal->CodeEtab','$secteur')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        if ($poste != "ChefSecteur")
            $_SESSION['salles'] = $sal->GetAllSalles();
        else
            $_SESSION['salles'] = $sal->GetSalleSecteur($secteur);
    }
    for ($i = 0; $i < count($_SESSION['salles']); $i++) {
        if ($_SESSION['salles'][$i]["secteur"] == "") {
            $_SESSION['salles'][$i]["secteur"] = "Sans";
        }
    }
    require "../View/V_salle.php";
}
