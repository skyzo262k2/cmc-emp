<?php

require "../Model/M_Surveille.php";
require "../Model/M_Pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}
$rech = "";
$info = "";

$Pag = new Pagination();
$surveille = new Surveille();

$surveille->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];


$message = "";

if (!isset($_GET["get"])) {
    $_GET["get"] = 1;
}

if (isset($_POST["btnAjouter"])) {
    try {
        if (!empty($_POST["tMatricule"]) && !empty($_POST["tNom"]) && !empty($_POST["tPrenom"]) && !empty($_POST["typeuser"])) {
            $surveille->Matricule = $_POST["tMatricule"];
            $surveille->Nom = $_POST["tNom"];
            $surveille->Prenom = $_POST["tPrenom"];
            $surveille->login =  $_POST["tMatricule"];
            $surveille->typeuser =  $_POST["typeuser"];
            if (isset($_POST['secteur']) && $_POST["typeuser"] != "Surveille")
                $surveille->secteur = $_POST['secteur'];
            else
                $surveille->secteur = "";
            $surveille->Password =  password_hash("CMC", PASSWORD_DEFAULT);
            $n = null;
            if ($_POST["typeuser"] == "Surveille")
                $n =  $surveille->Add();
            if ($_POST["typeuser"] == "ChefSecteur" && $_POST['secteur'] != "")
                $n =  $surveille->Add();
            if ($n)
                $message = $Pag->message("Utilisateur a été ajouté avec succès", "primary");
            else
                $message = $Pag->message("Tout les champs sont oobligatoires", "danger");
        }
    } catch (Exception $er) {
    }
}

if (isset($_POST["Reinitialiser"])) {
    $surveille->Matricule = $_POST["Reinitialiser"];
    $surveille->Password =  password_hash("CMC", PASSWORD_DEFAULT);
    $n = $surveille->ModifierMotePasse();

    if ($n)
        $message = $Pag->message("Mot de pas a été reinitialisé avec succès", "primary");
}

// if (isset($_POST["btnModifier"])) {
//     if (!empty($_POST["tMatricule"]) && !empty($_POST["tNom"]) && !empty($_POST["tPrenom"]) && !empty($_POST["typeuser"])) {
//         $surveille->Matricule = $_POST["tMatricule"];
//         $surveille->Nom = $_POST["tNom"];
//         $surveille->Prenom = $_POST["tPrenom"];
//         $surveille->typeuser = $_POST["typeuser"];
//         $surveille->Update();
//     }
// }

if (isset($_POST["sup"])) {
    $surveille->Matricule = $_POST["sup"];
    $n = $surveille->Delete();
    if ($n)
        $message = $Pag->message("Utilisateur a été supprimé avec succès", "danger");
}

if (isset($_POST["btnSupprimer"])) {
    $n = $surveille->DeleteAll();
    if ($n)
        $message = $Pag->message("Utilisateurs a été supprimés avec succès", "danger");
}

if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfosur"] = $info;
    if ($info == "") {
        $_SESSION['Surveilles'] = $surveille->GetAll();
        $surveille->connexion();
        $AlSecteurs = $surveille::$cnx->query("select CodeSect,DescpSect from secteur;")->fetchAll(PDO::FETCH_NUM);
        $surveille->Deconnexion();
    } else {
        $surveille->connexion();
        $_SESSION['Surveilles'] = $surveille->Find($info);
    }


    if (count($_SESSION["Surveilles"]) > 0) {
        echo "<div class='pagi_sup'>
                <div class='pagination'>";

        $Surveilles = $Pag->Pagination_Btn($_SESSION['Surveilles'], $_GET['get']);
        $Pag->Pagination_Nb($Surveilles, $_GET['get']);

        echo "</div>
                <div class='deleteAll'>
                    <form action='' method='post'>
                        <input type='submit' value='Supprimer tous' class='btn btn-primary' name='btnSupprimer' class='end-0' onclick='return confirm('Tu es Sure pour Supprimer Tous ?')' id='btnSupprimer'>
                    </form>
                </div>
            </div>

            <div class='table-affiche'>
                <table class='table table-striped table-sm table-bordered'>
                    <thead>
                        <tr class='table-success'>
                        <th scope='col'>Matricule</th>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Prénom</th>
                        <th scope='col'>Type Utilisateur</th>
                        <th scope='col'>Réinitialiser</th>
                        <th scope='col'>Action</th>
                        </tr>
                    </thead>
                   
            <tbody >
            ";
        $Pag->GetTablePage($_SESSION['Surveilles'], $_GET['get'], 'formateur');
        echo "</tbody>
          </table>
          </div>";;
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    $surveille->connexion();
    $AlSecteurs = $surveille::$cnx->query("select CodeSect,DescpSect from secteur;")->fetchAll(PDO::FETCH_ASSOC);
    $surveille->Deconnexion();
    if (isset($_SESSION["rechinfosur"])) {
        $info = $_SESSION["rechinfosur"];
        if ($info == "") {
            $_SESSION['Surveilles'] = $surveille->GetAll();
        } else {
            $surveille->connexion();
            $_SESSION['Surveilles'] = $surveille->Find($info);
        }
    } else {
        $_SESSION['Surveilles'] = $surveille->GetAll();
    }
    require '../View/V_Surveille.php';
}
