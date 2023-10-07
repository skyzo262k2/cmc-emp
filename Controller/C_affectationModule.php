<?php
require "../Model/Word.php";
require "../Model/M_AffectationModule.php";

use Shuchkin\SimpleXLSXGen;

require('../simplexlsxgen/src/SimpleXLSXGen.php');

session_start();

if(!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille"){
    if(!isset($_SESSION["userFormateur"]))
        header("location:../Controller/C_Login.php");
}

$codetab = $_SESSION['Etablissement']['CodeEtb'];
$affecter = new Affecter();
$FormateursGroups = $affecter->Formateurs_Groupes($codetab);
$Groupes = $FormateursGroups[0];
$Formateur = $FormateursGroups[1];
$anne = explode('/', $_SESSION['Annee']);
$grp = "";
$mat_F = "";
$nom_F = "";
$modules = "";
$btn_ajt = "";
$moduleFomateur = "";
$imprimer = "";
$open = "";
$test = false;

if (isset($_POST['sup'])) {
    $infomat = explode('/', $_POST['sup']);
    //   mat     ,   grp       ,   cdmd      ,    an       ,  cdtb
    $bool = $affecter->VerifierInEmploi($infomat[0], $infomat[1], $infomat[2], $infomat[3], $codetab);
    if ($bool['bol']) {
        $inf = explode('/', $_POST['sup']);
        $mat = $inf[0];
        $grpe = $inf[1];
        $cdmd = $inf[2];
        $ann = $inf[3];
        $e = $affecter->SupprimerAffectation($mat, $grpe, $cdmd, $anne[0], $codetab);
        // $_POST['formateur'] = $_SESSION['frm']['Matricule'];
        // $_POST['groupe']=$_SESSION['group']['CodeGrp'];
        echo 'test';
    } else
        echo 0;
}

if (isset($_POST['bntajt']) && isset($_POST['Modules']) && isset($_POST['format'])) {
    $grp = $_POST['group'];
    $frm = $_POST['format'];
    $anne = explode('/', $_SESSION['Annee']);
    $affectmodule = $_POST['Modules'];

    $affes=json_decode($affectmodule);
    foreach ($affes as $codemodule) {
        $affecter->AffecterModule($frm, $grp, $codemodule, $anne[0], $codetab);
    }
}

if (isset($_POST['trans_test'])) :
    $_SESSION['trans'] = $infomat = explode('/', $_POST['trans_test']);
    $bol = $affecter->VerifierInEmploi($infomat[0], $infomat[1], $infomat[2], $infomat[3], $codetab);
    if ($bol['bol'] === 0)
        print_r($bol['bol']);
    else {
        print_r($bol['bol']);
    }

endif;

if (isset($_POST['valider_trans'])) :
    $infomat = $_SESSION['trans'];
    $newmat = $_POST['form_trans'];
    $test = $affecter->TransfereNewFormateur($newmat, $infomat[0], $infomat[1], $infomat[2], $infomat[3], $codetab);
    print_r($test);
endif;

if (isset($_POST['efm'])) :
    $emfP = $_POST['efmSe'];
    $infomat = explode('/', $_POST['efm']);
    $test=$affecter->Efm($emfP, $infomat[1], $infomat[2], $infomat[3], $infomat[4], $codetab);
    print_r($test);
endif;


