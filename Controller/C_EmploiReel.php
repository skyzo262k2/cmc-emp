<?php
require "../Model/M_EmploiReel.php";


require "../Model/Word.php";

use Shuchkin\SimpleXLSXGen;
require('../simplexlsxgen/src/SimpleXLSXGen.php');

session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

$word=new Word();
$empR=new Emploi_Reel();
$codetb=$_SESSION['Etablissement']['CodeEtb'];
$anne=explode('/',$_SESSION['Annee']);
$Groupes=$empR->GetGroupes($codetb,$anne[0]);
$imprimer="";
$test=false;


if(isset($_POST["pdfone"])){
    $d = $_POST["debut"];
    $f = $_POST["fin"];
    $grp = trim($_POST["group"],"'");
    header("location:../Controller/C_PDF_Emploi_Groupe.php?grp='$grp'&debut='$d'&fin='$f'");
}


if(isset($_POST['group']) && $_POST['group']!="")
{
    $hiddensup='hidden';
    $grp=$_POST['group'];
    $emploiG=$empR->getEmploigroup($grp,$codetb,$anne[0]);
    $_SESSION['semaine']=Separer($emploiG);
    $json=json_encode($emploiG);
    print_r($json);

}

if(isset($_POST['execl']))
{
    $tables=[];

    $tables[]=$col=['Groupe',' Formateur','CodeSl','Description Module','Code Module','Jour','Seance','Type seance'];
    $col=['','','','','','',''];

    $tables[]=$col;
    
    foreach ($emploiG as $seanc) {
        $tables[]=[
            $_POST['execl'],$seanc['nomF'],$seanc['CodeSl'],$seanc['descpMd']
            ,$seanc['CodeMd'],$seanc['Jour'],$seanc['Seance'],$seanc['TypeSc']
        ];
    }

    $xlsx =SimpleXLSXGen::fromArray($tables);
    $xlsx->downloadAs("Emploi Groupe ".$_POST['execl'].".xlsx");
}

if(isset($_POST['execl_tous']))
{
    $tables=[];
    foreach ($Groupes as $group) {
        $tables[]=$col=['Groupe',' Formateur','CodeSl','Description Module','Code Module','Jour','Seance','Type seance'];
        $col=['','','','','','',''];
        $tables[]=$col;
        $emploiG=$empR->getEmploigroup($group['CodeGrp'],$codetb,$anne[0]);
        foreach ($emploiG as $seanc) {
            $tables[]=[
                $group['CodeGrp'],$seanc['nomF'],$seanc['CodeSl'],$seanc['descpMd']
                ,$seanc['CodeMd'],$seanc['Jour'],$seanc['Seance'],$seanc['TypeSc']
            ];
        }
        $col=['','','','','','',''];
        $tables[]=$col;
    }
    $xlsx =SimpleXLSXGen::fromArray($tables);
    $xlsx->downloadAs("Emploi Groupe ".$_POST['execl'].".xlsx");
}
if(isset($_POST['word']))
{
        $d = $_POST["debut"];
        $f = $_POST["fin"];
        $word=new Word();
        $word->Cadre($_SESSION['semaine'],'Groupe',$_POST['word'],$_SESSION['Annee'],$d,$f);
        $word->save($_POST['word']);
        $test=true;
}

if(isset($_POST['tous_word']))
{
        $d = $_POST["debut"];
        $f = $_POST["fin"];
        $word=new Word();
        foreach($Groupes as $group)
        {
            $emploi=$empR->getEmploigroup($group['CodeGrp'],$codetb,$anne[0]);
            $_SESSION['semaine']=Separer($emploi);
            $word->Cadre($_SESSION['semaine'],'Groupe',$group['CodeGrp'],$_SESSION['Annee'],$d,$f);
        }
        $word->save('tous');
        $test=true;
}

function Separer($table)
{
    $semaine= ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $infomation=[['','','',''],['','','',''],['','','',''],['','','',''],['','','',''],['','','','']]; 
    foreach($table as $data){ 
        for($k=0;$k<count($semaine);$k++)
        {
            if($semaine[$k]==$data['Jour'])
            {
                for ($i=1; $i < 5 ; $i++) { 
                    if($data['Seance']==$i)
                    {
                        $infomation[$k][$i-1] =$data['nomF'].'//'.$data['descpMd'].'//'.$data['CodeSl'].'  '.$data['TypeSc'];
                    }
                }
            }
        }
    }
   return $infomation;
}
 
function split($tab)
{
    $tb=explode('/',$tab);
    return $tb;
}
if(isset($_POST['archiver']))
 {
    $empR->Archiver($anne[0],$codetb);
    echo 'yes';
 }

if(isset($_POST["pdfall"])){
        $d = $_POST["debut"];
        $f = $_POST["fin"];
        header("location:../Controller/C_PDF_Emploi_All_Groupe.php?debut='$d'&fin='$f'");
}



if(!isset($_POST['group']))
    require "../View/V_EmploiReel.php";
