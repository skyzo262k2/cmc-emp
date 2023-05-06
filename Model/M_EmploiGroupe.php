<?php
require "M_Connexion.php";
require "../Model/Trait/T_Emploi.php";

class EmploiGroupe extends Connexion
{
    use TEmploi;
    public function __construct()
    {
        parent::__construct();
    } 

    public function GetGroupFormateur($mat,$codeEtab,$an){
            parent::connexion();
            $req = "CALL SP_GetGroupFormateur('$mat','$codeEtab','$an')";
            $groupesFormateur = parent::$cnx->query($req)->FetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $groupesFormateur;
    }
}
?>