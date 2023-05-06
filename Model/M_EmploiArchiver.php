<?php
require "M_Connexion.php";
class Emploi_archiver extends Connexion
    {
        public function __construct()
        {
            
        }
    
        public function GetGroupes($codeetab,$anne,$m)
        {
            parent::connexion();
            $req="CALL Sp_GetAllGroupes_EmploiArchiver('$codeetab','$anne','$m')";
            $Groupes=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Groupes;
        }

        public function getEmploigroup($grp,$codeetab,$An,$m)
        {
            parent::connexion();
            $req="CALL SP_Emploi_GroupeArchiver('$grp','$codeetab','$An','$m')";
            $emploi=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $emploi;
        }
        public function Mois($CodeEtb,$an)
        {
            parent::connexion();
            $req="CALL Sp_mois('$CodeEtb',$an)";
            $Mois=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Mois;
        }
    
        // public function EmploiArchiver($CodeEtb,$an,$m)
        // {
        //     parent::connexion();
        //     $req="CALL SP_EmploiArchiver('$CodeEtb','$an','$m')";
        //     $groupes=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
        //     parent::Deconnexion();
        //     return $groupes;
        // }
    }


                
?>