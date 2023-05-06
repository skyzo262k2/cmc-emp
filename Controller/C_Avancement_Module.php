<?php
require "..//Model/M_Connexion.php";
require('../simplexlsxgen/src/SimpleXLSXGen.php');
require_once '../Model/SimpleXLSX.php';

use Shuchkin\SimpleXLSX;
use Shuchkin\SimpleXLSXGen;

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
        header("location:../Controller/C_Login.php");
}
set_time_limit(5000);
$anne = explode('/', $_SESSION['Annee']);
$Etab = $_SESSION["Etablissement"]["CodeEtb"];
$cnnx = new Connexion();
$cnnx->connexion();
$datesys = new DateTime();
$T_NameDay = ["Mon" => "Lundi", "Tue" => "Mardi", "Wed" => "Mercredi", "Thu" => "Jeudi", "Fri" => "Vendredi", "Sat" => "Samedi"];
function GetSeance($date)
{
        global $T_NameDay, $cnnx, $anne, $Etab;
        $dayname = date('D', strtotime($date));
        if ($dayname != "Sun") {
                $Day = $T_NameDay[$dayname];
                $Seances_Day = $cnnx::$cnx->query("call PS_GetSeanceByDay('$Day','$anne[0]','$Etab')")->fetchAll(PDO::FETCH_NUM);
                echo "<table width='100%' class='table table-bordered table-hover table-borderless'>
                <tr class='table-info'>
                <th colspan='2'>Date</th>
                <th colspan='3' >$date</th>
                <th colspan='3'>Selection Tout : <input type='checkbox' name='tout' id='tout' onclick='Selection_Tout()'></th>
                </tr>";
                echo '<tr class="table-secondary">
                            <th>Formateur</th>
                            <th>Groupe</th>
                            <th>Module</th>
                            <th>Code Salle</th>
                            <th>Jour</th>
                            <th>Seance</th>
                            <th>checked</th>
                            <th>Action</th>
                         </tr>';
                $i = 0;
                foreach ($Seances_Day as $sec) {
                        $n = $cnnx::$cnx->query("call PS_FindAvancement('$date','$sec[3]','$sec[2]','$sec[0]','$sec[1]','$anne[0]','$Etab')")->fetch(PDO::FETCH_NUM);
                        $i++;
                        $couleur = $cnnx::$cnx->query("call couleur_row_affectation('$sec[3]','$sec[2]','$sec[0]','$anne[0]','$Etab')")->fetch(PDO::FETCH_NUM);;

                        echo "<tr class='trinfo'>";
                        echo "  <td>$sec[4]</td>    
                            <td>$sec[0]</td>
                            <td>$sec[5]</td>
                            <td>$sec[6]</td>
                            <td>$Day</td>
                            <td>$sec[1]</td>";
                        if ($n != null) {
                                echo "<td style='background-color: $couleur[0] ;'><input type='checkbox' name='$i' value='$date/$sec[3]/$sec[0]/$sec[2]/$sec[1]/$Day' disabled checked class='avc'></td>";
                                // echo "<td><a href='../Controller/C_Avancement_Module.php?date=$date&mat=$sec[3]&md=$sec[2]&grp=$sec[0]&sc=$sec[1]'>supprimer</a></td>
                                echo "<td><div onclick='DeleteAvanvement(this)'><img width='25px' src='../Images/Icon_Delete.png' alt=''/><input type='hidden' value='$date/$sec[3]/$sec[2]/$sec[0]/$sec[1]'/></div></td>
                         </tr>";
                        } else {
                                echo "<td style='background-color: $couleur[0] ;'><input type='checkbox' name='$i' value='$date/$sec[3]/$sec[0]/$sec[2]/$sec[1]/$Day' class='avc'></td>";
                                echo "<td>-</td></tr>";
                        }
                }
                echo '</table>';
                echo '<div class="btn_val">
                                <button class="btn btn btn-primary" onclick="AddAvanvement()">Valider</button>
                        </div>';
        } else {
                echo '<div class="btn_val m-5">
                        <span class="btn btn btn-danger">Ajourd\'hui c\'est Dimanche </span>
                </div>';
        }
}
if (isset($_POST['import']) && isset($_FILES['execl']) && $_FILES['execl']['tmp_name'] != "") {

        $data = SimpleXLSX::parse($_FILES['execl']['tmp_name']);
        $req = "CREATE TEMPORARY TABLE temp_avc (grp VARCHAR(255), mdl VARCHAR(255), mat VARCHAR(255), avc VARCHAR(255));";
        $cnnx::$cnx->exec($req);
        $inserts = array();

        foreach ($data->rows() as $row) {    
                if ($row[8] != "" && $row[16] != "" && $row[19] != "" && $row[40] != "") 
                        $inserts[] = "('" . $row[8] . "', '" . $row[16] . "', '" . $row[19] . "', '" . $row[40] . "')";
        }

        $req = "INSERT INTO temp_avc (grp, mdl, mat, avc) VALUES " . implode(",", $inserts) . ";";
        $cnnx::$cnx->exec($req);

        $batch_size = 100;
        $offset = 0;
        while (true) {
                $req = "SELECT * FROM temp_avc LIMIT " . $offset . "," . $batch_size . ";";
                $result = $cnnx::$cnx->query($req);
                if (!$result) {
                        break;
                }
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) == 0) {
                        break;
                }
                $cnnx::$cnx->beginTransaction();
                foreach ($rows as $row) {
                        $req = "UPDATE affectmodule SET avc = '" . $row['avc'] . "' WHERE Groupe = '" . $row['grp'] . "' AND Matricule = '" . $row['mat'] . "' AND ModuleCode = '" . $row['mdl'] . "' AND CodeEtab = '{$Etab}' AND AnneeFr = '{$anne[0]}';";
                        $cnnx::$cnx->exec($req);
                }
                $cnnx::$cnx->commit();
                $offset += $batch_size;
        }
    
}


