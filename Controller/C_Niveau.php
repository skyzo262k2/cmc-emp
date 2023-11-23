<?php
require "../Model/M_Niveau.php";
require "../Model/M_Pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$info = "";

$message = "";

$niveau = new Niveau();
$page = new Pagination();
$niveau->etab = $_SESSION["Etablissement"]["CodeEtb"];

if (!isset($_GET['get'])) {
    $_GET['get'] = 1;
}

if (isset($_POST["sup"])) {
    $niveau->CodeNiv = $_POST["sup"];
    $n = $niveau->Delete();
    if ($n)
        $message = $page->message("Niveau a été supprimé avec succès", "danger");
}



if (isset($_POST["btnAjouter"])) {
    if (!empty($_POST['tCodeNiv']) && !empty($_POST['tDescNiv'])) {
        $niveau->CodeNiv = $_POST["tCodeNiv"];
        $niveau->DescpNiv = $_POST["tDescNiv"];
        $n = $niveau->Add();
        if ($n)
            $message = $page->message("Niveau a été ajouté avec succès", "primary");
    }
}

if (isset($_POST["btnModifier"])) {
    if (!empty($_POST['tCodeNiv']) && !empty($_POST['tDescNiv'])) {
        $niveau->CodeNiv = $_POST["tCodeNiv"];
        $niveau->DescpNiv = $_POST["tDescNiv"];
        $n = $niveau->Update();
        if ($n)
            $message = $page->message("Niveau a été modifié avec succès", "primary");
    }
}

if (isset($_POST["btnSupprimer"])) {
    $n = $niveau->DeleteAll();
    if ($n)
        $message = $page->message("Niveaux a été supprimés avec succès", "danger");
}





if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfoniveau"] = $info;
    if ($info == "") {
        $_SESSION['Niveau'] = $niveau->GetAll();
    } else {
        $niveau->connexion();
        $_SESSION['Niveau'] = $niveau->Find($info);
    }
    if (count($_SESSION["Niveau"]) > 0) {
        echo "
    <div class='pagi_sup'>

        <div class='pagination'>
            ";
        $tab = $page->Pagination_Btn($_SESSION['Niveau'], $_GET['get']);
        $page->Pagination_Nb($tab, $_GET['get']);

        echo " </div>
        <div class='deleteAll'>
            <form action='' method='post'>

                <input type='submit' value='Supprimer tous' name='btnSupprimer' class='btn btn-primary end-0' onclick='return confirm(`Tu es Sure pour Supprimer Tous ?`)' id='btnSupprimer'>
            </form>
        </div>

    </div>

    <div class='table-affiche'>

        <form action='' method='post'>
            <table class='table table-striped table-sm table-bordered'>
                <thead>
                    <tr class='table-success'>
                        <th scope='col'>Code Niveau</th>
                        <th scope='col'>Description De Niveau</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>
                <tbody>";

        $page->GetTablePage($_SESSION['Niveau'], $_GET['get']);
        echo " </tbody>
            </table>
        </form>
    </div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfoniveau"])) {
        $info = $_SESSION["rechinfoniveau"];
        if ($info == "") {
            $_SESSION['Niveau'] = $niveau->GetAll();
        } else {
            $niveau->connexion();
            $_SESSION['Niveau'] = $niveau->Find($info);
        }
    } else {
        $_SESSION['Niveau'] = $niveau->GetAll();
    }
    require "../View/V_Niveau.php";
}
