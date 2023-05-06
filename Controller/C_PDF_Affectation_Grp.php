<?php
require "../Model/M_Connexion.php";
require '../Model/PDF.php';


session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$cnnx = new Connexion();
if (isset($_GET['grp'])) {
    $Etab = $_SESSION["Etablissement"]["CodeEtb"];
    $TAnn = explode("/", $_SESSION["Annee"]);
    $pdf = new FPDF('L', 'mm', 'A4');

    $grp = $_GET['grp'];
    $cnnx->connexion();
    $info = $cnnx::$cnx->query("select DescpFr from etablissement where CodeEtb = '$Etab'")->fetch(PDO::FETCH_NUM);


    $InfoHeures = $cnnx::$cnx->query("select sum(m.s1),sum(m.s2),sum(m.s1)+sum(m.s2)
    from groupe g inner join filiere f using(Codeflr)
    inner join modules m using(Codeflr)
    where g.codeGrp = '$grp'")->fetch();

    $Affecteds = $cnnx::$cnx->query("CALL SP_Affectation_Module_Grp('$grp','$Etab','$TAnn[0]')")->fetchAll(PDO::FETCH_ASSOC);

    $page = new PagePDF_AffectationGrp($pdf);

    $nbpage = intval(count($Affecteds) / 20);
    if (count($Affecteds) % 20 != 0) {
        $nbpage++;
    }

    for ($i = 0; $i < $nbpage; $i++) {
        $page->pdf->AddPage();
        $page->AddPagePDF($_SESSION["Annee"], $grp, $info[0], $InfoHeures,array_slice($Affecteds,20*$i,20));
    }
    $page->AfficherPDF();
}