if (isset($_POST["date"]) && isset($_POST['execl'])) {
        print_r($_POST);
        $date = $_POST["date"];
        $dayname = date('D', strtotime($date));
        $Day = $T_NameDay[$dayname];
        $Seances_Days = $cnnx::$cnx->query("call PS_GetSeanceByDayinexecl('$Day','$anne[0]','$Etab')")->fetchAll(PDO::FETCH_NUM);
        $tables = [];
        $tables[] = [0 => "Formateur", 1 => "Groupe", 2 => "Description Module", 3 => "Jour", 4 => "Séance", 5 => "Salle", 6 => $date];
        foreach ($Seances_Days as $row) :
                $tables[] = $row;
        endforeach;
        $xlsx = SimpleXLSXGen::fromArray($tables);
        $xlsx->downloadAs("Absance.xlsx");
} elseif (isset($_POST["delete"])) {
        // echo $_POST["delete"];
        $info = explode("/", $_POST["delete"]);
        $n = $cnnx::$cnx->exec("call PS_DeleteAvancement('$info[0]','$info[1]','$info[2]','$info[3]','$info[4]','$anne[0]','$Etab')");
        if ($n) {
                $m = $cnnx::$cnx->exec("call PS_ModifierAffectmoduleMois('$info[1]','$info[2]','$info[3]','$anne[0]','$Etab')");
        }
        GetSeance($info[0]);
} elseif (isset($_POST["date"]) && isset($_POST["add"])) {
        $T_Checked = explode(",", $_POST["add"]);
        // print_r($T_Checked);
        foreach ($T_Checked as $chek) {
                $values = explode("/", $chek);
                $n = $cnnx::$cnx->exec("call PS_AddAvancement('$values[0]','$values[1]','$values[3]','$values[2]','$values[5]','$values[4]','$anne[0]','$Etab')");
                if ($n) {
                        $m = $cnnx::$cnx->exec("call PS_ModifierAffectmodulePlus('$values[1]','$values[3]','$values[2]','$anne[0]','$Etab')");
                }
        }
        GetSeance($_POST["date"]);
} elseif (isset($_POST["getdate"])) {
        GetSeance($_POST["getdate"]);
} else {
        $dt = new DateTime();
        $sysdate = $dt->format("Y-m-d");
        require "../View/V_Avancement_Module.php";
}