if(isset($_POST['formateur']) ||  isset($_SESSION["userFormateur"]) ):
    $dis='';
    $hid='';
    if(!isset($_SESSION["userFormateur"])){
        $mat_F = $_POST['formateur'];
        $_SESSION['frm'] = Find($mat_F, $Formateur, 'Matricule');
        $nom_F = $_SESSION['frm']['Nom'] . ' ' . $_SESSION['frm']['Prenom'];
    }else {
        $dis='disabled';
        $hid='hidden';
        $_SESSION['frm'] =$mat_F =$_SESSION["userFormateur"]['Matricule'] ;
        $nom_F = $_SESSION['userFormateur']['Nom'] . ' ' . $_SESSION['userFormateur']['Prenom'];
    }

    $moduleFomateur = $affecter->GetFormateurModule($mat_F, $codetab, $anne[0]);
    $_SESSION['Module_Form'] = $moduleFomateur;

    $masshorraire = 0;
    $s1 = 0;
    $s2 = 0;
    $avc = 0;

    $tbody = "";
    foreach ($moduleFomateur as $MdFrmt) {
        if($MdFrmt["taux"] < 90)
            $color='green';
        if($MdFrmt["taux"] >=90 && $MdFrmt["taux"]<=100)
            $color='yellow';
        if($MdFrmt["taux"]>100)
            $color='red';

        if($MdFrmt["Fpa"]=='O'):
            // echo $MdFrmt["s1"].'<br>';
            $tax=$_SESSION['Etablissement']['TauxFPA'];
            $MdFrmt["s1"]=($tax/100)*$MdFrmt["s1"];
            $MdFrmt["s2"]=($tax/100)*$MdFrmt["s2"];
            $MdFrmt["taux"]=$MdFrmt["avc"]!=0?$MdFrmt["avc"]/ ($MdFrmt["s1"]+ $MdFrmt["s2"])*100:0;
        endif;
        $tbody .= "<tr>      <td>" . $MdFrmt["Groupe"] . "</td>";
        $tbody .=    "<td>" . $MdFrmt["descpMd"] . "</td>
                            <td>" . $MdFrmt["CodeMd"] . "</td>
                            <td>" . $MdFrmt["s1"] . "</td>
                            <td>" . $MdFrmt["s2"] . "</td>
                            <td>" . $MdFrmt["codeflr"] . "</td>
                            <td>" . $MdFrmt["annee"] . "</td>
                            <td>" . $MdFrmt["Fpa"] . "</td>
                            <td>" . $MdFrmt["avc"] . "</td>
                            <td style='background-color:$color;'>" . number_format($MdFrmt["taux"], 2) . "%</td>
                            <td><button type='button' $dis onclick='openF(this)' value='" . $MdFrmt["efm"] . "/" . $mat_F . "/" . $MdFrmt["Groupe"] . "/" . $MdFrmt["CodeMd"] . "/" . $MdFrmt['anneefr'] . "'>" . $MdFrmt["efm"] . "</button></td>
                            <td  $hid>
                                <div id='flex'>
                                    <button type='button' onclick='TestTransfereModule(this)'  value='" . $mat_F . "/" . $MdFrmt["Groupe"] . "/" . $MdFrmt["CodeMd"] . "/" . $MdFrmt['anneefr'] . "' name='trans_test'>tr.Module</button>
                                    <button type='button' onclick='SupprimerAffectation(this)' value='" . $mat_F . "/" . $MdFrmt["Groupe"] . "/" . $MdFrmt["CodeMd"] . "/" . $MdFrmt['anneefr'] . "' name='sup'>Sup</button>
                                </div>
                            </td>                         
                </tr>";
        $s1 += $MdFrmt["s1"];
        $s2 += $MdFrmt["s2"];
        $avc += $MdFrmt["avc"];
    }

    $_SESSION['s1'] = $s1;
    $_SESSION['s2'] = $s2;
    $masshorraire = $s1 + $s2;
    $_SESSION['avc']=$avc!=0?number_format(($avc/$masshorraire)*100,2):0;
    $heureparsemaine = $masshorraire / $_SESSION["Etablissement"]["Sem_Annee"];

    $_SESSION['masshorraire'] = $masshorraire;
    $tbody .= "<div id='inf' hidden><span style='margin-left:0px;' id='s1'> " . $s1 . "</span>";
    $tbody .= "<span id='s2'> " . $s2 . "</span>";
    $tbody .= "<span id='resete'> " . $masshorraire-$avc . "</span>";
    $tbody .= "<span id='mass'>" . $masshorraire . "</span>";
    $tbody .= "<span id='nbsemaine'>" . number_format($heureparsemaine, 2) . "</span></div>";
    $tbody .= "<span id='to_avc' hidden>" .$_SESSION['avc']. "</span></div>";

    $tbody .= "<div id='imp' hidden><a href='../Controller/C_Tableu_Service.php?Mat=$mat_F'>
        <img src='../Images/pdf.png' alt='not found' style='width: 35px;height: 35px;'>
    </a>";
    $tbody.=!isset($_SESSION['userFormateur'])?"
    <button  onclick='Imprition(this)' value='$mat_F' name='MatW' style='background: none;border:none;'>
            <img src='../Images/word.png' alt='not found' style='width: 35px;height: 35px;'>
    </button>
    <button   onclick='Imprition(this)' name='execl' style='background: none;border:none;'>
        <img src='../Images/execl.jpeg' alt='not found' style='width: 35px;height: 35px;'>
    </button>
    </div>":'';
    if(isset($_SESSION["userFormateur"]))
        $_SESSION["userFormateur"]["tableservice"]=$tbody;
    else
        print_r($tbody); 
endif;

