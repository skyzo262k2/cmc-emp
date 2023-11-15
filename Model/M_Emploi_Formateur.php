<?php
require "M_Connexion.php";
class Emploi_fomateur extends Connexion
    {
        public function __construct()
        {
            
        }
    
        public function GetFormateur($anne,$codeetab)
        {
            parent::connexion();
            $req="CALL SP_Get_Info_Emploi('$anne','$codeetab')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }

        public function GetFormateurParSecteur($anne,$codeetab,$secteur)
        {
            parent::connexion();
            $req="CALL SP_Get_Info_EmploiSecteur('$anne','$codeetab','$secteur')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }

        public function getEmploiFormateur($anne,$codeetab,$mat)
        {
            parent::connexion();
            $req="CALL SP_Formateur_Emplois('$anne','$codeetab','$mat')";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }
    }


                
?>