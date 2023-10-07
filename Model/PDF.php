<?php

require "../Include/fpdf.php";

class PagePDF_TableauService
{
    public $pdf;
    public $Annee;
    public $NomEtab;
    public $NomPrenom;
    public $Affecteds;
    public  $InfoHeures;

    function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function AddPagePDF($year, $NameEsta, $grp, $InformationHour, $Affectations)
    {
        // $this->pdf->AddPage();
        $this->pdf->Image('../Images/logo.jpeg', 10, 2, 25, 25);

        $this->pdf->SetY(20);
        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 15, $NameEsta, 0, 1, "L", 0);

        $this->pdf->SetY(25);
        $this->pdf->SetFont('Arial', '', 20);
        $this->pdf->Cell(0, -10, "Tableau de service", 0, 1, "C", 0);

        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, -10, "Année de formation :  " . $year, 0, 1, "R", 0);

        $this->pdf->SetY(15);
        $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->Cell(0, 50, "Formateur : ", 0, 0, "L", 0);
        $this->pdf->SetX(38);
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Cell(0, 50, $grp, 0, 0, "L", 0);

        $this->pdf->SetX(200);
        $this->pdf->Cell(0, 50, "Masse Horaire :    " . number_format($InformationHour[4], 2) . " H", 0, 0, "", 0);




        $position_entete = 45;
        $this->entete_table($position_entete);
        $position_detail = 53; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
        $this->pdf->SetFont('Arial', '', 9);

        foreach ($Affectations as $Affec) {
            $this->pdf->SetY($position_detail);
            $this->pdf->SetX(10);
            $this->pdf->Cell(25, 6, $Affec['Groupe'], 1, 0, 'L', 1);

            $this->pdf->SetX(35);
            $this->pdf->Cell(12, 6, $Affec['annee'], 1, 0, 'C', 1);

            $this->pdf->SetX(47);
            $this->pdf->Cell(31, 6, $Affec['codeflr'], 1, 0, 'L', 1);

            $this->pdf->SetX(78);
            $this->pdf->Cell(18, 6, $Affec['CodeMd'], 1, 0, 'L', 1);

            $this->pdf->SetX(96);
            $this->pdf->Cell(161, 6, $Affec['descpMd'], 1, 0, 'L', 1);

            $this->pdf->SetX(256);
            $this->pdf->Cell(15, 6, $Affec['s1'], 1, 0, 'C', 1);

            $this->pdf->SetX(271);
            $this->pdf->Cell(15, 6, $Affec['s2'], 1, 0, 'C', 1);

            $position_detail += 6;
        }
        $this->pdf->Ln(5);

        $this->pdf->SetFont('Arial', 'B', 10);

        $this->pdf->SetX(258);
        $this->pdf->Cell(0, 15, $InformationHour[0], 0, 0, "", 0);

        $this->pdf->SetX(273);
        $this->pdf->Cell(0, 15, $InformationHour[1], 0, 0, "", 0);
    }


    public function entete_table($position_entete)
    {
        $this->pdf->SetFillColor(250);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetY($position_entete);

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetX(10);
        $this->pdf->Cell(25, 8, 'Groupe', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 6.5);
        $this->pdf->SetX(35);
        $this->pdf->Cell(12, 8, 'Année G.', 1, 0, 'L', 1);

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetX(47);
        $this->pdf->Cell(31, 8, 'Filiere', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->SetX(78);
        $this->pdf->Cell(18, 8, 'Code M.', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetX(96);
        $this->pdf->Cell(161, 8, 'Module', 1, 0, 'C', 1);

        $this->pdf->SetX(256);
        $this->pdf->Cell(15, 8, 'S1', 1, 0, 'C', 1);

        $this->pdf->SetX(271);
        $this->pdf->Cell(15, 8, 'S2', 1, 0, 'C', 1);

        $this->pdf->Ln(); // Retour à la ligne
    }
    public function AfficherPDF()
    {
        $this->pdf->Output('table_service.pdf', 'I');
    }
}

class PagePDF_Emploi
{
    public $pdf;
    public $Annee;
    public $NomEtab;
    function __construct($pdf, $ann, $Etab)
    {
        $this->pdf = $pdf;
        $this->Annee = $ann;
        $this->NomEtab = $Etab;
    }

    public function NewEmploi($TypeEmp, $val, $dtDebut, $dtFin, $T_Lundi, $T_Mardi, $T_Mercedi, $T_Jeudi, $T_Vendredi, $T_Samedi)
    {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetY(10);
        $this->pdf->SetX(10);
        $this->pdf->Cell(-5, 10, $this->NomEtab, 0, 1, "L", 0);

        $this->pdf->Cell(0, -10, "Emploi Du temps " . $this->Annee, 0, 1, "C", 0);
        $this->pdf->Cell(0, 25, "Du " . $dtDebut . " Au " . $dtFin, 0, 1, "C", 0);

        $this->pdf->Image('../Images/logo.jpeg', 265, 5, 20, 20);
        $this->pdf->SetY(30);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 0, '', 'B', 0, 'C', 0);
        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->SetY(30);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 12, $TypeEmp . ": " . $val, 0, 0, "L", 0);


        $this->pdf->SetFillColor(250);
        $this->pdf->SetTextColor(0);
        $this->CreateEnteteTable(42);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->CreateNameDay(56);
        $this->CreateRowDay(56, $T_Lundi);
        $this->CreateRowDay(73, $T_Mardi);
        $this->CreateRowDay(90, $T_Mercedi);
        $this->CreateRowDay(107, $T_Jeudi);
        $this->CreateRowDay(124, $T_Vendredi);
        $this->CreateRowDay(141, $T_Samedi);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetY(165);
        $this->pdf->SetX(10);
        $this->pdf->Cell(137, 24, '', 1, 0, 'C', 0);
        $this->pdf->SetY(169);
        $this->pdf->SetX(80);
        $this->pdf->Cell(1, 1, 'Directeur / Directeur Pédarogique', 0, 0, 'C', 0);
        $this->pdf->SetY(174);
        $this->pdf->SetX(78);
        $this->pdf->Cell(1, 1, 'Ou Responsable de Formation', 0, 0, 'C', 0);
        $this->pdf->SetY(165);
        $this->pdf->SetX(147);
        $this->pdf->Cell(141, 24, '', 1, 0, 'C', 0);
        $this->pdf->SetY(169);
        $this->pdf->SetX(215);
        $this->pdf->Cell(1, 1, 'Directeur Du CF', 0, 0, 'C', 0);
        // $this->pdf->Cell(0, 0, '', '', 0, 'C', 0);

    }

    public function CreateSeance($PosY, $PosX, $T_Info, $width)
    {
        $T = explode("-", $T_Info[0]);
        $this->pdf->SetY($PosY);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->SetX($PosX);
        $this->pdf->Cell($width, 17, "", 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 7);
        $this->pdf->SetY($PosY + 6);
        $this->pdf->SetX($PosX + 30);
        $this->pdf->Cell(1, 1, $T_Info[2], 0, 0, 'C', 1);

        $this->pdf->SetY($PosY + 9);
        $this->pdf->SetX($PosX + 30);
        $this->pdf->Cell(1, 1, $T_Info[1], 0, 1, 'C', 1);


        if (count($T) == 1) {
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetY($PosY + 2.5);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $T_Info[0], 0, 1, 'C', 1);
        } else {
            if (count($T) == 2)
                $this->pdf->SetFont('Arial', 'B', 8);
            elseif (count($T) == 3)
                $this->pdf->SetFont('Arial', 'B', 8);
            elseif (count($T) == 4)
                $this->pdf->SetFont('Arial', 'B', 7);
            else {
                $this->pdf->SetFont('Arial', 'B', 4);
            }
            $this->pdf->SetY($PosY + 2.5);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $T_Info[0], 0, 1, 'C', 1);
        }

        $mots_module = explode(" ", $T_Info[3]);
        $mot1 = "";
        $mot2 = "";
        $mot3 = "";
        $mot4 = "";

        if (count($mots_module) <= 5) {
            foreach ($mots_module as $mot) {
                $mot1 .= $mot . " ";
            }
        } elseif (count($mots_module) > 5 and count($mots_module) <= 10) {
            for ($i = 0; $i < 5; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 5; $i < count($mots_module); $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }
        } elseif (count($mots_module) > 10 and count($mots_module) <= 15) {
            for ($i = 0; $i < 5; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 5; $i < 10; $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }
            for ($i = 10; $i < count($mots_module); $i++) {
                $mot3 .= $mots_module[$i] . " ";
            }
        } else {
            for ($i = 0; $i < 5; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 5; $i < 10; $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }

            for ($i = 10; $i < 15; $i++) {
                $mot3 .= $mots_module[$i] . " ";
            }
            for ($i = 15; $i < count($mots_module); $i++) {
                $mot4 .= $mots_module[$i] . " ";
            }
        }
        if ($mot3 != "" and $mot2 != "" and $mot1 != "" and $mot4 != "") {
            $this->pdf->SetFont('Arial', 'B', 4);

            $this->pdf->SetY($PosY + 11);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot1, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 12.4);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot2, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 13.8);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot3, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 15.2);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot4, 0, 1, 'C', 1);
        }
        if ($mot3 != "" and $mot2 != "" and $mot1 != "" and $mot4 == "") {
            $this->pdf->SetFont('Arial', 'B', 5);

            $this->pdf->SetY($PosY + 11.5);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot1, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 13.3);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot2, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 15.2);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot3, 0, 1, 'C', 1);
        }
        if ($mot3 == "" and $mot2 != "" and $mot1 != "") {
            $this->pdf->SetFont('Arial', 'B', 6);

            $this->pdf->SetY($PosY + 12);
            $this->pdf->SetX($PosX + 35);
            $this->pdf->Cell(1, 1, $mot1, 0, 1, 'C', 1);

            $this->pdf->SetY($PosY + 15);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot2, 0, 1, 'C', 1);
        }
        if ($mot3 == "" and $mot2 == "" and $mot1 != "") {
            $this->pdf->SetFont('Arial', 'B', 6);

            $this->pdf->SetY($PosY + 13);
            $this->pdf->SetX($PosX + 30);
            $this->pdf->Cell(1, 1, $mot1, 0, 1, 'C', 1);
        }
    }
    public function CreateRowDay($Pos, $TabS)
    {
        $S1 = $TabS[0];
        $S2 = $TabS[1];
        $S3 = $TabS[2];
        $S4 = $TabS[3];
        $this->CreateSeance($Pos, 50, $S1, 60);
        $this->CreateSeance($Pos, 110, $S2, 60);
        $this->CreateSeance($Pos, 170, $S3, 60);
        $this->CreateSeance($Pos, 230, $S4, 58);
    }

    public function CreateNameDay($Pos)
    {
        $Jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
        for ($i = 0; $i <= 5; $i++) {
            $this->pdf->SetY($Pos);
            $this->pdf->SetX(10);
            $this->pdf->Cell(40, 17, $Jours[$i], 1, 0, 'C', 1);
            $Pos += 17;
        }
    }

    public function CreateEnteteTable($Pos)
    {
        $this->pdf->SetY($Pos);
        $this->pdf->SetFont('Arial', 'B', 10);

        $this->pdf->SetX(10);
        $this->pdf->Cell(40, 14, '', 1, 0, 'C', 1);
        $this->pdf->SetY($Pos + 5);
        $this->pdf->SetX(22);
        $this->pdf->Cell(1, 1, 'Heurs', 0, 0, '', 1);
        $this->pdf->SetY($Pos + 10);
        $this->pdf->SetX(22);
        $this->pdf->Cell(1, 1, 'Jours', 0, 0, '', 1);
        $this->pdf->SetY($Pos);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetX(50);
        $this->pdf->Cell(60, 14, '8h30 - 11h00', 1, 0, 'C', 1);
        $this->pdf->SetX(110);
        $this->pdf->Cell(60, 14, '11h00 - 13h30', 1, 0, 'C', 1);
        $this->pdf->SetX(170);
        $this->pdf->Cell(60, 14, '13h30 - 16h00', 1, 0, 'C', 1);
        $this->pdf->SetX(230);
        $this->pdf->Cell(58, 14, '16h00 - 18h30', 1, 0, 'C', 1);
    }


    public function AfficherPDF()
    {
        $this->pdf->Output('Emploi_Temps.pdf', 'I');
    }
}



















