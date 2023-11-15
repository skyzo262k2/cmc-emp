<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';


session_start();
if(!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille"){
    if(!isset($_SESSION["userFormateur"]))
        header("location:../Controller/C_Login.php");
}

$cnnx = new Connexion();

if (isset($_GET['Mat'])) {

    $Etab = $_SESSION["Etablissement"]["CodeEtb"];
    $TAnn = explode("/", $_SESSION["Annee"]);
    $pdf = new FPDF('L', 'mm', 'A4');

    $mat = $_GET['Mat'];
    $cnnx->connexion();
    $info = $cnnx::$cnx->query("select concat(f.Nom,' ',f.Prenom ),E.DescpFr from formateur f 
    inner join etablissement E on f.CodeEtab = E.CodeEtb where f.Matricule = '$mat';")->fetch(PDO::FETCH_NUM);

    $InfoHeures = [$_SESSION['s1'],$_SESSION['s2'],$_SESSION['masshorraire']];
//     $InfoHeures =$cnnx::$cnx->query("
//     SELECT 
//     sum(m.s1 * g.taux /100) as s1,sum(m.s2* g.taux /100) as s2 , sum(m.s1 * g.taux /100) + sum(m.s2* g.taux /100) as total
//   FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
//   INNER JOIN modules m ON m.CodeMd = af.ModuleCode
//   WHERE af.Matricule = '$mat' AND af.CodeEtab = '$Etab'
//   AND af.AnneeFr = $TAnn[0] AND m.codeflr=g.codeflr;")->fetch();

    $modulesformateur =  $cnnx::$cnx->query("CALL SP_ModuleAffecter_Formateur('$mat','$Etab','$TAnn[0]')")->fetchAll(PDO::FETCH_ASSOC);

    $page = new PagePDF_TableauService($pdf);

    $nbpage = intval(count($modulesformateur) / 20);
    if (count($modulesformateur) % 20 != 0) {
        $nbpage++;
    }

    for ($i = 0; $i < $nbpage; $i++) {
        $page->pdf->AddPage();
        $page->AddPagePDF($_SESSION["Annee"],$info[1],$info[0],$InfoHeures,array_slice($modulesformateur,20*$i,20));
    }
    $page->AfficherPDF();
}
