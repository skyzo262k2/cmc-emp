<?php
require "../Model/M_filiere.php";
require "../Model/M_pagination.php";


$conx = new Connexion();
$conx->connexion();
session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}



$info = "";

$message = "";
$req = "SELECT CodeNiv FROM niveau ORDER BY CodeNiv DESC ";
$exec = $conx::$cnx->prepare($req);
$exec->execute();
$Niveaus = $exec->fetchAll(PDO::FETCH_ASSOC);
$conx->Deconnexion();


if (!isset($_GET['get']))
    $_GET['get'] = 1;

$fil = new Filiere();

$fil->etab = $_SESSION["Etablissement"]["CodeEtb"];
$codeSects = $fil->CodeSecteur();
$page = new Pagination();
if (isset($_POST['btnAjouter'])) {
    if (!empty($_POST['cdfl']) and !empty($_POST['descrpfl']) and $_POST['CodeSect'] != "" and $_POST['nv'] != "") {
        $fil->codefl = $_POST['cdfl'];
        $fil->DescrpFl = $_POST['descrpfl'];
        $fil->CdSt = $_POST['CodeSect'];
        $fil->Nv = $_POST['nv'];
        $n = $fil->Add();

        if ($n)
            $message = $page->message("Filière a été ajouté avec succès", "primary");
    }
}

if (isset($_POST['btnModifier'])) {

    if (!empty($_POST['cdfl']) and !empty($_POST['descrpfl']) and $_POST['CodeSect'] != "" and !empty($_POST['nv'])) {
        $fil->codefl = $_POST['cdfl'];
        $fil->DescrpFl = $_POST['descrpfl'];
        $fil->CdSt = $_POST['CodeSect'];
        $fil->Nv = $_POST['nv'];
        $n = $fil->Update();

        if ($n)
            $message = $page->message("Filière a été modifié avec succès", "primary");
    }
}

if (isset($_POST["sup"])) {
    $fil->codefl = $_POST["sup"];
    $n =  $fil->Delete();
    if ($n)
        $message = $page->message("Filière a été supprimé avec succès", "danger");
}

if (isset($_POST['btnSupprimer'])) {
    $n =  $fil->DeleteAll();
    if ($n)
        $message = $page->message("Filière a été supprimé avec succès", "danger");
}





if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfofiliere"] = $info;
    if ($info == "") {
        $toutfilieres  = $fil->GetAll();
    } else {
        $fil->connexion();
        $toutfilieres  = $fil->Find($info);
    }
    $_SESSION['filieres'] = [];
    if ($_SESSION["Admin"]["Poste"] ==  "ChefSecteur") {
        foreach ($toutfilieres as $f) {
            if ($f["CodeSect"] == $_SESSION["Admin"]["secteur"]) {
                $_SESSION['filieres'][] = [$f['CodeFlr'], $f['DescpFlr'], $f['Niveau']];
            }
        }
    } else {
        $_SESSION['filieres'] = $toutfilieres;
    }


    if (count($_SESSION["filieres"]) > 0) {
        echo " <div class='pagi_sup'>
                <div class='pagination'>";
        $filieres = $page->Pagination_Btn($_SESSION['filieres'], $_GET['get']);
        $page->Pagination_Nb($filieres, $_GET['get']);

        echo   "</div>
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
                            <th scope='col'>code Filiere</th>
                            <th scope='col'>Description Filiere</th>";

        if ($_SESSION["Admin"]["Poste"] !=  "ChefSecteur")
            echo "<th scope='col'>code Secteur</th>";
        echo "<th scope='col'>Niveau</th>
        <th scope='col'>Action</th>
        </tr>
        </thead>
        <tbody >";

        $page->GetTablePage($_SESSION['filieres'], $_GET['get']);

        echo "
                    </tbody>
                </table>
</div>";
    } else {
        echo "<div><img src='../Images/nodata.jpg' alt='' /></div>";
    }
} else {
    if (isset($_SESSION["rechinfofiliere"])) {
        $info = $_SESSION["rechinfofiliere"];
        if ($info == "") {
            $toutfilieres = $fil->GetAll();
        } else {
            $fil->connexion();
            $toutfilieres = $fil->Find($info);
        }
    } else {
        $toutfilieres = $fil->GetAll();
    }
    $_SESSION['filieres'] = [];
    if ($_SESSION["Admin"]["Poste"] ==  "ChefSecteur") {
        foreach ($toutfilieres as $f) {
            if ($f["CodeSect"] == $_SESSION["Admin"]["secteur"]) {
                $_SESSION['filieres'][] = [$f['CodeFlr'], $f['DescpFlr'], $f['Niveau']];
            }
        }
    } else {
        $_SESSION['filieres'] = $toutfilieres;
    }
    require "../View/V_filiere.php";
}
