<?php

require "../Model/M_Connexion.php";


class AbsenceStagiaire extends Connexion 
{

    public $typeAbsence;

    function __construct()
    {
    }


    public function AddAbsence($id, $anneeFr, $DateAbsence, $grp, $seance, $CodeModule, $Justify, $Etab)
    {
        try {
            parent::connexion();
            parent::$cnx->query("call SP_AddAbsenceStagiaire('$id', '$anneeFr', '$DateAbsence', '$grp', $seance, '$CodeModule', '$Justify', '$Etab','$this->typeAbsence')");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }
    public function DeleteAbsence($id, $anneeFr, $DateAbsence, $seance, $etab)
    {
        try {
            parent::connexion();
            parent::$cnx->exec("delete from AbsenceStagiaire where CEF='$id' and AnneFr = '$anneeFr' and DateAbsenece = '$DateAbsence' 
        and Seance= $seance and etab = '$etab'");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }

    public function GetStagiairebyGroupe($Groupe, $anneeFr, $etab)
    {
        try {
            parent::connexion();
            $rows = parent::$cnx->query("select * from Stagiaire where Groupe = '$Groupe' and AnneF = '$anneeFr' and Etab = '$etab' order by Nom")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            return $rows;
        } catch (Exception $ex) {
        }
    }

    public function GetAllGroupebyEmploi($seance, $jour, $annefr, $etab)
    {
        try {
            parent::connexion();
            $rows = parent::$cnx->query("select distinct CodeGrp from EmploiReel where Seance = $seance and Jour = '$jour' and  CodeEtb = '$etab' and AnneeFr = '$annefr'")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            return $rows;
        } catch (Exception $ex) {
        }
    }

    public function GetInformationSeanceGroupe($grp, $jour, $seance, $annefr, $etab)
    {
        try {
            parent::connexion();
            $row = parent::$cnx->query("select E.Matricule,concat(F.Nom,' ',F.Prenom),E.CodeModule,m.DescpMd,E.CodeSl from
        Formateur F inner join  emploireel E using(Matricule) 
        inner join Groupe g using(CodeGrp)
        inner join modules m on g.CodeFlr = m.CodeFlr
        where E.CodeGrp = '$grp' and E.Seance = $seance and E.Jour = '$jour' and E.CodeModule = m.CodeMd
        and  E.CodeEtb = '$etab' and E.AnneeFr = '$annefr' and g.CodeFlr=m.CodeFlr ")->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
            return $row;
        } catch (Exception $ex) {
        }
    }

    public function VerifierAbsenceStagiaire($cef, $dateAbsenece, $anneeFr, $seance, $etab)
    {
        try {
            parent::connexion();
            $rows = parent::$cnx->query("select * from AbsenceStagiaire where CEF='$cef' and AnneFr = '$anneeFr' and DateAbsenece = '$dateAbsenece' 
                                 and Seance= $seance and etab = '$etab' ")->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
            return $rows;
        } catch (Exception $ex) {
        }
    }


    public function ChangeJustifyStagiaire($cef, $date, $seance, $anneeFr, $etab, $justify)
    {
        try {
            if ($justify == "Oui")
                $justify = "Non";
            else
                $justify = "Oui";

            parent::connexion();
            parent::$cnx->exec("update AbsenceStagiaire set Justify = '$justify'  where CEF='$cef' and AnneFr = '$anneeFr' and DateAbsenece = '$date' 
                                 and Seance= $seance and etab = '$etab' ");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }

    public function GetCodeModule($module)
    {
        try {
            parent::connexion();
            $row = parent::$cnx->query('select CodeMd from Modules where DescpMd="' . $module . '"')->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
            return $row;
        } catch (Exception $ex) {
        }
    }

    public function GetSatatistique($dtD,$dtF,$seance,$groupe,$stg,$anne,$etab,$type){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_AbsenceStatistique('$dtD', '$dtF', '$seance', '$groupe', '$stg', '$anne', '$etab', '$type')")->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function GetStagiairesbyGroupe($groupe,$anne,$etab){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_GetStagiairesbyGroupe('$groupe',  '$anne', '$etab')")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function GetConsulterAbsence($dtD,$dtF,$seance,$groupe,$stg,$anne,$etab,$type){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_GetConsulterAbsence('$dtD', '$dtF', '$seance', '$groupe', '$stg', '$anne', '$etab', '$type')")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }

    public function GetGroupeNonAbsence($dtD,$dtF,$type,$seance,$anne,$etab){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_GroupeNonAbsence('$dtD','$dtF','$type','$anne','$etab','$seance')")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function GetStagiaireNonAbsencebyGroupe($dtD,$dtF,$type,$seance,$anne,$etab,$grp){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_StagiaireNonAbsence('$dtD','$dtF','$grp','$type','$anne','$etab','$seance')")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }


    public function GetTopAbsenceStagiaire($dtD,$dtF,$type,$anne,$etab){
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call SP_TopAbsenceStagiaire('$dtD','$dtF','$type','$anne','$etab')")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
            
        } catch (Exception $ex) {
        }
        return $rows;
    }


}
