<?php
require "M_Connexion.php";

class Groupe extends Connexion
{
    public $CodeGrp;
    public $CodeEtab;
    public $CodeFlr;
    public $Annee;
    public $Fpa;
    
    public $taux;

    function __construct(){}

    public function GetAllGroupe()
    {
        parent::connexion();
        $rows = parent::$cnx->query("CALL sp_SelectAllGrp('{$this->CodeEtab}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function FindGroupe($Codegrp,$Codeetab)
    {
        parent::connexion();
        $row = parent::$cnx->query("CALL sp_FindGrp('$Codegrp','$Codeetab')")->fetch();
        parent::Deconnexion();
        return $row;
    }

    public function AddGroupe()
    {

        $existe = $this->FindGroupe($this->CodeGrp,$this->CodeEtab);
        if ($existe == null) {
            
            parent::connexion();
            $query = "CALL sp_InsertGrp('{$this->CodeGrp}','{$this->CodeFlr}','{$this->CodeEtab}','{$this->Annee}','{$this->Fpa}',{$this->taux})";
            $n = parent::$cnx->exec($query);
            parent::Deconnexion();
            if ($n)
                return true;
            else 
                return false;
        }else{
            
        }     
    }
    
    public function DeleteGroupe()
    {
        parent::connexion();
        $success = parent::$cnx->exec("CALL sp_DeleteGrp('$this->CodeGrp','$this->CodeEtab')");
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }
    public function UpdateGroupe()
    {
        $existe = $this->FindGroupe($this->CodeGrp,$this->CodeEtab);
        if ($existe != null) {
            parent::connexion();
            $query = "CALL sp_UpdateGrp('{$this->CodeGrp}','{$this->CodeEtab}','{$this->CodeFlr}','{$this->Annee}','{$this->Fpa}',{$this->taux})";
            $success = parent::$cnx->exec($query);
            parent::Deconnexion();
            if ($success)
                return true;
            else
                return false;
        }

    }
    public function DeleteAllGroupes()
    {
        parent::connexion();
        $success = parent::$cnx->query("CALL SP_DeleteAllGroupes('{$this->CodeEtab}')");
        parent::Deconnexion();
        if($success){
            return true;
        }else{
            return false;
        }
    }
}
?>