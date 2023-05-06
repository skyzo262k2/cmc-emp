<?php

use PhpOffice\PhpWord\PhpWord;

require_once '../PHPWord-develop/bootstrap.php';


class Word
{
    public $phpword;
    public $page;
    public $paper;
     
    public function __construct()
    {
        $this->phpword=new \PhpOffice\PhpWord\PhpWord();
        $this->paper = new \PhpOffice\PhpWord\Style\Paper();
        $this->paper->setSize('Letter');
    }
    public function Cadre($semaines,$type,$grp,$an,$debut="",$fin="")
    {
       $this->page=$this->phpword->addSection(array(
            'pageSizeW' => $this->paper->getWidth(), 
            'pageSizeH' => $this->paper->getHeight(), 
            'orientation' => 'landscape'
        ));
        $head=$this->page->addHeader();
        $table=$head->addTable();
        $row=$table->addRow(200);
        $row->addCell(9999,["border"=>"10"])->addText("CFN/ISTA Nador",["size"=>"10",'align'=>'center']);

        $cl=$row->addCell(9999);
        $cl->addText('Emploi De Temps '.$an,["size"=>"15",'align'=>'center']);
        $cl->addText("du $debut à $fin ",["size"=>"15",'align'=>'center']);

        $row->addCell(9999)->addImage('../Images/logo.jpg',["width"=>"70",'align'=>'right']);
        
        $this->page->addText("$type : ".$grp,["size"=>"15"]);
        $seance= ['8h30 - 11h00', '11h00 - 13h30', '13h30 - 16h00', '16h00 - 18h30'];
           
        $table=$this->page->addTable([
            'borderSize' => 6, 
            'width'=>80*70,
            'unit'=>'pct',
            'align'=>'center' ,
        ]);

        $row1=$table->addRow();
        $row1->addCell(2000)->addText("Heures/Jours");

        foreach($seance as $sc)
        {          
            $row1->addCell()->addText($sc,["size"=>"10"],["align"=>"center"]);
        }
        $semaine= ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $i=0;
        
        foreach($semaine as $jour)
        {  
            $row=$table->addRow(900);
            $row->addCell()->addText($jour);

            $cl=$row->addCell(9999);
            $data=explode('//',$semaines[$i][0]);

            if(count($data)>1):
                if(isset($data[3])){
                    $distance=$data[3].' '.$data[0];
                    $cl->addText($distance,array(),array('spaceAfter' => 0));
                }
                else   
                $cl->addText($data[0],array(),array('spaceAfter' => 0));
                $cl->addText($data[1],array(),array('spaceAfter' => 0));
                $cl->addText($data[2],array(),array('spaceAfter' => 0));
            endif;

            
            $cl=$row->addCell(9999);
            $data=explode('//',$semaines[$i][1]);

            if(count($data)>1):
                if(isset($data[3])){
                    $distance=$data[3].' '.$data[0];
                    $cl->addText($distance,array(),array('spaceAfter' => 0));
                }
                else   
                $cl->addText($data[0],array(),array('spaceAfter' => 0));
                $cl->addText($data[1],array(),array('spaceAfter' => 0));
                $cl->addText($data[2],array(),array('spaceAfter' => 0));
            endif;

            $cl=$row->addCell(9999);
            $data=explode('//',$semaines[$i][2]);

            if(count($data)>1):
                if(isset($data[3])){
                    $distance=$data[3].' '.$data[0];
                    $cl->addText($distance,array(),array('spaceAfter' => 0));
                }
                else   
                $cl->addText($data[0],array(),array('spaceAfter' => 0));
                $cl->addText($data[1],array(),array('spaceAfter' => 0));
                $cl->addText($data[2],array(),array('spaceAfter' => 0));
            endif;

            $cl=$row->addCell(9999);
            $data=explode('//',$semaines[$i][3]);

            if(count($data)>1):
                if(isset($data[3])){
                    $distance=$data[3].' '.$data[0];
                    $cl->addText($distance,array(),array('spaceAfter' => 0));
                }
                else   
                $cl->addText($data[0],array(),array('spaceAfter' => 0));
                $cl->addText($data[1],array(),array('spaceAfter' => 0));
                $cl->addText($data[2],array(),array('spaceAfter' => 0));
            endif;

            $i++;
        }

        $this->page->addText(); 
        $table=$this->page->addTable
        ([
            'borderSize' => 6, 
            'width'=>80*50,
            'unit'=>'pct',
            'align'=>'center' 
        ]);
        $row=$table->addRow(1000);
        $row->addCell(2000)->addText('Directeur/Directeur Pédagogique Ou Responsable de Formation',['align'=>'center']);
        $row->addCell(2000)->addText('Directeur du CF',['align'=>'center']);

    }

