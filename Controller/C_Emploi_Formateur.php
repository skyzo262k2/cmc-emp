<?php
require "../Model/M_Emploi_Formateur.php";
require "../Model/Word.php";

use Shuchkin\SimpleXLSXGen;

require('../simplexlsxgen/src/SimpleXLSXGen.php');
session_start();
if (!isset($_SESSION["Admin"]) && !isset($_SESSION["userFormateur"])) {
    header("location:../Controller/C_Login.php");
}

$empF = new Emploi_fomateur();
$codetb = $_SESSION['Etablissement']['CodeEtb'];
$anne = explode('/', $_SESSION['Annee']);


if (!isset($_SESSION["userFormateur"])) {
    if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur') {
        $Formateurs = $empF->GetFormateur($anne[0], $codetb);
    } else {
        $Formateurs = $empF->GetFormateurParSecteur($anne[0], $codetb, $_SESSION['Admin']['secteur']);
    }
}

$imprimer = "";
$test = false;

if (isset($_POST['formateur']) || isset($_SESSION["userFormateur"])) {
    if (!isset($_SESSION["userFormateur"])) :
        $frm = explode('/', $_POST['formateur']);
        $mat = $frm[0];
        $nomp = $frm[1];
        $_SESSION['nf'] = $nomF = json_encode($frm[1]);
    else :
        $mat = $_SESSION["userFormateur"]['Matricule'];
        $nomp = $_SESSION["userFormateur"]['Nom'] . ' ' . $_SESSION["userFormateur"]['Prenom'];
    endif;
    $emploiF = $empF->getEmploiFormateur($anne[0], $codetb, $mat);
    $_SESSION['semaine'] = Separer($emploiF);
    $json = json_encode($emploiF);

    if (!isset($_SESSION["userFormateur"])) {
        print_r($json);
    } else {
        $_SESSION["userFormateur"]["emploi"] = $json;
    }
}



if (isset($_POST['execl'])) {

    $_SESSION['nf'] = trim($_SESSION['nf'], '"');
    $table = [];
    $col = ['Formateur', ' Groupe', 'CodeSl', 'Description Module', 'Code Module', 'Jour', 'Seance', 'Type seance'];
    $table[] = $col;
    $col = ['', '', '', '', '', '', ''];
    $table[] = $col;
    foreach ($emploiF as $seanc) :
        $table[] = [
            $_SESSION['nf'], $seanc['CodeGrp'], $seanc['CodeSl'], $seanc['DescpMd'],
            $seanc['CodeModule'], $seanc['Jour'], $seanc['Seance'], $seanc['TypeSc']
        ];
    endforeach;
    $xlsx = SimpleXLSXGen::fromArray($table);
    $xlsx->downloadAs("Emploi Groupe " . $_POST['execl'] . ".xlsx");
}

if (isset($_POST['tous_execl'])) {
    $table = [];
    foreach ($Formateurs as $inf) :

        $col = ['Matricule', 'Formateur', ' Groupe', 'CodeSl', 'Description Module', 'Code Module', 'Jour', 'Seance', 'Type seance'];
        $table[] = $col;
        $col = ['', '', '', '', '', '', ''];
        $table[] = $col;
        $emploiFor = $empF->getEmploiFormateur($anne[0], $codetb, $inf['Matricule']);
        foreach ($emploiFor as $seanc) :
            $table[] = [
                $inf['Matricule'], $inf['NomPr'], $seanc['CodeGrp'], $seanc['CodeSl'], $seanc['DescpMd'],
                $seanc['CodeModule'], $seanc['Jour'], $seanc['Seance'], $seanc['TypeSc']
            ];
        endforeach;
        $col = ['', '', '', '', '', '', ''];
        $table[] = $col;
    endforeach;
    $xlsx = SimpleXLSXGen::fromArray($table);
    $xlsx->downloadAs("Emploi tous les Groupes.xlsx");
}



if (isset($_POST["pdfall"])) {
    $d = $_POST["debut"];
    $f = $_POST["fin"];
    header("location:../Controller/C_PDF_Emploi_All_Formateur.php?debut='$d'&fin='$f'");
}
if (isset($_POST["pdfp"])) {
    $d = $_POST["debut"];
    $f = $_POST["fin"];
    header("location:../Controller/C_PDF_Emploi_All_Formateur.php?debut='$d'&fin='$f'&type=P");
}
if (isset($_POST["pdfv"])) {
    $d = $_POST["debut"];
    $f = $_POST["fin"];
    header("location:../Controller/C_PDF_Emploi_All_Formateur.php?debut='$d'&fin='$f'&type=V");
}

if (isset($_POST["pdfone"])) {

    $d = $_POST["debut"];
    $f = $_POST["fin"];
    $frm = explode('/', $_POST['formateur']);
    $mat = $frm[0];
    header("location:../Controller/C_PDF_Emploi_Formateur.php?Mat='$mat'&debut='$d'&fin='$f'");
}



if (isset($_POST['word'])) {
    $d = $_POST["debut"];
    $f = $_POST["fin"];
    $_SESSION['nf'] = trim($_SESSION['nf'], '"');
    $word = new Word();
    // $_SESSION['semaine'] contient data
    $word->Cadre($_SESSION['semaine'], 'Formateur', $_SESSION['nf'], $_SESSION['Annee'], $d, $f);
    $word->save($_SESSION['nf']);
    $test = true;
}

if (isset($_POST['word_all'])) {

    $d = $_POST["debut"];
    $f = $_POST["fin"];
    $word = new Word();
    foreach ($Formateurs as $frm) :

        $emploiFor = $empF->getEmploiFormateur($anne[0], $codetb, $frm['Matricule']);
        $_SESSION['semaine'] = Separer($emploiFor);
        $nf = $frm['NomPr'];
        // $_SESSION['semaine'] contient data
        $word->Cadre($_SESSION['semaine'], 'Formateur', $nf, $_SESSION['Annee'], $d, $f);

    endforeach;
    $word->save($nf);
}

function Separer($table)
{
    $semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $infomation = [['', '', '', ''], ['', '', '', ''], ['', '', '', ''], ['', '', '', ''], ['', '', '', ''], ['', '', '', '']];
    foreach ($table as $data) {
        for ($k = 0; $k < count($semaine); $k++) {
            if ($semaine[$k] == $data['Jour']) {
                for ($i = 1; $i < 5; $i++) {
                    if ($data['Seance'] == $i) {
                        if ($infomation[$k][$i - 1] == "")
                            $infomation[$k][$i - 1] = $data['CodeGrp'] . '//' . $data['DescpMd'] . '//' . $data['CodeSl'] . '  ' . $data['TypeSc'] . '//';
                        else
                            $infomation[$k][$i - 1] .= " " . $data['CodeGrp'];
                    }
                }
            }
        }
    }
    return $infomation;
}

if (!isset($_POST['formateur']))
    require "../View/V_Emploi_Formateur.php";
