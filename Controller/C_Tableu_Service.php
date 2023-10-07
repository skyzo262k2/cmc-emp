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


    $InfoHeures = $cnnx::$cnx->query("
    select sum(m.s1),sum(m.s2),sum(m.pr),sum(m.Dist) ,sum(m.pr)+sum(m.Dist), (sum(m.pr)+sum(m.Dist)) / e.Sem_Annee
    from etablissement e 
    inner join groupe g on g.CodeEtab = e.CodeEtb
     inner join  affectmodule af on g.CodeGrp= af.Groupe 
    inner join Modules m on af.ModuleCode = m.CodeMd 
    where g.CodeFlr = m.CodeFlr and af.Matricule =$mat
    and af.CodeEtab='$Etab' and af.AnneeFr='$TAnn[0]'")->fetch();

    $page = new PagePDF_TableauService($pdf);

    $nbpage = intval(count($_SESSION['Module_Form']) / 20);
    if (count($_SESSION['Module_Form']) % 20 != 0) {
        $nbpage++;
    }

    for ($i = 0; $i < $nbpage; $i++) {
        $page->pdf->AddPage();
        $page->AddPagePDF($_SESSION["Annee"],$info[1],$info[0],$InfoHeures,array_slice($_SESSION['Module_Form'],20*$i,20));
    }
    $page->AfficherPDF();
}
