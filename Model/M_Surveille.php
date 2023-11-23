<?php
require "M_Connexion.php";
require "M_IMethodeCRUD.php";

class Surveille extends Connexion implements IMethodeCRUD
{
    public $Matricule;
    public $Nom;
    public $Prenom;
    public $typeuser;
    public $secteur;
    public $login;
    public $Password;
    public $CodeEtab;

    public function GetAll()
    {
        parent::connexion();
        $rows = parent::$cnx->query("call SP_GetAllSurveille('{$this->CodeEtab}')")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }
    public function Add()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "call SP_AddSureille(?,?,?,?,?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->execute([$this->Matricule, $this->Nom, $this->Prenom, $this->typeuser, $this->CodeEtab, $this->login, $this->Password, $this->secteur]);
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
            $req = "call SP_UpdateSurveille(?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->Matricule);
            $n->bindParam(2, $this->Nom);
            $n->bindParam(3, $this->Prenom);
            $n->bindParam(4, $this->CodeEtab);
            $n->bindParam(4, $this->typeuser);
            $n->execute();
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
            $req = "call SP_DeleteSurveille(?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->Matricule);
            $n->bindParam(2, $this->CodeEtab);
            $n->execute();
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
            $req = "call SP_DeleteAllSurveille(?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->CodeEtab);
            $n->execute();
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function ModifierMotePasse()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "call SP_ReinitialiserMotepasse(?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->Matricule);
            $n->bindParam(2, $this->Password);
            $n->bindParam(3, $this->CodeEtab);
            $n->execute();
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
            $rows = parent::$cnx->query("call SP_FindSurveille('$val','{$this->CodeEtab}')")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (Exception $ex) {
            // Exception
        }
        return $rows;
    }
}
