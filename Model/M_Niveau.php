<?php
require "M_Connexion.php";
require "M_IMethodeCRUD.php";

class Niveau extends Connexion implements IMethodeCRUD
{
    public $CodeNiv;
    public $DescpNiv;
    
    public $etab;

    function __construct()
    {
    }

    public function GetAll()
    {
        parent::connexion();
        $rows = parent::$cnx->query("CALL sp_SelectAllNiveau()")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function Add()
    {
        try {
            parent::connexion();
            $query = "CALL sp_InsertNiveau(?,?)";
           $n = parent::$cnx->prepare($query);
           $n->execute(array($this->CodeNiv,$this->DescpNiv));
            
        } catch (PDOException  $er) {
            
        }
        parent::Deconnexion();
    }

    public function Delete()
    {
        parent::connexion();
        $success = parent::$cnx->prepare("CALL sp_DeleteNiv(?)");
        $success->execute(array($this->CodeNiv));
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }
    public function Update()
    {
        parent::connexion();
        $query = "CALL sp_UpdateNiv(?,?)";
        $success = parent::$cnx->prepare($query);
        $success->execute(array($this->CodeNiv,$this->DescpNiv));
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }
    public function DeleteAll()
    {
        parent::connexion();
        $success = parent::$cnx->query("CALL SP_DeleteAllNiveaux()");
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }

    public function Find($val)
    {
        parent::connexion();
        $rows = parent::$cnx->query("call sp_RechercherGlobal(\"$val\",'NV','{$this->etab}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }


}
