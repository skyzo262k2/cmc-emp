<?php
require "M_Connexion.php";
class Affecter extends Connexion
{
    public function __construct()
    {
    }
    public function Formateurs_Groupes($codetab)
    {
        $table = [];
        parent::connexion();
        $req = "SELECT * FROM groupe g WHERE g.codeEtab='$codetab';";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        $table[] =  $Formateur;
        $req = "SELECT * FROM Formateur f WHERE f.codeEtab='$codetab';";
        $Groupe = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        $table[] = $Groupe;
        return $table;
    }
    public function Formateurs_GroupesParSecteur($codetab, $secteur, $anne)
    {
        $table = [];
        parent::connexion();
        $req = "SELECT * FROM groupe g 
                        inner join filiere f using(CodeFlr)  
                    WHERE g.codeEtab='$codetab' AND f.CodeSect='$secteur';";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        $table[] =  $Formateur;

        $req = "SELECT * from formateur 
                        where (secteur='$secteur' or secteur='Sans' or secteur is null) AND CodeEtab='$codetab'
                        group by matricule;";
        $Groupe = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        $table[] = $Groupe;
        return $table;
    }

    public function GetFormateurModule($mat_F, $codetab, $anne)
    {
        parent::connexion();
        $req = "CALL SP_ModuleAffecter_Formateur('$mat_F','$codetab','$anne');";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Formateur;
    }
    // CALL SP_moduleNoaffeceted('$cdgrp','$anne[0]','$codetab','$cdflr','$anne_f')
    public function GetGroupe($cdgrp, $anne, $codetab, $cdflr, $anne_f)
    {
        parent::connexion();
        $req = "CALL SP_moduleNoaffeceted('$cdgrp','$anne','$codetab','$cdflr','$anne_f')";
        $Groupes = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Groupes;
    }
    //CALL SP_DeleteModule_Formateur($mat,'$grpe','$cdmd',$ann)
    public function SupprimerAffectation($mat, $grpe, $cdmd, $anne, $codetab)
    {
        parent::connexion();
        $req = "CALL SP_DeleteModule_Formateur($mat,'$grpe','$cdmd','$anne','$codetab')";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Formateur;
    }

    public function AffecterModule($frm, $grp, $codemodule, $anne, $codetab)
    {
        parent::connexion();
        $req = "CALL SP_AffecterModule('$frm','$grp','$codemodule','$anne','$codetab')";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Formateur;
    }

    public function VerifierInEmploi($mat, $grp, $cdmd, $an, $cdtb)
    {
        parent::connexion();
        $req = "CALL Sp_Module_in_emploi('$mat','$grp','$cdmd','$an','$cdtb')";
        $verfication = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $verfication[0];
    }
    public function TransfereNewFormateur($newmat, $mat, $grp, $cdmd, $an, $cdtb)
    {
        parent::connexion();
        $req = "CALL Sp_Module_trans_new_formateur('$newmat','$mat','$grp','$cdmd','$an','$cdtb')";
        $verfication = parent::$cnx->exec($req);
        parent::Deconnexion();
        return $verfication;
    }

    public function Efm($emfP, $mat, $grp, $cdmd, $an, $cdtb)
    {
        parent::connexion();
        $req = "CALL Sp_EFM_fait('$emfP','$mat','$grp','$cdmd','$an','$cdtb')";
        $verfication = parent::$cnx->exec($req);
        parent::Deconnexion();
        return $verfication;
    }
    public function excelFor($anne, $cdetb)
    {
        parent::connexion();
        $req = "SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NP FROM affectmodule a INNER JOIN Formateur f On f.Matricule=a.matricule  WHERE a.CodeEtab='$cdetb' AND  anneefr='$anne' GROUP BY f.Matricule";
        $Forma = parent::$cnx->query($req)->fetchAll(PDO::FETCH_NUM);
        parent::Deconnexion();
        return $Forma;
    }

    public function MatWord($mat_F, $codetab, $anne)
    {
        parent::connexion();
        $req = "select sum(m.s1),sum(m.s2) from groupe g 
            inner join  affectmodule af on g.CodeGrp= af.Groupe inner join Modules m on af.ModuleCode = m.CodeMd 
            where g.CodeFlr = m.CodeFlr and af.Matricule ='$mat_F' and af.CodeEtab='$codetab' and af.AnneeFr='$anne'";
        $data = parent::$cnx->query($req)->fetchAll(PDO::FETCH_NUM);
        parent::Deconnexion();
        return $data[0];
    }

    public function TauxAvancementAllFormateur($codetab, $anne)
    {
        parent::connexion();
        $req = "Call SP_TauxAllFromrateur('{$codetab}','{$anne}')";
        $TauxAllFormateur = parent::$cnx->query($req)->fetchAll(PDO::FETCH_NUM);
        parent::Deconnexion();
        return $TauxAllFormateur;
    }
}
