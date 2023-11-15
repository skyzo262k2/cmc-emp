<?php

require "../Model/M_Connexion.php";


class AbsenceFormateur extends Connexion 
{


    function __construct()
    {
    }


    public function AddAbsence($id, $anneeFr, $DateAbsence, $grp, $seance, $CodeModule, $Justify, $Etab)
    {
        try {
            parent::connexion();
            parent::$cnx->query("call SP_AddAbsenceFormateur('$id', '$anneeFr', '$DateAbsence', '$grp', $seance, '$CodeModule', '$Justify', '$Etab')");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }
    public function DeleteAbsence($id, $anneeFr, $DateAbsence, $seance, $etab)
    {
        try {
            parent::connexion();
            parent::$cnx->exec("delete from AbsenceFormateur where Matricule='$id' and AnneFr = '$anneeFr' and DateAbsenece = '$DateAbsence' 
        and Seance= $seance and etab = '$etab'");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }

    public function ChangeJustifyFormateur($mat, $date, $seance, $anneeFr, $etab, $justify)
    {
        try {
            if ($justify == "Oui")
                $justify = "Non";
            else
                $justify = "Oui";

            parent::connexion();
            parent::$cnx->exec("update AbsenceFormateur set Justify = '$justify'  where matricule='$mat' and AnneFr = '$anneeFr' and DateAbsenece = '$date' 
                                 and Seance= $seance and etab = '$etab' ");
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }
    public function VerifierAbsenceFormateur($mat, $date, $seance, $anneeFr, $etab)
    {
        $row = [];
        try {
            parent::connexion();
            $row = parent::$cnx->query("select * from absenceformateur where Matricule='$mat' and AnneFr = '$anneeFr' and DateAbsenece = '$date' 
                                 and Seance= $seance and etab = '$etab' ")->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
          
        } catch (Exception $ex) {
        } 
         return $row;
    }

    public function GetFormateurByEmploi_jour_seance($jour, $seance, $anneeFr, $etab)
    {
        $row = [];
        try {
            parent::connexion();
            $row = parent::$cnx->query("select F.Matricule,concat(F.Nom,' ',F.Prenom),m.DescpMd,g.CodeGrp ,E.CodeSl,fi.CodeSect
            from formateur F inner join emploireel E using(Matricule)
            inner join Groupe g using(CodeGrp)
            inner join modules m on g.CodeFlr = m.CodeFlr
            inner join filiere fi on m.CodeFlr = fi.CodeFlr
            where E.Seance = $seance and E.Jour = '$jour' and E.CodeModule = m.CodeMd
            and  E.CodeEtb = '$etab' and E.AnneeFr = '$anneeFr' and g.CodeFlr=m.CodeFlr order by F.Nom asc")->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }

    public function GetCodeModule($module,$grp)
    {
        $row = [];
        try {
            parent::connexion();
            $row = parent::$cnx->query('select m.CodeMd from Modules m
                                        inner join groupe g on g.CodeFlr = m.CodeFlr
                                        where m.Annee = g.Annee
                                        and  m.DescpMd= "'.$module.'"
                                        and g.CodeGrp = "'.$grp.'";')->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }

    public function TotalAbsenceFormateurByAnne($date1, $date2, $seance, $anne, $etab,$secteur )
    {
        $row = [0];
        $query = "select count(*) from AbsenceFormateur 
        where DateAbsenece >= '$date1' and DateAbsenece <= '$date2' 
        and AnneFr = '$anne' and etab = '$etab'";
        if ($secteur != ""){
            $query .= " and matricule in (select distinct a.matricule from affectmodule a 
            inner join groupe g on g.Codegrp = a.Groupe 
            inner join filiere f using(CodeFlr)
            where f.CodeSect = '".$secteur."') ";
        }
        try {
            parent::connexion();
            if ($date1 != "" && $date2 != "" && $seance == "choisir")
                $row = parent::$cnx->query($query)->fetch(PDO::FETCH_NUM);

            if ($date1 != "" && $date2 != "" && $seance != "choisir")
                $row = parent::$cnx->query($query." and seance = ".$seance)->fetch(PDO::FETCH_NUM);

            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }

    public function GetFormateurAbsenceBydateSeance($date1, $date2, $seance, $anne, $etab,$secteur)
    {
        $row = [];
        $query = "select F.matricule,concat(F.Nom,' ',F.Prenom),count(*) as Nb 
                from formateur F inner join AbsenceFormateur using(Matricule) 
                where DateAbsenece >= '$date1' and DateAbsenece <= '$date2' 
                and AnneFr = '$anne' and etab = '$etab' ";
        if ($secteur != ""){
            $query .= " and F.matricule in (select distinct a.matricule from affectmodule a 
            inner join groupe g on g.Codegrp = a.Groupe 
            inner join filiere f using(CodeFlr)
            where f.CodeSect = '".$secteur."') ";
        }
        try {
            parent::connexion();

            if ($date1 != "" && $date2 != "" && $seance == "choisir")
                $row = parent::$cnx->query($query." group by F.Matricule order by Nb desc")->fetchAll(PDO::FETCH_NUM);

            if ($date1 != "" && $date2 != "" && $seance != "choisir")
                $row = parent::$cnx->query($query." and seance = ".$seance." group by F.Matricule order by Nb desc")->fetchAll(PDO::FETCH_NUM);


            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }



    public function GetAbsenceByOneFormateur($matricule, $date1, $date2, $seance, $ann, $etab)
    {
        $row = [];
        $query = "select A.Matricule,A.Groupe ,m.DescpMd,A.seance,A.DateAbsenece,A.justify 
                from AbsenceFormateur A inner join Groupe g on A.groupe=g.CodeGrp inner join modules m on g.CodeFlr = m.CodeFlr inner join affectmodule af on af.ModuleCode =  m.CodeMd 
                where A.matricule = '$matricule' and A.CodeModule = m.CodeMd and af.groupe = g.Codegrp and A.DateAbsenece >= '$date1' and A.DateAbsenece <= '$date2' 
                and  A.etab = '$etab' and A.AnneFr = '$ann' and g.CodeFlr=m.CodeFlr";
        try {
            parent::connexion();
            if ($date1 != "" && $date2 != "" && $seance == "choisir")
                $row = parent::$cnx->query($query)->fetchAll(PDO::FETCH_NUM);
            if ($date1 != "" && $date2 != "" && $seance != "choisir")
                $row = parent::$cnx->query($query." and A.Seance = ".$seance)->fetchAll(PDO::FETCH_NUM);
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }

    public function GetFormateur($mat, $etab)
    {
        $row = [];
        try {
            parent::connexion();
            $row = parent::$cnx->query("select * from Formateur where Matricule = '$mat' and CodeEtab = '$etab' ")->fetch(PDO::FETCH_NUM);
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }
}
