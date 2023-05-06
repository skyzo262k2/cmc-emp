<?php
require "M_Connexion.php";
require "../Model/Trait/T_Emploi.php";

class Emploi_group extends Connexion
{
        use TEmploi;
        public function __construct()
        {
            parent::__construct();
        }
}
                
?>