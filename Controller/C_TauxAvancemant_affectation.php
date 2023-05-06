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
    $informations = $cnnx::$cnx->query("call SP_taux_Avencement_Module($taux,'$type','$anne[0]','$Etab')")->fetchAll(PDO::FETCH_NUM);

    if (count($informations) != 0) {
        echo " <table width='100%' class='table table-bordered table-borderless'>
                        <thead>
                            <tr class='table-info'>
                                <th colspan='2'>Formateur</th>
                                <th rowspan='2'>Groupe</th>
                                <th colspan='2'>Module</th>
                                <th rowspan='2'>Avancement</th>
                                <th rowspan='2'>Message</th>
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
                            <td>$info[0]</td>
                            <td>$info[1]</td>
                            <td>$info[4]</td>
                            <td>$info[3]</td>

                            <td>$info[2]</td>
                            <td>$avc %</td>
                            <td>$message</td>
                    </tr>";
        }
        echo "</tbody></table>";
    }
} else
    require "../View/V_TauxAvancemant_affectation.php";
