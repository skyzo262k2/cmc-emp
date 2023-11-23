<?php
require "M_Connexion.php";

class Secteur extends Connexion
{
    public $CodeSect;
    public $DescpSect;

    function __construct()
    {
    }

    public function GetAllSecteur()
    {
        parent::connexion();
        $rows = parent::$cnx->query("CALL sp_SelectAllSec()")->fetchAll(PDO::FETCH_ASSOC);
        parent::Deconnexion();
        return $rows;
    }
    public function FindSecteur($Code)
    {
        parent::connexion();
        $row = null;
        $row = parent::$cnx->query("CALL sp_FindSec('$Code')")->fetch();
        parent::Deconnexion();
        return $row;
    }
    public function AddSecteur()
    {
        $n = null;
        $existe = $this->FindSecteur($this->CodeSect);
        if ($existe == null) {
            try {
                parent::connexion();
                $query = "CALL sp_InsertSec('$this->CodeSect','$this->DescpSect')";
                $n = parent::$cnx->exec($query);
                parent::Deconnexion();
            } catch (PDOException  $er) {
                $n = null;
            }
        } else
            $n = null;
        return $n;
    }

    public function DeleteSecteur()
    {
        $n = null;
        try {
            parent::connexion();
            $n = parent::$cnx->exec("CALL sp_DeleteSec('{$this->CodeSect}')");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
    public function UpdateSecteur()
    {
        $n = null;
        $existe = $this->FindSecteur($this->CodeSect);
        if (isset($existe)) {
            try {
                parent::connexion();
                $query = "CALL sp_UpdateSec('{$this->CodeSect}','{$this->DescpSect}')";
                $n = parent::$cnx->exec($query);
                parent::Deconnexion();
            } catch (PDOException  $er) {
                $n = null;
            }
        } else
            $n = null;
        return $n;
    }
    public function DeleteAllSecteurs()
    {
        $n = null;
        try {
            parent::connexion();
            $n = parent::$cnx->query("CALL SP_DeleteAllSecteurs()");
            parent::Deconnexion();
        } catch (PDOException  $er) {
            $n = null;
        }
        return $n;
    }
}
