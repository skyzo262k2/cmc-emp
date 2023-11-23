<?php

    class Connexion
    {
       public $server='localhost';
       public $dbname='cmc_ista';
       public $user='root';
       public $pass='1234';
       static $cnx=null;

       public function __construct($ser='localhost',$dbname='cmc_ista',$user='root',$pass='1234')
        {
            $this->server=$ser;
            $this->dbname=$dbname;
            $this->user=$user;
            $this->pass=$pass;

        }
        public function connexion()
        {
            try 
            {
                Connexion::$cnx =new PDO("mysql:host={$this->server};dbname={$this->dbname}",$this->user,$this->pass);
            } 
            catch (PDOException  $er) 
            {    }     

        }

        public function Deconnexion()
        {
            Connexion::$cnx =null;
        }

    }
?>