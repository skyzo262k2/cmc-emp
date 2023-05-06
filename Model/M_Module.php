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

    public function AddModules()
    {
        try {
            parent::connexion();
            $query = "CALL SP_InsertModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\",\"{$this->Annee}\",\"{$this->DescMd}\",{$this->Pr},{$this->Dist},{$this->S1},{$this->S2}) ";
            $n = parent::$cnx->exec($query);
            parent::Deconnexion();
            if ($n)
                return true;
            else
                return false;
        } catch (PDOException $er) {
        }
    }

    public function UpdateModules()
    {
        try {
            parent::connexion();
            $query = "call SP_UpdateModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\",\"{$this->Annee}\",\"{$this->DescMd}\",{$this->Pr},{$this->Dist},{$this->S1},{$this->S2}) ";
            parent::$cnx->exec($query);
            parent::Deconnexion();
        } catch (PDOException $er) {
        }
    }

    public function DeleteModules()
    {
        parent::connexion();
        $query = "call SP_DeleteModules(\"{$this->CodeMd}\",\"{$this->CodeFlr}\")";
        parent::$cnx->exec($query);
        parent::Deconnexion();
    }
    public function DeleteAllModules()
    {
        parent::connexion();
        parent::$cnx->query("CALL SP_DeleteAllModules()");
        parent::Deconnexion();
    }
}
