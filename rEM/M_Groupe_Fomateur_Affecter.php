<?php
require "M_Connexion.php";
class Groupe_fomateur_affecter extends Connexion
    {
        public function __construct()
        {

        }
        public function GetFormateur_Affecter_groupe($grp,$flr,$codeetab,$anne)
        {
            parent::connexion();
            $req="CALL Sp_formateur_group('$grp','$flr','$anne','$codeetab')";
            $grops=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $grops;
        }
        public function GetModule_NoAffecter($grp,$flr,$codeetab,$anne,$anf)
        {
            parent::connexion();
            $req="CALL SP_moduleNoaffeceted('$grp','$anne','$codeetab','$flr','$anf')";
            $grops=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $grops;
        }
        public function GetGroupes($codeetab)
        {
            parent::connexion();
            $req="SELECT g.CodeGrp,g.CodeFlr,g.annee,g.Fpa FROM groupe g WHERE g.codeEtab='$codeetab' ;";
            $Formateur=parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Formateur;
        }

    }


                
?>