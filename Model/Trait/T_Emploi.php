<?php


trait TEmploi
{


    public function GetAllGroupes($codeetab, $anne)
    {
        parent::connexion();
        $req = "CALL Sp_GetAllGroupes_Emploi('$codeetab','$anne')";
        $groupes = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $groupes;
    }

    public function EmploiGroupes($codeetab, $anne, $cdgrp)
    {
        parent::connexion();
        $req = "CALL SP_Emploi_Groupe('$cdgrp','$codeetab','$anne')";
        $groupe = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $groupe;
    }

    public function EmploiFormateurdispo($mat, $jr, $sc, $codeetab, $an)
    {
        parent::connexion();
        $req = "CALL SP_Formateur_Dispo('$mat','$jr','$sc','$codeetab','$an')";
        $Format = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Format;
    }

    public function GetFormateur($codeetab, $anne, $grp)
    {
        parent::connexion();
        $req = "CALL Sp_Formateur_Emploi('$codeetab','$anne','$grp')";
        $Formateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Formateur;
    }

    public function MemeModule_group($cdmdl, $mat, $jr, $sc, $cdetb, $an)
    {
        parent::connexion();
        $req = "CALL SP_Meme_module_groupes('$cdmdl','$mat','$jr','$sc','$cdetb','$an')";
        $modules = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $modules;
    }

    public function GetSalleDispo($jour, $seance, $codeetab, $anne)
    {
        parent::connexion();
        $req = "CALL SP_Get_salle_dispo_Emploi('$jour','$seance','$anne','$codeetab')";
        $salles = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $salles;
    }

    public function Add_cour($CodeGrp, $Jour, $Seance, $CodeModule, $Matricule, $CodeSl, $TypeSc, $CodeEtb, $AnneeFr)
    {
        parent::connexion();
        $req = "CALL SP_Add_cours('$CodeGrp','$Jour' ,'$Seance','$CodeModule','$Matricule','$CodeSl' ,'$TypeSc','$CodeEtb' ,'$AnneeFr')";
        $groupes = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $groupes;
    }

    public function Delete_cour($CodeGrp, $Jour, $Seance, $CodeEtb, $an)
    {
        parent::connexion();
        $req = "CALL SP_Delete_cour('$CodeGrp','$Jour' ,'$Seance','$CodeEtb','$an')";
        $groupes = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $groupes;
    }

    public function ModifierCour($mat, $mdl, $sal, $CodeGrp, $Jour, $Seance, $CodeEtb, $an)
    {
        parent::connexion();
        $req = "CALL SP_ModifierCour('$mat','$mdl','$sal','$CodeGrp','$Jour' ,'$Seance','$CodeEtb','$an')";
        $conf = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $conf;
    }

    public function ModuledeGoupeformateur($mat, $grp, $CodeEtb, $an)
    {
        parent::connexion();
        $req = "CALL SP_ModuledeGoupaformateur('$mat','$grp' ,'$CodeEtb','$an')";
        $Modules = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $Modules;
    }


    public function Utiliser()
    {
        try {
            parent::connexion();
            $mois = date('m');
            $req = "CALL SP_Utiliser_Emploi('$mois')";
            $groupes = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $groupes;
        } catch (Exception) {
        }
    }
}
