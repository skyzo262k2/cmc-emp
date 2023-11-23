<?php
require "../Model/M_Connexion.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}




$cnnx = new Connexion();
$cnnx->connexion();
$Etab = $_SESSION["Etablissement"]["CodeEtb"];
$anne = explode("/", $_SESSION["Annee"]);
$informations = [];

if (isset($_POST["type"]) && isset($_POST["taux"])) {
    $taux =  $_POST["taux"];
    $type = $_POST["type"];
    $informations_donnnees = $cnnx::$cnx->query("call SP_taux_Avencement_Module($taux,'$type','$anne[0]','$Etab')")->fetchAll(PDO::FETCH_NUM);
    $informations = [];
    foreach ($informations_donnnees as $donne) {
        if ($_SESSION["Admin"]["Poste"] == "ChefSecteur") {
            if ($_SESSION["Admin"]["secteur"] ==  $donne[7]) {
                $informations[] =  $donne;
            }
        } else {
            $informations[] =  $donne;
        }
    }
    if (count($informations) != 0) {
        echo " <table width='100%' class='table table-bordered table-borderless'>
                        <thead>
                            <tr class='table-info'>
                                <th colspan='2' class='text-center'>Formateur</th>
                                <th rowspan='2' class='text-center'>Groupe</th>
                                <th colspan='2' class='text-center'>Module</th>
                                <th rowspan='2' class='text-center'>Avancement</th>
                                <th rowspan='2' width='10%' class='text-center'>Message</th>
                            </tr>
                            <tr class='table-info'>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Code</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody >";
        foreach ($informations as $info) {
            $message = "";
            if ($info[6] == "module")
                $message = "Change Module";
            if ($info[6] == "groupe")
                $message = "Change Groupe";

            $avc = intval($info[5]);

            echo "<tr class='trinfo'>
                            <td>".htmlspecialchars($info[0])."</td>
                            <td>".htmlspecialchars($info[1])."</td>
                            <td>".htmlspecialchars($info[4])."</td>
                            <td>".htmlspecialchars($info[3])."</td>
                            <td>".htmlspecialchars($info[2])."</td>
                            <td class='text-center'>".htmlspecialchars($avc)." %</td>
                            <td class='text-center'>".htmlspecialchars($message)."</td>
                    </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "  <div class='text-center m-5'>
       <h3 class='text-danger'>Aucun données !</h3>
        <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />
    </div>";
    }
} else
    require "../View/V_TauxAvancemant_affectation.php";
