<?php
require "../Model/M_Stagiaire.php";
require "../Model/M_Pagination.php";



session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

$stagiaire = new Stagiaire();
$page = new Pagination();
// print_r($_POST);

$annees = explode("/", $_SESSION["Annee"]);
$anne = $annees[0];
$etab = $_SESSION["Etablissement"]["CodeEtb"];
$info = "";

$poste = $_SESSION['Admin']['Poste'];
$secteur = isset($_SESSION['Admin']['secteur']) ? $_SESSION['Admin']['secteur'] : null;


$message = "";
$stagiaire->etab = $etab;
$stagiaire->annef = $anne;

$query = "SELECT g.CodeGrp FROM groupe g ";
$query .= isset($_SESSION['Admin']['secteur']) ? "INNER JOIN filiere f ON g.CodeFlr=f.CodeFlr WHERE f.CodeSect='{$_SESSION['Admin']['secteur']}'" : "";


$stagiaire->connexion();
$groupes = Stagiaire::$cnx->query($query)->fetchAll(PDO::FETCH_NUM);
$stagiaire->Deconnexion();


if (!isset($_GET['get']))
    $_GET['get'] = 1;

if (isset($_POST["sup"])) {
    $stagiaire->cef = $_POST["sup"];
    $n = $stagiaire->Delete();
    if ($n)
        $message = $page->message("Stagiaire a été supprimé avec succès", "danger");
}

if (isset($_POST["btnAjouter"])) {
    if ($_POST["groupe"] != "choisir" && $_POST["cef"] != "") {
        $stagiaire->cef = $_POST["cef"];
        $stagiaire->nom = $_POST["nom"];
        $stagiaire->prenom = $_POST["prenom"];
        $stagiaire->groupe = $_POST["groupe"];
        $stagiaire->discipline = "discipline";
        $n = $stagiaire->Add();
        if ($n)
            $message = $page->message("Stagiaire a été ajouté avec succès", "primary");
    }
}
if (isset($_POST["btnModifier"])) {
    $stagiaire->cef = $_POST["cef"];
    $stagiaire->nom = $_POST["nom"];
    $stagiaire->prenom = $_POST["prenom"];
    $stagiaire->groupe = $_POST["groupe"];
    $stagiaire->discipline = $_POST["discipline"];
    $n = $stagiaire->update();
    if ($n)
        $message = $page->message("Stagiaire a été modifié avec succès", "primary");
}
if (isset($_POST["btnSupprimer"])) {
    $n = $stagiaire->DeleteAll();
    if ($n)
        $message = $page->message("Stagiaires a été supprimés avec succès", "danger");
}



if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfostag"] = $info;
    if ($info == "") {

        if ($poste != "ChefSecteur")
            $_SESSION['Stagiaire'] = $stagiaire->GetAll();
        else
            $_SESSION['Stagiaire'] = $stagiaire->GetAllSecteur($secteur);
    } else {
        $_SESSION['Stagiaire'] = $stagiaire->Find($info);
        if ($poste != "ChefSecteur")
            $_SESSION['Stagiaire'] = $stagiaire->Find($info);
        else
            $_SESSION['Stagiaire'] = $stagiaire->FindStagiaire($info, $secteur);
    }

    if (count($_SESSION["Stagiaire"]) > 0) {

        echo "<div class='pagi_sup'>
                <div class='pagination'>";



        $tab = $page->Pagination_Btn($_SESSION['Stagiaire'], $_GET['get']);
        $page->Pagination_Nb($tab, $_GET['get']);

        echo "</div>
                <div class='deleteAll'>
                    <form action='' method='post'>
                        <input type='submit' value='Supprimer tous' class='btn btn-primary' name='btnSupprimer' class='end-0' onclick='return confirm(`Tu es Sure pour Supprimer Tous ?`)' id='btnSupprimer'>
                    </form>
                </div>
            </div>

            <div class='table-affiche'>
                <table class='table table-striped table-sm table-bordered'>
                    <thead>
                        <tr class='table-success'>
                        <th>CEF</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Groupe</th>
                        <th>Discipline</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >";
        $page->GetTablePage($_SESSION['Stagiaire'], $_GET['get']);
        echo "
                    </tbody>
                </table>
            </div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfostag"])) {
        $info = $_SESSION["rechinfostag"];
        if ($info == "") {

            if ($poste != "ChefSecteur")
                $_SESSION['Stagiaire'] = $stagiaire->GetAll();
            else
                $_SESSION['Stagiaire'] = $stagiaire->GetAllSecteur($secteur);
        } else {
            $stagiaire->connexion();
            if ($poste != "ChefSecteur")
                $_SESSION['Stagiaire'] = $stagiaire->Find($info);
            else
                $_SESSION['Stagiaire'] = $stagiaire->FindStagiaire($info, $secteur);
        }
    } else {

        if ($poste != "ChefSecteur")
            $_SESSION['Stagiaire'] = $stagiaire->GetAll();
        else
            $_SESSION['Stagiaire'] = $stagiaire->GetAllSecteur($secteur);
    }
    require "../View/V_Stagiaire.php";
}
