<?php
require "../Model/M_Connexion.php";
require "../Model/M_IMethodeCRUD.php";

class Formateur extends Connexion implements IMethodeCRUD
{

    public $Matricule;
    public $Nom;
    public $Prenom;
    public $CodeEtab;
    public $Type;
    public $MassHoraire;
    public $Password;
    public $Secteur;
    // public $Validateur;
    function __construct()
    {
    }

    public function GetAll()
    {
        parent::connexion();
        $rows = parent::$cnx->query("call SP_GetAllFormateur('{$this->CodeEtab}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function GetFormateurSecteur($secteur)
    {
        parent::connexion();
        $rows = parent::$cnx->query("call SP_GetFormateurSecteur('{$this->CodeEtab}','{$secteur}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function Add()
    {
        $n = null;
        try {
            parent::connexion();
            $query = "CALL SP_InsertFormateur(?,?,?,?,?,?,?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->Matricule, $this->Nom, $this->Prenom, $this->CodeEtab, $this->Type, $this->MassHoraire, $this->Password, $this->Secteur));
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
            $query = "call SP_UpdateFormateur(?,?,?,?,?,?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->Matricule, $this->Nom, $this->Prenom, $this->CodeEtab, $this->Type, $this->MassHoraire, $this->Secteur));
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
            $query = "call SP_DeleteFormateur(?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->Matricule, $this->CodeEtab));
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
            $n =  parent::$cnx->prepare("CALL SP_DeleteAllFormateurs(?)");
            $n->execute(array($this->CodeEtab));
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function Find($val)
    {
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call sp_RechercherGlobal('$val','F','{$this->CodeEtab}')")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (Exception $ex) {
            // Exception
        }
        return $rows;
    }


    public function FindSecteur($val, $secteur)
    {
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("call sp_RechercherGlobalSecteur('$val','F','{$this->CodeEtab}','{$secteur}')")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (Exception $ex) {
            // Exception
        }
        return $rows;
    }
}