class PagePDF_AffectationGrp
{
    public $pdf;
    public $Annee;
    public $NomEtab;
    public $NomPrenom;
    public $Affecteds;
    public  $InfoHeures;

    function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function AddPagePDF($year, $grp, $NameEsta,  $InformationHour, $Affectations)
    {
        // $this->pdf->AddPage();
        $this->pdf->Image('../Images/logo.jpeg', 10, 2, 25, 25);

        $this->pdf->SetY(20);
        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 15, $NameEsta, 0, 1, "L", 0);

        $this->pdf->SetY(25);
        $this->pdf->SetFont('Arial', '', 20);
        $this->pdf->Cell(0, -10, "Affectation de Groupe", 0, 1, "C", 0);

        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, -10, "Année de formation :  " . $year, 0, 1, "R", 0);

        $this->pdf->SetY(15);
        $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->Cell(0, 50, "Groupe : ", 0, 0, "L", 0);
        $this->pdf->SetX(38);
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Cell(0, 50, $grp, 0, 0, "L", 0);

        $this->pdf->SetX(200);
        $this->pdf->Cell(0, 50, "Masse Horaire :    " . $InformationHour[2], 0, 0, "", 0);
        $position_entete = 45;
        $this->entete_table($position_entete);
        $position_detail = 53; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
        $this->pdf->SetFont('Arial', '', 7);

        foreach ($Affectations as $Affec) {
            $this->pdf->SetY($position_detail);
            $this->pdf->SetX(10);
            if ($Affec['NomPr'] != "")
                $this->pdf->Cell(40, 6, $Affec['NomPr'], 1, 0, 'L', 1);
            else
                $this->pdf->Cell(40, 6, "-", 1, 0, 'C', 1);

            $this->pdf->SetX(50);
            $this->pdf->Cell(30, 6, $Affec['codeflr'], 1, 0, 'C', 1);

            $this->pdf->SetX(80);
            $this->pdf->Cell(15, 6, $Affec['CodeMd'], 1, 0, 'L', 1);

            $this->pdf->SetX(95);
            $this->pdf->Cell(171, 6, $Affec['descpMd'], 1, 0, 'L', 1);

            $this->pdf->SetX(256);
            $this->pdf->Cell(15, 6, $Affec['s1'], 1, 0, 'C', 1);

            $this->pdf->SetX(271);
            $this->pdf->Cell(15, 6, $Affec['s2'], 1, 0, 'C', 1);

            $position_detail += 6;
        }
        $this->pdf->Ln(5);

        $this->pdf->SetFont('Arial', 'B', 10);

        $this->pdf->SetX(258);
        $this->pdf->Cell(0, 15, $InformationHour[0], 0, 0, "", 0);

        $this->pdf->SetX(273);
        $this->pdf->Cell(0, 15, $InformationHour[1], 0, 0, "", 0);
    }


    public function entete_table($position_entete)
    {
        $this->pdf->SetFillColor(250);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetY($position_entete);

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetX(10);
        $this->pdf->Cell(40, 8, 'Formateur', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->SetX(50);
        $this->pdf->Cell(30, 8, 'Filiere', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->SetX(80);
        $this->pdf->Cell(15, 8, 'Code M.', 1, 0, 'C', 1);

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetX(95);
        $this->pdf->Cell(171, 8, 'Description Module', 1, 0, 'C', 1);

        $this->pdf->SetX(256);
        $this->pdf->Cell(15, 8, 'S1', 1, 0, 'C', 1);

        $this->pdf->SetX(271);
        $this->pdf->Cell(15, 8, 'S2', 1, 0, 'C', 1);

        $this->pdf->Ln(); // Retour à la ligne
    }
    public function AfficherPDF()
    {
        $this->pdf->Output('table_service.pdf', 'I');
    }
}


class Proposition_EFM
{

    public $Etab;
    public $AnneFr;
    public $pdf;
    public $Information;


    function __construct($pdf, $etab, $anne, $info)
    {
        $this->Etab = $etab;
        $this->AnneFr = $anne;
        $this->pdf = $pdf;
        $this->Information = $info;
    }

    public function AddPagePDF()
    {
        $this->pdf->Image('../Images/logo.jpeg', 10, 5, 30, 30);

        $this->pdf->SetY(20);
        $this->pdf->SetX(45);
        $this->pdf->SetFont('Arial', 'B', 13.5);
        $this->pdf->Cell(0, 0, "Office de la Formation Professionnelle  et de la Promotion de Travail", 0, 1, "C", 0);


        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetY(42);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 0, $this->Etab, 0, 0, "L", 0);

        $this->pdf->SetX(150);
        $this->pdf->Cell(0, 0, $this->AnneFr, 0, 0, "r", 0);

        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetY(48);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 13, "Proposition de l'EFM", 1, 1, "C", 0);

        $this->pdf->SetY(48);
        $this->pdf->SetX(140);
        $this->pdf->Cell(0, 20, "Date : " . $this->Information[6], 0, 1, "C", 0);




        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetY(61);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "Secteur", 1, 1, "L", 0);
        $this->pdf->SetY(69);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "Filière", 1, 1, "L", 0);
        $this->pdf->SetY(77);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "code de module", 1, 1, "L", 0);
        $this->pdf->SetY(85);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "EFM (synthèse/pratique)", 1, 1, "L", 0);
        $this->pdf->SetY(93);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "Masse horaire prévu", 1, 1, "L", 0);
        $this->pdf->SetY(101);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "Masse horaire réalisé", 1, 1, "L", 0);
        $this->pdf->SetY(109);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 8, "Taux d'avancement", 1, 1, "L", 0);
        $this->pdf->SetY(117);
        $this->pdf->SetX(10);
        $this->pdf->Cell(60, 12, "Proposer par le formateur ", 1, 1, "L", 0);


        $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->SetY(61);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[25], 1, 1, "C", 0);

        if (strlen($this->Information[23]) > 53)
            $this->pdf->SetFont('Arial', '', 9.5);
        else
            $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->SetY(69);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[24], 1, 1, "C", 0);

        $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->SetY(77);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[3], 1, 1, "C", 0);
        $this->pdf->SetY(85);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[8], 1, 1, "C", 0);
        $this->pdf->SetY(93);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[26][2], 1, 1, "C", 0);
        $this->pdf->SetY(101);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, $this->Information[26][0], 1, 1, "C", 0);
        $this->pdf->SetY(109);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 8, number_format($this->Information[26][1], 2) . " %", 1, 1, "C", 0);
        $this->pdf->SetY(117);
        $this->pdf->SetX(70);
        $this->pdf->Cell(130, 12, $this->Information[1], 1, 1, "C", 0);



        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetY(135);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 13, "Validation de l'EFM par la commission locale", 1, 1, "C", 0);

        $this->pdf->SetY(135);
        $this->pdf->SetX(150);
        $this->pdf->Cell(0, 20, "Date : " . $this->Information[7], 0, 1, "C", 0);


        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetY(148);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Critères de validation", 1, 1, "C", 0);
        $this->pdf->SetY(155);
        $this->pdf->SetX(10);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(130, 7, "Date de passation", 1, 1, "C", 0);
        $this->pdf->SetY(162);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Barème", 1, 1, "C", 0);
        $this->pdf->SetY(169);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Salle de l'examen ", 1, 1, "C", 0);
        $this->pdf->SetY(176);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Durée", 1, 1, "C", 0);
        $this->pdf->SetY(183);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Structure de l'examen (théorie pratique)", 1, 1, "C", 0);
        $this->pdf->SetY(190);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Degré de difficulté (touché 80% des objectifs)", 1, 1, "C", 0);
        $this->pdf->SetY(197);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Deux variantes ", 1, 1, "C", 0);
        $this->pdf->SetY(204);
        $this->pdf->SetX(10);
        $this->pdf->Cell(130, 7, "Corrigé déposé ", 1, 1, "C", 0);
        $this->pdf->SetY(211);
        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Cell(130, 10, "Décision", 1, 1, "C", 0);
        $this->pdf->SetY(221);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 30, "", 1, 1, "C", 0);


        $this->pdf->SetY(222);
        $this->pdf->SetX(10);
        $this->pdf->Cell(50, 10, "Validé par : " . $this->Information[9], 0, 1, "L", 0);
        $this->pdf->SetY(228);
        $this->pdf->SetX(10);
        $this->pdf->Cell(50, 10, "Remarque : ", 0, 1, "L", 0);
        // Remarque peut contient plusieurs mots
        // strlen($Informations[5]); nombre to line 80 caractere

        $mots_module = explode(" ", $this->Information[5]);
        $mot1 = "";
        $mot2 = "";
        $mot3 = "";
        $mot4 = "";

        if (count($mots_module) <= 9) {
            foreach ($mots_module as $mot) {
                $mot1 .= $mot . " ";
            }
        } elseif (count($mots_module) > 9 and count($mots_module) <= 18) {
            for ($i = 0; $i < 9; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 9; $i < count($mots_module); $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }
        } elseif (count($mots_module) > 18 and count($mots_module) <= 27) {
            for ($i = 0; $i < 9; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 9; $i < 18; $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }
            for ($i = 18; $i < count($mots_module); $i++) {
                $mot3 .= $mots_module[$i] . " ";
            }
        } else {
            for ($i = 0; $i < 9; $i++) {
                $mot1 .= $mots_module[$i] . " ";
            }
            for ($i = 9; $i < 18; $i++) {
                $mot2 .= $mots_module[$i] . " ";
            }
            for ($i = 18; $i < 27; $i++) {
                $mot3 .= $mots_module[$i] . " ";
            }
            for ($i = 27; $i < count($mots_module); $i++) {
                $mot4 .= $mots_module[$i] . " ";
            }
        }
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->SetY(228);
        $this->pdf->SetX(38);
        $this->pdf->Cell(50, 10, $mot1, 0, 1, "L", 0);
        $this->pdf->SetY(232);
        $this->pdf->SetX(38);
        $this->pdf->Cell(50, 10, $mot2, 0, 1, "L", 0);
        $this->pdf->SetY(236);
        $this->pdf->SetX(38);
        $this->pdf->Cell(50, 10, $mot3, 0, 1, "L", 0);
        $this->pdf->SetY(240);
        $this->pdf->SetX(38);
        $this->pdf->Cell(50, 10, $mot4, 0, 1, "L", 0);



        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetY(256);
        $this->pdf->SetX(10);
        $this->pdf->Cell(100, 20, "Visa de directeur pédagogique", 1, 1, "C", 0);
        $this->pdf->SetY(256);
        $this->pdf->SetX(110);
        $this->pdf->Cell(90, 20, "", 1, 1, "C", 0);


        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->SetY(148);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, "OUI", 1, 1, "C", 0);
        $this->pdf->SetY(155);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[14] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(162);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[15] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(169);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[16] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(176);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[17] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(183);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[18] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(190);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[19] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(197);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[20] == "Oui" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(204);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 7, $this->Information[21] == "Oui" ? "X" : "", 1, 1, "C", 0);

        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->SetY(211);
        $this->pdf->SetX(140);
        $this->pdf->Cell(30, 10, $this->Information[22] == "Oui" ? "X" : "", 1, 1, "C", 0);

        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->SetY(148);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, "NON", 1, 1, "C", 0);
        $this->pdf->SetY(155);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[14] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(162);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[15] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(169);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[16] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(176);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[17] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(183);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[18] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(190);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[19] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(197);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[20] == "Non" ? "X" : "", 1, 1, "C", 0);
        $this->pdf->SetY(204);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 7, $this->Information[21] == "Non" ? "X" : "", 1, 1, "C", 0);

        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->SetY(211);
        $this->pdf->SetX(170);
        $this->pdf->Cell(30, 10, $this->Information[22] == "Non" ? "X" : "", 1, 1, "C", 0);
    }
    public function AfficherPDF()
    {
        $this->pdf->Output('table_service.pdf', 'I');
    }
}
