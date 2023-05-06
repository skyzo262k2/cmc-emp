<?php


require "../Model/M_Connexion.php";


class EFM extends Connexion
{


    public $id;
    public $matricule;
    public $groupe;
    public $module;
    public $url;
    public $Remarque;
    public $AnneeFr;
    public $Etab;
    public $CodeFlr;
    public $DateEntree;
    public $DateValide;
    public $typeEFM;
    public $Validateur;

    function __construct()
    {
    }


    public function Add()
    {
        $n = null;
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_AddEFM(?,?,?,?,?,?,?,?)");
            $n->execute(array($this->matricule, $this->groupe, $this->module, $this->url,$this->typeEFM, $this->AnneeFr, $this->Etab,$this->CodeFlr));
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $n;
    }
    public function Delete()
    {
        $n = null;
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_DeleteEFM(?)");
            $n->execute(array($this->id));
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $n;
    }

    public function GroupeAffecterByFormateurAnneeEtab()
    {
        $rows = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_GroupeAffecterByFormateurAnneeEtab(?,?,?)");
            $n->execute(array($this->matricule, $this->AnneeFr, $this->Etab));
            $rows = $n->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }

    public function ModuleAffecterByGroupeFormateurAnneeEtab()
    {
        $rows = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_ModuleAffecterByGroupeFormateurAnneeEtab(?,?,?,?)");
            $n->execute(array($this->matricule, $this->AnneeFr, $this->Etab, $this->groupe));
            $rows = $n->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }

    public function GetEFMByFormateurAnneeEtab()
    {
        $rows = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_GetEFMByFormateurAnneeEtab(?,?,?)");
            $n->execute(array($this->matricule, $this->AnneeFr, $this->Etab));
            $rows = $n->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function Showtable($examans)
    {
        foreach ($examans as $e) {
            $date = $e[7] == "" ? "-" : $e[7];
            $remarque = $e[5] == "" ? "-" : $e[5];
            $pdf = $e[7] == "" ? "-" : "<a href='../Controller/C_PDF_Proposition_EFM.php?efm=$e[0]'><img src='../Images/pdf.png' width='35px'/></a>"; 
            echo "<tr>
                        <td>$e[2]</td>
                        <td>$e[13]</td>
                        <td>$e[8]</td>
                        <td>$e[6]</td>
                        <td> <a href='../$e[4]'><img src='../Images/pdf.png' width='35px'></img></a></td>
                        <td>$date</td>
                        <td id='remarque'>$remarque</td>
                        <td id='pdf'>$pdf</td>
                        <td><button class='btn' onclick='Supprimer(\"$e[0]\")'><img src='../Images/Icon_Delete.png' width='30px'></button></td>
                </tr>";
        }
    }
    public function GetURLforDelete()
    {
        $row = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_GetURLforDelete(?)");
            $n->execute(array($this->id));
            $row = $n->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }
    public function GetFiliereByGrpAndModule()
    {
        $row = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("select GetFiliereByGrpAndModule(?,?,?)");
            $n->execute(array($this->groupe, $this->module, $this->Etab));
            $row = $n->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }

    public function DetailEFM()
    {
        $row = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_DetailEFM(?)");
            $n->execute(array($this->id));
            $row = $n->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }
    public function NomPrenomFormateur($mat)
    {
        $row = [];
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_NomPrenomFormateur(?)");
            $n->execute(array($mat));
            $row = $n->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }
     public function AvancementAffectation()
    {
        // $row = [];
        // try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_AvancementAffectation(?,?,?,?,?)");
            $n->execute(array($this->matricule,$this->module,$this->groupe,$this->Etab,$this->AnneeFr));
            $row = $n->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        // } catch (Exception $ex) {
        // }
        return $row;
    }
}
