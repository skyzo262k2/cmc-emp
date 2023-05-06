<?php
require "M_Connexion.php";

class ProfileFormateur extends Connexion
{

    public function Modifier($mat,$motA,$motC){
        parent::connexion();
        $req="SELECT * FROM formateur WHERE Matricule=?";
        $exec=parent::$cnx->prepare($req);
        $exec->execute([$mat]);
        $resultat=$exec->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultat)==1 && password_verify($motA,$resultat[0]['Mdp'])){
            $req="UPDATE formateur SET Mdp=? WHERE Matricule=? ";
            $exec=parent::$cnx->prepare($req);
            $hash=password_hash($motC,PASSWORD_DEFAULT);
            $resultat=$exec->execute([$hash,$mat]);
            return true;
        };
        parent::Deconnexion();
    }
    
}
