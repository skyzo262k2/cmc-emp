<?php

require "../Model/M_AbsenceStagiaire.php";

session_start();

if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

$absencestagiaire = new AbsenceStagiaire();

$CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];
$annees = explode("/", $_SESSION["Annee"]);
$AnneeFr = $annees[0];




function GetDay($d)
{
    $T_NameDay = [
        "Mon" => "Lundi",
        "Tue" => "Mardi",
        "Wed" => "Mercredi",
        "Thu" => "Jeudi",
        "Fri" => "Vendredi",
        "Sat" => "Samedi",
        "Sun" => "Dimanche"
    ];
    $dayname = date('D', strtotime($d));
    return $T_NameDay[$dayname];
}

function AfficherStagiaire($Stagiaires, $seance, $date)
{
    global $absencestagiaire, $AnneeFr, $CodeEtab;
    echo "<div class='table_info'>
    <div class='buttonvalide'>
    <button class='btn btn-primary ' onclick='AddAbsence()'>Sauvgarder</button>
    </div>
    <table class='table table-striped table-sm table-bordered m-2'>
    <thead>
        <tr class='table-success'>
            <th scope='col'>CEF</th>
            <th scope='col'>Nom</th>
            <th scope='col'>Prénom</th>
            <th scope='col'>Discipline</th>
            <th scope='col' style='width:60px;'>A <input type='radio' name='tout' value='chekA' class='m-2' onchange='tout_checked(this)'/></th>
            <th scope='col' style='width:60px;'>R <input type='radio' name='tout' value='chekR' class='m-2' onchange='tout_checked(this)'/></th>
            <th scope='col' style='width:120px;'>Justifie</th>
            <th scope='col' style='width:120px;'>Action</th>
        </tr>
    </thead>
    <tbody>";

    foreach ($Stagiaires as $stg) {
        $row = $absencestagiaire->VerifierAbsenceStagiaire($stg[0], $date, $AnneeFr, $seance, $CodeEtab);

        echo "<tr>
                <td>" . htmlspecialchars($stg[0]) . "</td>
                <td>" . htmlspecialchars($stg[1]) . "</td>
                <td>" . htmlspecialchars($stg[2]) . "</td>
                <td>" . htmlspecialchars($stg[6]) . "</td>";

        if ($row == null) {
            echo "  <td class='text-center'><input type='radio' class='inp_chek checked_input chekA' name='" . htmlspecialchars($stg[0]) . "' value='" . htmlspecialchars($stg[0]) . "/A' /></td>
                    <td class='text-center'><input type='radio' class='inp_chek checked_input chekR' name='" . htmlspecialchars($stg[0]) . "' value='" . htmlspecialchars($stg[0]) . "/R' /></td>
                    <td class='text-center'>-</td>
                    <td class='text-center'>-</td>
                </tr>";
        } else {
            if ($row[8] === "A") {
                echo "<td class='text-center'><input type='radio' checked /></td>
                    <td class='text-center'><input type='radio' disabled  /></td>";
            } else {
                echo "<td class='text-center'><input type='radio' disabled  /></td>
                    <td class='text-center'><input type='radio' checked /></td>";
            }

            echo "<td class='text-center'> <span>" . htmlspecialchars($row[6]) . "</span> <span onclick='ChangeJustify(this)'><span style='display:none;'>" . htmlspecialchars($row[6]) . "</span><span style='display:none;'>" . htmlspecialchars($stg[0]) . "</span>
                            <span><img class='icon' src='../Images/Icon_Update.png'/></span></span>  </td>
                    <td class='text-center'><div onclick='SupprimerAbsence(this)'><span><img class='icon' src='../Images/Icon_Delete.png'/></span><span style='display:none;'>" . htmlspecialchars($stg[0]) . "</span></div></td>
                    </tr>";
        }
    }
    echo "</tbody>
        </table>

        
    
    </div>";
}


function information_Seance($infos)
{
    if (!$infos)
        $infos = ["-", "-", "-", "-", "-"];

    echo '<div class="row m-2">
                
                <div class="col-3">
                    <div class="form-groupe">
                        <input type="text" class="form-control" disabled value="' . htmlspecialchars($infos[1]) . '" style="text-align : center;">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-groupe">
                    <input type="text" class="form-control" disabled  style="text-align : center;" value="' . htmlspecialchars($infos[3]) . '">
                    </div>
                    <div class="form-groupe">
                    <input type="hidden" id="module" class="form-control" disabled  style="text-align : center;" value="' . htmlspecialchars($infos[2]) . '">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-groupe">
                        <input type="text" class="form-control" disabled value="' . htmlspecialchars($infos[4]) . '" style="text-align : center;">
                    </div>
                </div>
                </div>';
}




