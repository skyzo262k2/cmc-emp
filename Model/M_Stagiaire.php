<?php
require "M_Connexion.php";
require "M_IMethodeCRUD.php";

class Stagiaire extends Connexion implements IMethodeCRUD
{

    public $cef;
    public $nom;
    public $prenom;
    public $groupe;
    public $annef;
    public $etab;
    public $discipline;
    function __construct()
    {
    }

    public function GetAll()
    {
        parent::connexion();
        $rows = parent::$cnx->query("CALL PS_GetAllStagiaire('$this->annef','$this->etab')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function GetAllSecteur($secteur)
    {
        parent::connexion();
        $rows = parent::$cnx->query("CALL PS_GetStagiaireSecteur('$this->annef','$this->etab','$secteur')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }

    public function Add()
    {
        try {
            parent::connexion();
            $query = "CALL PS_AddStagiaire(?,?,?,?,?,?,?)";
            $n = parent::$cnx->prepare($query);
            $n->execute(array($this->cef, $this->nom, $this->prenom, $this->groupe, $this->annef, $this->etab, $this->discipline));
            parent::Deconnexion();
        } catch (Exception $ex) {
        }
    }

    public function Delete()
    {
        parent::connexion();
        $success = parent::$cnx->prepare("CALL PS_DeleteStagiaire(?,?,?)");
        $success->execute(array($this->cef, $this->annef, $this->etab));
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }
    public function Update()
    {
        parent::connexion();
        $query = "CALL PS_UpdateStagiaire(?,?,?,?,?,?,?)";
        $success = parent::$cnx->prepare($query);
        $success->execute(array($this->cef, $this->nom, $this->prenom, $this->groupe, $this->annef, $this->etab, $this->discipline));
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }
    public function DeleteAll()
    {
        parent::connexion();
        $success = parent::$cnx->query("CALL PS_DeleteAllStagiaire('$this->annef','$this->etab')");
        parent::Deconnexion();
        if ($success)
            return true;
        else
            return false;
    }

    public function Find($val)
    {
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("SELECT CEF,Nom,Prenom,Groupe,Discipline FROM Stagiaire 
        WHERE (CEF REGEXP '$val' 
        OR Nom REGEXP '$val'
        OR Prenom REGEXP '$val'
        OR Groupe REGEXP '$val'
        OR discipline REGEXP '$val')
        and AnneF='$this->annef' and etab = '$this->etab'")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (Exception $ex) {
            // Exception
        }
        return $rows;
    }

    public function FindStagiaire($val, $secteur)
    {
        $rows = [];
        try {
            parent::connexion();
            $rows = parent::$cnx->query("SELECT s.CEF,s.Nom,s.Prenom,s.Groupe,s.Discipline 
                FROM Stagiaire s INNER JOIN Groupe g ON g.CodeGrp=s.Groupe
                INNER JOIN filiere f using(CodeFlr)
                WHERE (s.CEF REGEXP '$val' 
                OR s.Nom REGEXP '$val'
                OR s.Prenom REGEXP '$val'
                OR s.Groupe REGEXP '$val'
                OR s.discipline REGEXP '$val')
                AND f.CodeSect='$secteur' AND s.AnneF='$this->annef' AND s.etab = '$this->etab'")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (Exception $ex) {
            // Exception
        }
        return $rows;
    }
}
