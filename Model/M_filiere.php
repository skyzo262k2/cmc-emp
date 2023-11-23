<?php
require "M_Connexion.php";
require "M_IMethodeCRUD.php";
class Filiere extends Connexion implements IMethodeCRUD
{

    public $codefl;
    public $DescrpFl;
    public $CdSt;
    public $Nv;

    public $etab;
    public  function __construct()
    {
    }

    public function GetAll()
    {
        $filieres = [];
        try {
            parent::connexion();
            $req = "CALL SP_GetAll_filiere()";
            $filieres = parent::$cnx->query($req)->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (PDOException  $er) {
        }
        return $filieres;
    }

    public function Find($val)
    {
        $filieres = [];
        try {
            parent::connexion();
            $req = "call sp_RechercherGlobal(\"$val\",\"FL\",'{$this->etab}')";
            $filieres = parent::$cnx->query($req)->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
        } catch (PDOException  $er) {
        }
        return $filieres;
    }

    public function Add()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_Add_filiere(?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codefl);
            $n->bindParam(2, $this->DescrpFl);
            $n->bindParam(3, $this->CdSt);
            $n->bindParam(4, $this->Nv);
            $n->execute();
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
            $req = "CALL SP_Update_filiere(?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codefl);
            $n->bindParam(2, $this->DescrpFl);
            $n->bindParam(3, $this->CdSt);
            $n->bindParam(4, $this->Nv);
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
            $req = "CALL SP_Delete_filiere(?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codefl);
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
            $n = parent::$cnx->exec("CALL SP_DeleteAllFilieres()");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function CodeSecteur()
    {
        parent::connexion();
        $req = "SELECT codeSect FROM filiere GROUP BY codeSect";
        $codeSects = parent::$cnx->query($req)->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $codeSects;
    }
}
