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

$stagiaire->etab = $etab;
$stagiaire->annef = $anne;

$stagiaire->connexion();
$groupes = Stagiaire::$cnx->query("select CodeGrp from groupe")->fetchAll(PDO::FETCH_NUM);
$stagiaire->Deconnexion();

if (!isset($_SESSION["Admin"]))
    header("location:../Controller/C_Login.php");

if (!isset($_GET['get']))
    $_GET['get'] = 1;

if (isset($_POST["sup"])) {
    $stagiaire->cef = $_POST["sup"];
    $stagiaire->Delete();
    header("location:../Controller/C_Stagiaire.php");
}

if (isset($_POST["btnAjouter"])) {
    if ($_POST["groupe"] != "choisir" && $_POST["cef"] != "") {
        $stagiaire->cef = $_POST["cef"];
        $stagiaire->nom = $_POST["nom"];
        $stagiaire->prenom = $_POST["prenom"];
        $stagiaire->groupe = $_POST["groupe"];
        $stagiaire->discipline = "discipline";
        $stagiaire->Add();
    }
}
if (isset($_POST["btnModifier"])) {
    $stagiaire->cef = $_POST["cef"];
    $stagiaire->nom = $_POST["nom"];
    $stagiaire->prenom = $_POST["prenom"];
    $stagiaire->groupe = $_POST["groupe"];
    $stagiaire->discipline = $_POST["discipline"];
    $stagiaire->update();
}
if (isset($_POST["btnSupprimer"])) {
    $stagiaire->DeleteAll();
}
if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfostag"] = $info;
    if ($info == "") {
        $_SESSION['Stagiaire'] = $stagiaire->GetAll();
    } else {
        $_SESSION['Stagiaire'] = $stagiaire->Find($info);
    }


    echo "<div class='pagi_sup'>
                <div class='pagination'>";



                $tab = $page->Pagination_Btn($_SESSION['Stagiaire'], $_GET['get']);
                $page->Pagination_Nb($tab, $_GET['get']);

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
    if (isset($_SESSION["rechinfostag"])) {
        $info = $_SESSION["rechinfostag"];
        if ($info == "") {
            $_SESSION['Stagiaire'] = $stagiaire->GetAll();
        } else {
            $stagiaire->connexion();
            $_SESSION['Stagiaire'] = $stagiaire->Find($info);
        }
    } else {
        $_SESSION['Stagiaire'] = $stagiaire->GetAll();
    }
    require "../View/V_Stagiaire.php";
}
