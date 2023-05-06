<?php
require "M_Connexion.php";
class Valider extends Connexion
    {
        public $matricule;
        public $filiere;
        public $CodeEtab;
        public $annefr;
        public  function __construct()
        {     

        }

        public function GetEfmAValider()
        {
            parent::connexion();
            $req="CALL SP_EFM_VALIDER(?,?,?)";
            $exec=parent::$cnx->prepare($req);
            $exec->execute([$this->matricule,$this->CodeEtab,$this->annefr]);
            $Efms=$exec->fetchAll(PDO::FETCH_ASSOC);
            parent::Deconnexion();
            return $Efms;
        }



        public function Valider($values)
        {
            try{
                parent::connexion();
                $req="CALL Sp_ExamValider(?,?,?,?,?,?,?,?,?,?,?)";
                $exec=parent::$cnx->prepare($req);
                $b=$exec->execute($values);
                parent::Deconnexion();
                return $b;
            }catch(PDOException  $er)
            {
             
            }
        }

        public function RecupererEfm($idefm)
        {
            try{
                parent::connexion();
                $req="CALL Sp_recupererEfm(?)";
                $exec=parent::$cnx->prepare($req);
                $exec->execute([$idefm]);
                return $exec->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException  $er)
            {
             
            }
        }

        public function Remarque($values)
        {
            try{
                parent::connexion();
                $req="CALL SP_Remarque(?,?,?,?,?,?)";
                $exec=parent::$cnx->prepare($req);
                $exec->execute($values);
                parent::Deconnexion();
            }catch(PDOException  $er)
            {
             
            }
        }


    }       
?>