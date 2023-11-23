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
        $n = null;
        try {
            parent::connexion();
            $query = "CALL sp_InsertNiveau(?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->CodeNiv, $this->DescpNiv));
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function Delete()
    {
        $n = null;
        try {
            parent::connexion();
            $n = parent::$cnx->prepare("CALL sp_DeleteNiv(?)");
            $n->execute(array($this->CodeNiv));
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function Update()
    {
        $n = null;
        try {
            parent::connexion();
            $query = "CALL sp_UpdateNiv(?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->CodeNiv, $this->DescpNiv));
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function DeleteAll()
    {
        $n = null;
        try {
            parent::connexion();
            $n = parent::$cnx->query("CALL SP_DeleteAllNiveaux()");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function Find($val)
    {
        parent::connexion();
        $rows = parent::$cnx->query("call sp_RechercherGlobal(\"$val\",'NV','{$this->etab}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }
}
