<?php

require "../Model/M_Validateur.php";
require "../Model/M_pagination.php";

session_start();

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}


$info = "";

$page = new Pagination();
function GetTablePage($tab, $nb)
{
    if ($tab) {
        $n = $nb * 25;
        $key = key($tab[0]);
        for ($i = $n - 25; $i < $n; $i++) {
            echo "<tr>";
            if ($i >= count($tab)) {
                break;
            };
            foreach ($tab[$i] as $col) {
                echo "<td>" . $col . "</td>";
            }
            echo "<td>
                <button class='sup' onclick='Delete(\"" . $tab[$i]["matricule"] . "\",\"" . $tab[$i]["filiere"] . "\")'><img src='../Images/Icon_Delete.png' width='30px' /></button>
                </td>";
            echo " </tr>";
        }
    }
}


function AjaxInfor($table)
{
    global $page;
    $donnees = [];
    if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
        foreach ($table as $t) {
            if ($_SESSION["Admin"]["secteur"] == $t["CodeSect"]) {
                $donnees[] = ["filiere" => $t["filiere"], "DescpFlr" => $t["DescpFlr"], "matricule" => $t["matricule"], "nom" => $t["nom"]];
            }
        }
    } else {
        foreach ($table as $t) {
            $donnees[] = ["filiere" => $t["filiere"], "DescpFlr" => $t["DescpFlr"], "matricule" => $t["matricule"], "nom" => $t["nom"]];
        }
    }
    echo "   <div class='pagi_sup'>

    <div class='pagination'>
        ";
    $salles = $page->Pagination_Btn($donnees, $_GET['get']);
    $page->Pagination_Nb($salles, $_GET['get']);

    echo " </div>
    <div class='deleteAll'>
            <input type='button' value='Supprimer tous' name='btnSupprimer' class='btn btn-primary end-0'  onclick='DeleteAll()'>
     
    </div>

</div>

<div class='table-affiche'>

    <table class='table table-striped table-sm table-bordered'>
        <thead>
            <tr class='table-success'>
                <th scope='col'>Code Filière</th>
                <th scope='col'>Description Filière</th>
                <th scope='col'>Matricule Formateur</th>
                <th scope='col'>Nom Formateur</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody id='info_tbody'>
           ";

    GetTablePage($donnees, $_GET['get']);

    echo "</tbody>
    </table>
</div>";
}



if (!isset($_GET['get']))
    $_GET['get'] = 1;
$validateur = new Validateur();
$validateur->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];





if (isset($_POST['mat']) && isset($_POST['flr']) && isset($_POST['add'])) {

    if ($_POST['mat'] !=  "choisir" and $_POST['flr'] !=  "choisir") {
        $validateur->matricule = $_POST["mat"];
        $validateur->filiere = $_POST["flr"];
        $validateur->AddValidateur();
    }
    $table = $validateur->GetAllValidateur();
    AjaxInfor($table);
} elseif (isset($_POST['mat']) && isset($_POST['flr']) && isset($_POST['delete'])) {
    $validateur->matricule = $_POST["mat"];
    $validateur->filiere = $_POST["flr"];
    $validateur->DeleteValidateur();
    $table = $validateur->GetAllValidateur();
    AjaxInfor($table);
} elseif (isset($_POST['deleteall'])) {
    // echo "bbb";
    $validateur->DeleteAllValidateurByEtab();
    $table = $validateur->GetAllValidateur();
    AjaxInfor($table);
} elseif (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfosalle"] = $info;
    if ($info == "") {
        $table = $validateur->GetAllValidateur();
    } else {
        $table = $validateur->FindValidateur($info);
    }
    AjaxInfor($table);
} else {
    if (isset($_SESSION["rechinfosalle"])) {
        $info = $_SESSION["rechinfosalle"];
        if ($info == "") {
            $table = $validateur->GetAllValidateur();
        } else {
            $table = $validateur->FindValidateur($info);
        }
    } else {
        $table = $validateur->GetAllValidateur();
    }
    $validateur->connexion();
    $Formateurs_select = $validateur::$cnx->query("SELECT Matricule,Nom,Prenom,secteur  FROM formateur where CodeEtab =  '" . $_SESSION["Etablissement"]["CodeEtb"] . "';")->fetchAll(PDO::FETCH_NUM);
    $Filieres_select = $validateur::$cnx->query("call SP_GetAll_filiere()")->fetchAll(PDO::FETCH_NUM);
    $Formateurs = [];
    $Filieres = [];
    if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
        foreach ($Filieres_select as $fi) {
            if ($_SESSION["Admin"]["secteur"] == $fi[2]) {
                $Filieres[] = $fi;
            }
        }
        foreach ($Formateurs_select as $fo) {
            if ($_SESSION["Admin"]["secteur"] == $fo[3]) {
                $Formateurs[] = $fo;
            }
        }
    } else {
        $Formateurs = $Formateurs_select;
        $Filieres = $Filieres_select;
    }

    $validateur->Deconnexion();
    require "../View/V_Validateur.php";
}
