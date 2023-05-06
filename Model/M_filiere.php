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
        try {
            parent::connexion();
            $req = "CALL SP_Add_filiere(?,?,?,?)";
            $exec = parent::$cnx->prepare($req);
            $exec->bindParam(1, $this->codefl);
            $exec->bindParam(2, $this->DescrpFl);
            $exec->bindParam(3, $this->CdSt);
            $exec->bindParam(4, $this->Nv);
            $exec->execute();
            parent::Deconnexion();
        } catch (PDOException  $er) {
        }
    }

    public function Update()
    {
        parent::connexion();
        $req = "CALL SP_Update_filiere(?,?,?,?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $this->codefl);
        $exec->bindParam(2, $this->DescrpFl);
        $exec->bindParam(3, $this->CdSt);
        $exec->bindParam(4, $this->Nv);
        $exec->execute();
        parent::Deconnexion();
    }
    public function Delete()
    {
        parent::connexion();
        $req = "CALL SP_Delete_filiere(?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $this->codefl);
        $exec->execute();
        parent::Deconnexion();
    }
    public function DeleteAll()
    {
        parent::connexion();
        parent::$cnx->query("CALL SP_DeleteAllFilieres()");
        parent::Deconnexion();
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
