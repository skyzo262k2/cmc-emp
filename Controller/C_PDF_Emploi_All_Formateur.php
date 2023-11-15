<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';
session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

$CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
$anne = explode('/', $_SESSION['Annee']);
$cnnx = new Connexion();
$pdf = new FPDF('L', 'mm', 'A4');
$cnnx->connexion();


$query = "select Matricule,concat(Nom ,' ',Prenom) from Formateur where CodeEtab = '$CodeEtab'";
if (isset($_GET["type"])){
    $type = $_GET["type"];
    $query .= " and Type = '$type'";
}

$Formateurs = $cnnx::$cnx->query($query)->fetchAll(PDO::FETCH_NUM);
$page = new PagePDF_Emploi($pdf,  $_SESSION['Annee'], $_SESSION['Etablissement']["DescpFr"]);
foreach ($Formateurs as $Mat) {
    $T_Jours = [
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]]
    ];

    $valide = false;

    $T_Jour = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

    $Emploi_Formateur = $cnnx::$cnx->query("call SP_Emploi_Formateur('$Mat[0]','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);
    if (count($Emploi_Formateur) > 0) {
        foreach ($Emploi_Formateur as $Day) {
            for ($j = 0; $j < 6; $j++) {
                if ($T_Jour[$j] == $Day[1]) {
                    for ($i = 0; $i < 4; $i++) {
                        if ($i + 1 == $Day[2]) {
                            if ($Day[3] == "Présentiel") {
                                $valide = true;
                                $T_Jours[$j][$i] = [$Day[0], $Day[3], $Day[4], $Day[5]];
                            } else {
                                $k = $i + 1;
                                $MemeGrpAdistence = $cnnx::$cnx->query("call SP_Seance_Formateur('$Mat[0]','$T_Jour[$j]','$k','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);
                                $grps = "";
                                foreach ($MemeGrpAdistence as $Grp) {
                                    $grps .=  $Grp[0] . " - ";
                                }
                                $T_Jours[$j][$i] = [$grps, $Day[3], $Day[4], $Day[5]];
                            }
                        }
                    }
                }
            }
        }
        $page->NewEmploi('Formateur', $Mat[1], trim($_GET["debut"], "'"), trim($_GET["fin"], "'"), $T_Jours[0], $T_Jours[1], $T_Jours[2], $T_Jours[3], $T_Jours[4], $T_Jours[5]);
    }
}
$page->AfficherPDF();
