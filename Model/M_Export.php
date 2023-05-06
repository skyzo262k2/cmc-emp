<?php
require "M_Connexion.php";
class Export extends Connexion
{
    public $Donnees;
    public $table_name;
    public $CodeEtab;
    public $num_col;
    function __construct($donnes_recu,$table_name){
        $this->Donnees = $donnes_recu;
        $this->table_name = $table_name;
        $this->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
        $this->num_col = [
            "fl" => 4,
            "gp" => 4,
            "fr" => 5,
            "md" => 8,
            "nv" => 2,
            "sl" => 3,
            "sc" => 2
        ];
    }

    public function AddAll(){
        parent::connexion();
        switch ($this->table_name){
            case "fl":
                $procedure = "CALL SP_Add_filiere(?,?,?,?)";
                break;
            case "gp":
                $procedure = "CALL sp_InsertGrp(?,?,'{$this->CodeEtab}',?,?)";
                break;
            case "fr":
                $procedure = "CALL InsertFormateur(?,?,?,'{$this->CodeEtab}',?,?)";
                break;
            case "md":
                $procedure = "CALL InsertModules(?,?,?,?,?,?,?,?)";
                break;
            case "nv";
                $procedure = "CALL sp_InsertNiveau(?,?)";
                break;
            case "sl";
                $procedure = "CALL SP_Add_Salle(?,?,?,'{$this->CodeEtab}')";
                break;
            case "sc";
                $procedure = "CALL sp_InsertSec(?,?)";
                break;
        }
        $success = 0;
        $problem = 0;
        $exec = parent::$cnx->prepare($procedure);
        $success_table = [];
        foreach($this->Donnees as $row){
            for($i = 0;$i < $this->num_col[$this->table_name];$i++){
                $exec->bindParam(($i+1),$row[$i]);
            }
            if($exec->execute()){
                array_push($success_table,$row);
                $success++;
            }else{
                $problem++;
            }
        }
        parent::Deconnexion();
        return [$success,$problem,"result" => $success_table];
    }

}