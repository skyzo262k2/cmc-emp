<?php

    class Connexion
    {
       public $server='localhost';
       public $dbname='ista_db';
       public $user='root';
       public $pass='12345678';
       static $cnx=null;

       public function __construct($ser='localhost',$dbname='ista_db',$user='root',$pass='12345678')
        {
            $this->server=$ser;
            $this->dbname=$dbname;
            $this->user=$user;
            $this->pass=$pass;
        }
        public function connexion()
        {
            // try 
            // {
                Connexion::$cnx =new PDO("mysql:host={$this->server};dbname={$this->dbname}",$this->user,$this->pass);
            // } 
            // catch (PDOException  $er) 
            // {         

            // }
        }

        public function Deconnexion()
        {
            Connexion::$cnx =null;
        }

    }
?>