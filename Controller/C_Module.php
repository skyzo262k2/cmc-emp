<?php
require "../Model/M_Module.php";
require "../Model/M_Pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$info = "";

$message = "";
$poste = $_SESSION['Admin']['Poste'];
$secteur = isset($_SESSION['Admin']['secteur']) ? $_SESSION['Admin']['secteur'] : null;


function GetTablePage($tab, $nb)
{
    if ($tab) {
        $n = $nb * 25;
        $key = key($tab[0]);
        for ($i = $n - 25; $i < $n; $i++) {
            echo "<tr ondblclick='aff(this)'>";
            if ($i >= count($tab)) {
                break;
            };
            foreach ($tab[$i] as $col) {
                echo "<td>" . htmlspecialchars($col) . "</td>";
            }
            echo "<td>
            
            <form action='' method='POST'>
                <button type='submit' name='sup' class='sup' value='" . htmlspecialchars($tab[$i]['CodeMd']) . "," . htmlspecialchars($tab[$i]['CodeFlr']) . "'><img src='../Images/Icon_Delete.png' width='30px' /></button>
                </form></td>";
            echo " </tr>";
        }
    }
}

$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];

$Module = new Module();

$Pag = new Pagination();

$tblName = "M";
if (!isset($_GET["get"])) {
    $_GET["get"] = 1;
}

if (isset($_POST["sup"])) {
    $info = explode(",", $_POST["sup"]);
    $Module->CodeMd = $info[0];
    $Module->CodeFlr = $info[1];
    $n = $Module->DeleteModules();
    if ($n)
        $message = $Pag->message("Module a été supprimé avec succès", "danger");
}


if (isset($_POST["btnAjouter"])) {
    if (!empty($_POST["tCodeMd"]) && $_POST["tCodeFlr"] != 'choisir' && $_POST["tAnnee"] != 'choisir' && !empty($_POST["tDescr"]) && !empty($_POST["tPr"]) && !empty($_POST["tDist"]) && !empty($_POST["tS1"]) && !empty($_POST["tS2"])) {
        $Module->CodeMd = $_POST["tCodeMd"];
        $Module->CodeFlr = $_POST["tCodeFlr"];
        $Module->Annee = $_POST["tAnnee"];
        $Module->DescMd = $_POST["tDescr"];
        $Module->Pr = $_POST["tPr"];
        $Module->Dist = $_POST["tDist"];
        $Module->S1 = $_POST["tS1"];
        $Module->S2 = $_POST["tS2"];
        $n = $Module->AddModules();
        if ($n)
            $message = $Pag->message("Module a été ajouté avec succès", "primary");
    }
}

if (isset($_POST["btnModifier"])) {
    if (!empty($_POST["tCodeMd"]) && $_POST["tCodeFlr"] != 'choisir' && $_POST["tAnnee"] != 'choisir' && !empty($_POST["tDescr"]) && !empty($_POST["tPr"]) && !empty($_POST["tDist"]) && !empty($_POST["tS1"]) && !empty($_POST["tS2"])) {
        $Module->CodeMd = $_POST["tCodeMd"];
        $Module->CodeFlr = $_POST["tCodeFlr"];
        $Module->Annee = $_POST["tAnnee"];
        $Module->DescMd = $_POST["tDescr"];
        $Module->Pr = $_POST["tPr"];
        $Module->Dist = $_POST["tDist"];
        $Module->S1 = $_POST["tS1"];
        $Module->S2 = $_POST["tS2"];
        $n = $Module->UpdateModules();
        if ($n)
            $message = $Pag->message("Module a été modifié avec succès", "primary");
    }
}
if (isset($_POST["btnSupprimer"])) {
    $n = $Module->DeleteAllModules();
    if ($n)
        $message = $Pag->message("Modules a été supprimés avec succès", "danger");
}

$Module->connexion();

$query = "SELECT * FROM Filiere ";
$query .= isset($_SESSION['Admin']['secteur']) ? " WHERE CodeSect='{$_SESSION['Admin']['secteur']}';" : ";";

$Filiers = $Module::$cnx->query($query)->fetchAll();
$Module->Deconnexion();


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfomodule"] = $info;
    if ($info == "") {
        if ($poste != "ChefSecteur")
            $_SESSION['modules'] = $Module->GetAllModules();
        else
            $_SESSION['modules'] = $Module->GetModulesSecteur($secteur);
    } else {
        $Module->connexion();

        if ($poste != "ChefSecteur")
            $_SESSION['modules'] = $Module::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        else
            $_SESSION['modules'] = $Module::$cnx->query("call sp_RechercherGlobalSecteur('$info','$tblName','$CodeEtab','$secteur')")->fetchAll(PDO::FETCH_ASSOC);
    }

    if (count($_SESSION["modules"]) > 0) {
        echo " <div class='pagi_sup'>

    <div class='pagination'>";
        $modules = $Pag->Pagination_Btn($_SESSION['modules'], $_GET['get']);
        $Pag->Pagination_Nb($modules, $_GET['get']);

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
                <th scope='col'>Code module </th>
                <th scope='col'>Code Filiere</th>
                <th scope='col'>Annee</th>
                <th scope='col'>Description module</th>
                <th scope='col'>Pressentielle</th>
                <th scope='col'>Distance</th>
                <th scope='col'>Semestre 1</th>
                <th scope='col'>Semestre 2</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
            <tbody >";
        GetTablePage($_SESSION["modules"], $_GET["get"]);

        echo " </tbody>
    </table>
</div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfomodule"])) {
        $info = $_SESSION["rechinfomodule"];
        if ($info == "") {
            if ($poste != "ChefSecteur")
                $_SESSION['modules'] = $Module->GetAllModules();
            else
                $_SESSION['modules'] = $Module->GetModulesSecteur($secteur);
        } else {

            $Module->connexion();
            if ($poste != "ChefSecteur")
                $_SESSION['modules'] = $Module::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
            else
                $_SESSION['modules'] = $Module::$cnx->query("call sp_RechercherGlobalSecteur('$info','$tblName','$CodeEtab','$secteur')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        if ($poste != "ChefSecteur")
            $_SESSION['modules'] = $Module->GetAllModules();
        else
            $_SESSION['modules'] = $Module->GetModulesSecteur($secteur);
    }
    require "../View/V_Module.php";
}
