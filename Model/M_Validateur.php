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
            $req="CALL SP_GetAllValidateur(?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$this->CodeEtab);
            $exec->execute();
            $salles=$exec->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $salles;
        }

        public function FindValidateur($info)
        {
            parent::connexion();
            $req="CALL SP_FindValidateur(?,?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$info);
            $exec->bindParam(2,$this->CodeEtab);
            $exec->execute();
            $salles=$exec->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $salles;
        }

        public function AddValidateur()
        {
            try{
                parent::connexion();
                $req="CALL SP_AddValidateur(?,?,?)";
                $exec=parent::$cnx->prepare($req);
                $exec->bindParam(1,$this->matricule);
                $exec->bindParam(2,$this->filiere);
                $exec->bindParam(3,$this->CodeEtab);
                $exec->execute();
                
                parent::Deconnexion();
            }catch(PDOException  $er)
            {
             
            }
        }

       

        public function DeleteValidateur()
        {
            parent::connexion();
            $req="CALL SP_DeleteValidateur(?,?,?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$this->matricule);
            $exec->bindParam(2,$this->filiere);
            $exec->bindParam(3,$this->CodeEtab);
            $exec->execute();
            
            parent::Deconnexion(); 
        }


        public function DeleteAllValidateurByEtab()
        {
            parent::connexion();
            parent::$cnx->query("CALL SP_DeleteAllValidateurByEtab('{$this->CodeEtab}')");
            parent::Deconnexion();
        }
        public function validateur($mat)
        {
            parent::connexion();
            $data=parent::$cnx->query("SELECT * FROM validateur where Matricule='$mat'")->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $data;
        }

    }


                
?>