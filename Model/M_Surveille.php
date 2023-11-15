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
        parent::connexion();
        $req="call SP_AddSureille(?,?,?,?,?,?,?,?)";
        $requete=parent::$cnx->prepare($req);
        $requete->execute([$this->Matricule, $this->Nom, $this->Prenom,$this->typeuser, $this->CodeEtab, $this->login, $this->Password, $this->secteur]);
        parent::Deconnexion();
    }

    public function Update()
    {
        parent::connexion();
        $req="call SP_UpdateSurveille(?,?,?,?)";
        $requete=parent::$cnx->prepare($req);
        $requete->bindParam(1,$this->Matricule);
        $requete->bindParam(2,$this->Nom);
        $requete->bindParam(3,$this->Prenom);
        $requete->bindParam(4,$this->CodeEtab);
        $requete->bindParam(4,$this->typeuser);
        $requete->execute();
        parent::Deconnexion();
    }

    public function Delete()
    {
        parent::connexion();
        $req="call SP_DeleteSurveille(?,?)";
        $requete=parent::$cnx->prepare($req);
        $requete->bindParam(1,$this->Matricule);
        $requete->bindParam(2,$this->CodeEtab);
        $requete->execute();
        parent::Deconnexion();
    }
    public function DeleteAll()
    {
        parent::connexion();
        $req="call SP_DeleteAllSurveille(?)";
        $requete=parent::$cnx->prepare($req);
        $requete->bindParam(1,$this->CodeEtab);
        $requete->execute();
        parent::Deconnexion();
    }
    public function ModifierMotePasse()
    {
        parent::connexion();
        $req="call SP_ReinitialiserMotepasse(?,?,?)";
        $requete=parent::$cnx->prepare($req);
        $requete->bindParam(1,$this->Matricule);
        $requete->bindParam(2,$this->Password);
        $requete->bindParam(3,$this->CodeEtab);
        $requete->execute();
        parent::Deconnexion();
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
