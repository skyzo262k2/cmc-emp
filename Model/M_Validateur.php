<?php
require "M_Connexion.php";
class Validateur extends Connexion
{
    public $matricule;
    public $filiere;
    public $CodeEtab;
    public  function __construct()
    {
    }

    public function GetAllValidateur()
    {
        parent::connexion();
        $req = "CALL SP_GetAllValidateur(?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $this->CodeEtab);
        $exec->execute();
        $salles = $exec->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $salles;
    }

    public function FindValidateur($info)
    {
        parent::connexion();
        $req = "CALL SP_FindValidateur(?,?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $info);
        $exec->bindParam(2, $this->CodeEtab);
        $exec->execute();
        $salles = $exec->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $salles;
    }

    public function AddValidateur()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_AddValidateur(?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->matricule);
            $n->bindParam(2, $this->filiere);
            $n->bindParam(3, $this->CodeEtab);
            $n->execute();

            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }



    public function DeleteValidateur()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_DeleteValidateur(?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->matricule);
            $n->bindParam(2, $this->filiere);
            $n->bindParam(3, $this->CodeEtab);
            $n->execute();

            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }


    public function DeleteAllValidateurByEtab()
    {
        $n = null;
        try {
            parent::connexion();
           $n =  parent::$cnx->exec("CALL SP_DeleteAllValidateurByEtab('{$this->CodeEtab}')");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function validateur($mat)
    {
        parent::connexion();
        $data = parent::$cnx->query("SELECT * FROM validateur where Matricule='$mat'")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $data;
    }
}