if (isset($_POST["add"]) && isset($_POST["date"]) && isset($_POST["seance"]) && isset($_POST["groupe"]) && isset($_POST["module"])) {

    // print_r($_POST["module"]);
    $t_cef = explode(",", $_POST["add"]);
    // print_r($t_cef);

    $day_name = GetDay($_POST["date"]);
    $CodeModule = $_POST["module"];
    foreach ($t_cef as $cef) {
        $cef_type = explode("/", $cef);
        $absencestagiaire->typeAbsence = $cef_type[1];
        try {
            $absencestagiaire->AddAbsence($cef_type[0], $AnneeFr, $_POST["date"], $_POST["groupe"], $_POST["seance"], $CodeModule, "Non", $CodeEtab);
        } catch (Exception $ec) {
        }
    }
    $Stagiaires = $absencestagiaire->GetStagiairebyGroupe($_POST["groupe"], $AnneeFr, $CodeEtab);
    $information_seance = $absencestagiaire->GetInformationSeanceGroupe($_POST["groupe"], $day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    information_Seance($information_seance);
    AfficherStagiaire($Stagiaires, $_POST["seance"], $_POST["date"]);
} elseif (isset($_POST["modcef"]) && isset($_POST["date"]) && isset($_POST["seance"]) && isset($_POST["justify"]) && isset($_POST["groupe"])) {
    $day_name = GetDay($_POST["date"]);
    $absencestagiaire->ChangeJustifyStagiaire($_POST["modcef"], $_POST["date"], $_POST["seance"], $AnneeFr, $CodeEtab, $_POST["justify"]);
    $Stagiaires = $absencestagiaire->GetStagiairebyGroupe($_POST["groupe"], $AnneeFr, $CodeEtab);

    $information_seance = $absencestagiaire->GetInformationSeanceGroupe($_POST["groupe"], $day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    information_Seance($information_seance);
    AfficherStagiaire($Stagiaires, $_POST["seance"], $_POST["date"]);
} elseif (isset($_POST["supcef"]) && isset($_POST["date"]) && isset($_POST["seance"]) && isset($_POST["groupe"])) {
    $day_name = GetDay($_POST["date"]);
    $absencestagiaire->DeleteAbsence($_POST["supcef"], $AnneeFr, $_POST["date"], $_POST["seance"], $CodeEtab);
    $Stagiaires = $absencestagiaire->GetStagiairebyGroupe($_POST["groupe"], $AnneeFr, $CodeEtab);

    $information_seance = $absencestagiaire->GetInformationSeanceGroupe($_POST["groupe"], $day_name, $_POST["seance"], $AnneeFr, $CodeEtab);
    information_Seance($information_seance);
    AfficherStagiaire($Stagiaires, $_POST["seance"], $_POST["date"]);
} elseif (isset($_POST["date"]) && isset($_POST["seance"]) && !isset($_POST["groupe"])) {
    if ($_POST["seance"] != "choisir" && !empty($_POST["date"])) {
        $date = $_POST["date"];
        $day_name = GetDay($date);
        if ($day_name != "Dimanche") {
            // $Groupes = $absencestagiaire->GetAllGroupebyEmploi($_POST["seance"], $day_name, $AnneeFr, $CodeEtab);
            $absencestagiaire->connexion();
            if ($_SESSION["Admin"]["Poste"] == "ChefSecteur")
                $Groupes = AbsenceStagiaire::$cnx->query(" select distinct g.codegrp from stagiaire s inner join groupe g on g.CodeGrp = s.groupe inner join filiere f using(CodeFlr)
            where s.Etab = '" . $CodeEtab . "' and s.AnneF = '" . $AnneeFr . "' and f.CodeSect = '" . $_SESSION["Admin"]["secteur"] . "'   order by g.codegrp")->fetchAll(PDO::FETCH_NUM);
            else
                $Groupes = AbsenceStagiaire::$cnx->query(" select distinct g.codegrp from stagiaire s inner join groupe g on g.CodeGrp = s.groupe 
            where s.Etab = '" . $CodeEtab . "' and s.AnneF = '" . $AnneeFr . "' order by g.codegrp")->fetchAll(PDO::FETCH_NUM);
            $absencestagiaire->Deconnexion();

            echo "<select name='groupe' id='groupe' class='form-control' onchange='ChangeGroupe(this)'>
                    <option value='choisir'>Choisir Groupe</option>";
            foreach ($Groupes as $grp) {
                echo "<option value='" . htmlspecialchars($grp[0]) . "'>" . htmlspecialchars($grp[0]) . "</option>";
            }
            echo "</select>";
        } else
            echo "<select name='groupe' id='groupe' class='form-control' onchange='ChangeGroupe(this)'>
                <option value='choisir'>Choisir Groupe</option>
            </select>";
    } else
        echo "<select name='groupe' id='groupe' class='form-control' onchange='ChangeGroupe(this)'>
                <option value='choisir'>Choisir Groupe</option>
            </select>";
} elseif (isset($_POST["groupe"]) && isset($_POST["date"]) && isset($_POST["seance"])) {
    $day_name = GetDay($_POST["date"]);
    $seance = $_POST["seance"];
    if ($day_name != "Dimanche") {
        $Stagiaires = $absencestagiaire->GetStagiairebyGroupe($_POST["groupe"], $AnneeFr, $CodeEtab);
        $information_seance = $absencestagiaire->GetInformationSeanceGroupe($_POST["groupe"], $day_name, $seance, $AnneeFr, $CodeEtab);
        information_Seance($information_seance);
        AfficherStagiaire($Stagiaires, $_POST["seance"], $_POST["date"]);
    }
} else {
    $dt = new DateTime();
    $sysdate = $dt->format("Y-m-d");
    require "../View/V_AbsenceStagiaire.php";
}
