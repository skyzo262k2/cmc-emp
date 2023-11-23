<?php
require "../Model/M_Connexion.php";

class Module extends Connexion
{

    public $CodeMd;
    public $CodeFlr;
    public $Annee;
    public $DescMd;
    public $Pr;
    public $Dist;
    public $S1;
    public $S2;

    function __construct()
    {
    }

    public function GetAllModules()
    {
        parent::connexion();
        $rows = parent::$cnx->query("call GetAllModules()")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function GetModulesSecteur($secteur)
    {
        parent::connexion();
        $rows = parent::$cnx->query("call SPGetModuleSecteur('$secteur')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function AddModules()
    {
        $n = null;
        try {
            parent::connexion();
            $query = "CALL SP_InsertModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\",\"{$this->Annee}\",\"{$this->DescMd}\",{$this->Pr},{$this->Dist},{$this->S1},{$this->S2}) ";
            $n = parent::$cnx->exec($query);
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function UpdateModules()
    {
        $n = null;
        try {
            parent::connexion();
            $query = "call SP_UpdateModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\",\"{$this->Annee}\",\"{$this->DescMd}\",{$this->Pr},{$this->Dist},{$this->S1},{$this->S2}) ";
            $n = parent::$cnx->exec($query);
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function DeleteModules()
    {
        $n = null;
        try {
            parent::connexion();
            $query = "call SP_DeleteModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\")";
            $n = parent::$cnx->exec($query);
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function DeleteAllModules()
    {
        $n = null;
        try {
            parent::connexion();
            parent::$cnx->query("CALL SP_DeleteAllModules()");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
}