    function save($grp)
    {
        $sv=date('Y m d');
        $svt=date('h m s');
        $fileName="Emploi $grp $sv $svt.docx";
        $path="../$fileName";
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpword, 'Word2007');
        $objWriter->save($path); 
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush();
        readfile($path);
        unlink("$path");
        exit; 
    }

}


class Affectation
{
    public $phpword;
    public $paper;
    public $page;
    function __construct()
    {
        $this->phpword=new \PhpOffice\PhpWord\PhpWord();
        $this->paper = new \PhpOffice\PhpWord\Style\Paper();
        
    }

    function Cadre($module,$nom,$an,$city,$horire,$s1,$s2)
    {
        $this->page=$this->phpword->addSection(array(
            'pageSizeW' => $this->paper->getWidth(), 
            'pageSizeH' => $this->paper->getHeight(), 
            'orientation' => 'landscape'
        ));
        $head=$this->page->addHeader();
        $table=$head->addTable();

        $row=$table->addRow(200);
        $row->addCell(9999)->addImage('../Images/logo.jpg',["width"=>"70",'align'=>'left']);
        $row->addCell(9999)->addText('Tableau de service',["size"=>"15",'align'=>'center']);
        $row->addCell(9999)->addText("Année de formation : ".$an,["size"=>"10",'align'=>'right']);

        $row=$table->addRow(69);
        $row->addCell(9999)->addText('CFN/ISTA '.$city);
        $row->addCell(9999)->addText('');
        $this->page->addText('');
        
        $table=$this->page->addTable();

        $row=$table->addRow();
        $row->addCell(9999)->addText('Formateur : '.$nom);
        $row->addCell(9999)->addText("Masse Horaire : ".$horire,["size"=>"10"]);
        $this->page->addText('');
        $table1=$this->page->addTable([
            'borderSize' => 6, 
        ]);
        
        $row1=$table1->addRow();
        $row1->addCell(1400)->addText('Groupe', array(),array('spaceAfter' => 0));
        $row1->addCell(9999)->addText('Module', array(),array('spaceAfter' => 0));
        $row1->addCell(1400)->addText('S1', array(),array('spaceAfter' => 0));
        $row1->addCell(1400)->addText('S2', array(),array('spaceAfter' => 0));        
        foreach($module as $mdl)
        {
            $row1=$table1->addRow();
            $row1->addCell(1400)->addText($mdl['Groupe'],array(),array('spaceAfter' => 0));
            $row1->addCell(9999)->addText($mdl['descpMd'],array(),array('spaceAfter' => 0));
            $row1->addCell(1400)->addText($mdl['s1'],array(),array('spaceAfter' => 0));
            $row1->addCell(1400)->addText($mdl['s2'],array(),array('spaceAfter' => 0));
        }
        $this->page->addText('');
        $table=$this->page->addTable();

        $row=$table->addRow(200);
        $row->addCell(1400)->addText('');
        $row->addCell(9999)->addText('');
        $row->addCell(1400)->addText('S1 :'.$s1);
        $row->addCell(1400)->addText('S2 :'.$s2);
    }

       function save($nom)
    {
        $sv=date('Y m d');
        $svt=date('h m s');
        $fileName="affectation $nom $sv $svt.docx";
        $path="../$fileName";
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpword, 'Word2007');
        $objWriter->save($path); 
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush();
        readfile($path);
        unlink("$path");
        exit; 
    }
}
