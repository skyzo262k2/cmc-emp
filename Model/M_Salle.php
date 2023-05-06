<?php
require "M_Connexion.php";
class Salle extends Connexion
    {
        public $codesalle;
        public $descrpsal;
        public $type;
        public $CodeEtab;
        public  function __construct()
        {     

        }

        public function GetAllSalles()
        {
            parent::connexion();
            $req="CALL SP_GetAll_Salle(?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$this->CodeEtab);
            $exec->execute();
            $salles=$exec->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $salles;
        }

        public function AddSalle()
        {
            try{
                parent::connexion();
                $req="CALL SP_Add_Salle(?,?,?,?)";
                $exec=parent::$cnx->prepare($req);
                $exec->bindParam(1,$this->codesalle);
                $exec->bindParam(2,$this->descrpsal);
                $exec->bindParam(3,$this->type);
                $exec->bindParam(4,$this->CodeEtab);
                $exec->execute();
                
                parent::Deconnexion();
            }catch(PDOException  $er)
            {
             
            }
        }

        public function Updatesalle()
        {
            parent::connexion();
            $req="CALL SP_Update_Salle(?,?,?,?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$this->codesalle);
            $exec->bindParam(2,$this->descrpsal);
            $exec->bindParam(3,$this->type);
            $exec->bindParam(4,$this->CodeEtab);
            $exec->execute();
            
            parent::Deconnexion();
        }

        public function Deletesalle()
        {
            parent::connexion();
            $req="CALL SP_Delete_Salle(?,?)";
            $exec=parent::$cnx->prepare($req);
            $exec->bindParam(1,$this->codesalle);
            $exec->bindParam(2,$this->CodeEtab);
            $exec->execute();
            
            parent::Deconnexion(); 
        }


        public function DeleteAllSalle()
        {
            parent::connexion();
            parent::$cnx->query("CALL SP_DeleteAllSalles('{$this->CodeEtab}')");
            
            parent::Deconnexion();
        }

    }


                
?>