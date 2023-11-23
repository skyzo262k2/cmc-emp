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

if ($_SESSION["Admin"]["Poste"] == "ChefSecteur")
    $Groupes = $cnnx::$cnx->query("select g.CodeGrp from Groupe g inner join Filiere f using(CodeFlr)  
                                    where f.CodeSect = '" . $_SESSION["Admin"]["secteur"] . "' and CodeEtab = '$CodeEtab'")->fetchAll(PDO::FETCH_NUM);
else
    $Groupes = $cnnx::$cnx->query("select CodeGrp from Groupe where CodeEtab = '$CodeEtab'")->fetchAll(PDO::FETCH_NUM);


$info = $cnnx::$cnx->query("select DescpFr from etablissement where CodeEtb = '$CodeEtab'")->fetch(PDO::FETCH_NUM);

$page = new PagePDF_AffectationGrp($pdf);

foreach ($Groupes as $grp) {

    $InfoHeures = $cnnx::$cnx->query("select sum(m.s1)* g.taux /100,sum(m.s2)* g.taux /100,(sum(m.s1)+sum(m.s2))* g.taux /100
    from groupe g inner join filiere f using(Codeflr)
    inner join modules m using(Codeflr)
    where g.codeGrp = '$grp[0]'")->fetch();
    
    $Affecteds = $cnnx::$cnx->query("CALL SP_Affectation_Module_Grp('$grp[0]','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_ASSOC);

    $nbpage = intval(count($Affecteds) / 20);
    if (count($Affecteds) % 20 != 0) {
        $nbpage++;
    }

    for ($i = 0; $i < $nbpage; $i++) {
        $page->pdf->AddPage();
        $page->AddPagePDF($_SESSION["Annee"], $grp[0], $info[0], $InfoHeures,array_slice($Affecteds,20*$i,20));
    }
}




$page->AfficherPDF();