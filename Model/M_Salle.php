<?php
require "M_Connexion.php";
class Salle extends Connexion
{
    public $codesalle;
    public $descrpsal;
    public $type;
    public $CodeEtab;
    public $Secteur;
    public  function __construct()
    {
    }

    public function GetAllSalles()
    {
        parent::connexion();
        $req = "CALL SP_GetAll_Salle(?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $this->CodeEtab);
        $exec->execute();
        $salles = $exec->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $salles;
    }
    public function GetSalleSecteur($secteur)
    {
        parent::connexion();
        $req = "CALL SP_GetSalleSecteur(?,?)";
        $exec = parent::$cnx->prepare($req);
        $exec->bindParam(1, $this->CodeEtab);
        $exec->bindParam(2, $secteur);
        $exec->execute();
        $salles = $exec->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $salles;
    }

    public function AddSalle()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_Add_Salle(?,?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codesalle);
            $n->bindParam(2, $this->descrpsal);
            $n->bindParam(3, $this->type);
            $n->bindParam(4, $this->CodeEtab);
            $n->bindParam(5, $this->Secteur);
            $n->execute();
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function Updatesalle()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_Update_Salle(?,?,?,?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codesalle);
            $n->bindParam(2, $this->descrpsal);
            $n->bindParam(3, $this->type);
            $n->bindParam(4, $this->CodeEtab);
            $n->bindParam(5, $this->Secteur);
            $n->execute();
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }

    public function Deletesalle()
    {
        $n = null;
        try {
            parent::connexion();
            $req = "CALL SP_Delete_Salle(?,?)";
            $n = parent::$cnx->prepare($req);
            $n->bindParam(1, $this->codesalle);
            $n->bindParam(2, $this->CodeEtab);
            $n->execute();

            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }


    public function DeleteAllSalle()
    {
        $n = null;
        try {
            parent::connexion();
            $n = parent::$cnx->exec("CALL SP_DeleteAllSalles('{$this->CodeEtab}')");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
}
