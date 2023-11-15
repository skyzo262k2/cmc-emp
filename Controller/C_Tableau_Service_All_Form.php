<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$cnnx = new Connexion();

$CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
$anne = explode('/',$_SESSION['Annee']);

$pdf = new FPDF('L', 'mm', 'A4');

$cnnx->connexion();

$matricules =  $cnnx::$cnx->query("select matricule from formateur where CodeEtab = '$CodeEtab'")->fetchAll(PDO::FETCH_NUM);

$page = new PagePDF_TableauService($pdf);

foreach ($matricules as $mat) {
    $info = $cnnx::$cnx->query("select concat(f.Nom,' ',f.Prenom ),E.DescpFr from formateur f 
    inner join etablissement E on f.CodeEtab = E.CodeEtb where f.Matricule = '$mat[0]';")->fetch(PDO::FETCH_NUM);


    $InfoHeures = $cnnx::$cnx->query("
    SELECT 
    sum(m.s1 * g.taux /100) as s1,sum(m.s2* g.taux /100) as s2 , sum(m.s1 * g.taux /100) + sum(m.s2* g.taux /100) as total
  FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
  INNER JOIN modules m ON m.CodeMd = af.ModuleCode
  WHERE af.Matricule = '$mat[0]' AND af.CodeEtab = '$CodeEtab'
  AND af.AnneeFr = $anne[0] AND m.codeflr=g.codeflr;")->fetch();

    $Affecteds = $cnnx::$cnx->query("CALL SP_ModuleAffecter_Formateur('$mat[0]','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_ASSOC);

    $nbpage = intval(count($Affecteds) / 20);
    if (count($Affecteds) % 20 != 0) {
        $nbpage++;
    }

    for ($i = 0; $i < $nbpage; $i++) {
        $page->pdf->AddPage();
        $page->AddPagePDF($_SESSION["Annee"],$info[1],$info[0],$InfoHeures,array_slice($Affecteds,20*$i,20));
    }
}





$page->AfficherPDF();