if (isset($_GET['execl'])) :
    $col = ['Matricule', 'Formateur', 'Groupe', 'Description Module', 'Code Module', 'S1', 'S2', 'Filière', 'Annee scolaire', 'Avancement'];
    $tables = [];
    $tables[] = $col;
    $col = ['', '', '', '', '', '', '', '', '', ''];
    $tables[] = $col;
    foreach ($_SESSION['Module_Form'] as $mdl) :
        $table = [
            $_SESSION['frm']['Matricule'],
            $nom_F, $mdl['Groupe'], $mdl['descpMd'], $mdl['CodeMd'], $mdl['s1'], $mdl['s2'], $mdl['codeflr'], $mdl['annee'], $mdl['avc']
        ];
        $tables[] = $table;
    endforeach;
    $xlsx = SimpleXLSXGen::fromArray($tables);
    $xlsx->downloadAs("affectation$nom_F.xlsx");
endif;

if (isset($_POST['execltaux'])) :
    $TauxAllFormateur=$affecter->TauxAvancementAllFormateur($codetab, $anne[0]);
    $col = ['Matricule', 'Formateur','S1','S2','Masse Horaire','avancement','Taux Avancement'];
    array_unshift($TauxAllFormateur,$col);
    $xlsx = SimpleXLSXGen::fromArray($TauxAllFormateur);
    $xlsx->downloadAs("TauxAvancementAllFormateur.xlsx");
endif;


if (isset($_GET['MatW'])):
    $mat_F = $_GET['MatW'];
    $nom_F = $_SESSION['frm']['Nom'] . ' ' . $_SESSION['frm']['Prenom'];
    $InfoHeures = $affecter->MatWord($mat_F,$codetab, $anne[0]);
    $mass = $InfoHeures[0] + $InfoHeures[1];
    $nbparsemaine = $mass / $_SESSION["Etablissement"]["Sem_Annee"];
    $af = new Affectation();
    $af->Cadre($_SESSION['Module_Form'], $nom_F, $_SESSION['Annee'], $_SESSION['Etablissement']['Ville'], "$mass", "$InfoHeures[0]", "$InfoHeures[1]", $nbparsemaine);
    $af->save($nom_F);
endif;

if (isset($_POST['execl_tous'])):
    $forms = $affecter->excelFor($anne[0], $codetab);
    $tables = [];
    foreach ($forms as $mt) {
        $moduleFomateur = $affecter->GetFormateurModule($mt[0], $codetab, $anne[0]);
        $col = ['Matricule', 'Formateur', 'Groupe', 'Description Module', 'Code Module', 'S1', 'S2', 'Filière', 'Annee scolaire', 'Avancement'];
        $tables[] = $col;
        $col = ['', '', '', '', '', '', '', '', '', ''];
        $tables[] = $col;
        foreach ($moduleFomateur as $mdl) :
            $table = [
                $mt[0], $mt[1], $mdl['Groupe'], $mdl['descpMd'], $mdl['CodeMd'], $mdl['s1'], $mdl['s2'], $mdl['codeflr'], $mdl['annee'], $mdl['avc']
            ];
            $tables[] = $table;
        endforeach;
        $tables[] = $col;
        $tables[] = $col;
    }

    $xlsx = SimpleXLSXGen::fromArray($tables);
    $xlsx->downloadAs("tous affectation$anne[0].xlsx");

endif;


if (isset($_POST['groupe']) and $_POST['groupe'] != "") :
    $grp = $_POST['groupe'];
    $cdgrp = $_POST['groupe'];
    $group = Find($cdgrp, $Groupes, 'CodeGrp');
    $_SESSION['group'] = $group;
    $anne_f = $group['Annee'];
    $cdflr = $group['CodeFlr'];
    $modules = $affecter->GetGroupe($cdgrp, $anne[0], $codetab, $cdflr, $anne_f);
    $tbody = "";
    if (count($modules) != 0) {

        foreach ($modules as $module) {
            $tbody .= "<tr>
                            <td>" . $module["CodeMd"] . "</td>";
            $tbody .=        "<td>" . $module["DescpMd"] . "</td><td>" . $module["CodeFlr"] . "</td><td>" . $module["Annee"] . "</td>
                            <td><input type='checkbox' id='check' value='" . $module["CodeMd"] . "' name='" . $module["CodeMd"] . "' ></td>
                    </tr>";
        }
        print_r($tbody);
    } else
        echo 'false';
endif;





function Find($code, $table, $key)
{
    foreach ($table as $tab) {
        if ($tab[$key] == $code) {
            return $tab;
        }
    }
}
if (!isset($_POST['formateur']) && !isset($_POST['groupe']) && !isset($_POST['efm']) && !isset($_POST['valider_trans']) && !isset($_POST['bntajt']) && !isset($_POST['sup']) && !isset($_POST['trans_test']))
    require "../View/V_AffectationModule.php";
