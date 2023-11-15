<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';

session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}
if (isset($_GET['grp'])) {
    $grp = trim($_GET['grp'],"'");
    $CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
    $anne = explode('/', $_SESSION['Annee']);
    $cnnx = new Connexion();
    $pdf = new FPDF('L', 'mm', 'A4');
    $cnnx->connexion();
    $T_Jours = [
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]],
        [["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]]
    ];

    $T_Jour = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

    $Emploi_Groupe = $cnnx::$cnx->query("call SP_Emploi_Groupe_B('$grp','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);

    foreach ($Emploi_Groupe as $Day) {
        for ($j = 0; $j < 6; $j++) {
            if ($T_Jour[$j] == $Day[1]) {
                for ($i = 0; $i < 4; $i++) {
                    if ($i+1 == $Day[2]){
                        $T_Jours[$j][$i] = [$Day[0],$Day[3],$Day[4],$Day[5]];
                    }
                }
            }
        }
    }
    // print_r($T_Jours);
    $page = new PagePDF_Emploi($pdf,$_SESSION['Annee'] , $_SESSION['Etablissement']["DescpFr"]);
    $page->NewEmploi('Groupe', $grp, trim($_GET["debut"],"'"), trim($_GET["fin"],"'"), $T_Jours[0], $T_Jours[1], $T_Jours[2], $T_Jours[3], $T_Jours[4], $T_Jours[5]);
    $page->AfficherPDF();
}
