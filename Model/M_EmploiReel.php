<?php
require "M_Connexion.php";
class Emploi_Reel extends Connexion
    {
        public function __construct()
        {
            
        }
    
        public function GetGroupes($codeetab,$anne)
        {
            parent::connexion();
            $req="CALL Sp_GetAllGroupes_EmploiReel('$codeetab','$anne')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }

        public function GetGroupesParSecteur($codeetab,$anne,$secteur)
        {
            parent::connexion();
            $req="CALL Sp_GetAllGroupes_EmploiReelParSecteur('$codeetab','$anne','$secteur')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }
        public function Archiver($an,$cd)
        {
            parent::connexion();
            $req="CALL SP_Archive('$an','$cd')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }

        public function getEmploigroup($grp,$codeetab,$An)
        {
            parent::connexion();
            $req="CALL SP_Emploi_GroupeReel('$grp','$codeetab','$An')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }
        
      
      

    }                
?>