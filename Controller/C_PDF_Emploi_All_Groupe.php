<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';


session_start();
$CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
$anne = explode('/', $_SESSION['Annee']);
$cnnx = new Connexion();
$pdf = new FPDF('L', 'mm', 'A4');
$cnnx->connexion();

$Groupes = $cnnx::$cnx->query("select CodeGrp from Groupe where CodeEtab = '$CodeEtab'")->fetchAll(PDO::FETCH_NUM);
$page = new PagePDF_Emploi($pdf, $_SESSION['Annee'], $_SESSION['Etablissement']["DescpFr"]);
foreach ($Groupes as $Grp) {
    $T_Jours = [
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]]
    ];


    $existe = false;
    $T_Jour = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

    $Emploi_Groupe = $cnnx::$cnx->query("call SP_Emploi_Groupe_B('$Grp[0]','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);

    if (count($Emploi_Groupe) > 0) {
        foreach ($Emploi_Groupe as $Day) {
            for ($j = 0; $j < 6; $j++) {

                if ($T_Jour[$j] == $Day[1]) {
                    for ($i = 0; $i < 4; $i++) {
                        if ($i + 1 == $Day[2]) {
                            $existe = true;
                            $T_Jours[$j][$i] = [$Day[0], $Day[3], $Day[4], $Day[5]];
                        }
                    }
                }
            }
        }
        if ($existe)
            $page->NewEmploi('Groupe', $Grp[0],  trim($_GET["debut"], "'"), trim($_GET["fin"], "'"), $T_Jours[0], $T_Jours[1], $T_Jours[2], $T_Jours[3], $T_Jours[4], $T_Jours[5]);
    }
}

$page->AfficherPDF();
