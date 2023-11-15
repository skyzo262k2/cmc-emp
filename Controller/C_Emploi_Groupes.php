<?php
require "../Model/M_EmploiGroupe.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$emp = new EmploiGroupe();
$cdetab = $_SESSION['Etablissement']['CodeEtb'];
$anne = explode('/', $_SESSION['Annee']);
$hidden = $hiddensup = $disabled = $grop = $jour = $seance = $onchange = $hiddensal = "";
$occuper = [];
$blocktype = 'disabled';
$blocksalle = 'disabled';
if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur') {
    $_SESSION['groupes'] = $emp->GetAllGroupes($cdetab, $anne[0]);
} else {
    $_SESSION['groupes'] = $emp->GetAllGroupesParSeteur($cdetab, $anne[0], $_SESSION['Admin']['secteur']);
}

$Json = [];
$entrer = true;

if (isset($_POST['Matricule'])) {

    if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur') {
        $result = $emp->GetGroupFormateur($_POST['Matricule'], $cdetab, $anne[0]);
    } else {
        $result = $emp->GetGroupFormateurSecteur($_POST['Matricule'], $cdetab, $anne[0], $_SESSION['Admin']['secteur']);
    }
    print_r(json_encode($result));
}

if (isset($_POST['utl'])) :
    try {
        $emp->Utiliser();
        $_POST['typesc'] = "";
        $_POST['frm'] = "";
    } catch (Exception $er) {;
    }
endif;

if (isset($_POST['Valider'])) :
    $codegrps = json_decode($_POST['groupes']);
    if (count($codegrps) != 0) {
        $_SESSION['codechosit'] = $codegrps;
        $Json = Get_Empl_Grp($_SESSION['codechosit'], $cdetab, $anne[0], $emp);
        $_SESSION['json'] = $Json;
    }
    $data = ['group' => $_SESSION['json'], 'formateur' => $_SESSION['formateur']];
    print_r(json_encode($data));
    $_POST['typesc'] = "";
    $_POST['frm'] = "";
endif;



function Get_Empl_Grp($codegrps, $cdetab, $anne, $emp)
{

    foreach ($codegrps as $cdgrp) {
        $group = $emp->EmploiGroupes($cdetab, $anne, $cdgrp);
        if ($group != null) {
            $Json[] = $group;
            $_SESSION['formateur'][$cdgrp] = $emp->GetFormateur($cdetab, $anne[0], $cdgrp);
        } else {
            $Json[] = [['CodeGrp' => $cdgrp]];
            $_SESSION['formateur'][$cdgrp] = $emp->GetFormateur($cdetab, $anne[0], $cdgrp);
        }
    }
    return $Json;
}
function split($tab)
{
    $tb = explode('/', $tab);
    return $tb;
}

if (isset($_POST['ModuleGrpFormateur'])) {
    $modulesgps = $emp->ModuledeGoupeformateur($_POST['mat'], $_POST['grop'], $cdetab, $anne[0]);
    $sallesmod = $emp->GetSalleDispo($_POST['jour'], $_POST['seance'], $cdetab, $anne[0]);
    $data = ['modules' => $modulesgps, 'salles' => $sallesmod];
    echo json_encode($data);
}

if (isset($_POST['ModifierModuleGrpFormateur'])) {
    $ver = $emp->ModifierCour($_POST['mat'], $_POST['mdl'], $_POST['sal'], $_POST['grop'], $_POST['jour'], $_POST['seance'], $cdetab, $anne[0]);
    if (count($ver) != 0)
        echo json_encode($ver);
    else
        echo json_encode(['true' => 1]);
}

if (isset($_POST['typesc']) && $_POST['typesc'] != "") :

    $disabled = "disabled";
    $blocktype = '';
    $blocksalle = '';
    $types = $_POST['typesc'];

    $information = split($_POST['form']);

    $mat = $information[0];
    $mdl = $information[2];

    $jour = $_POST['jour'];
    $seance = $_POST['seance'];

    if ($_POST['typesc'] == "Distance") {
        $groupes = $emp->MemeModule_group("$mdl", "$mat", "$jour", "$seance", "$cdetab", "$anne[0]");
        print_r(json_encode($groupes));
    }

endif;

if (isset($_POST['frm']) && $_POST['frm'] != "") :
    $blocktype = '';

    $information = split($_POST['frm']);

    $mat = $information[0];

    $jour = $_POST['jour'];

    $seance = $_POST['seance'];

    $occuper = $emp->EmploiFormateurdispo($mat, $jour, $seance, $cdetab, $anne[0]);

    if (count($occuper) != 0) {
        $mat = "";
        $nomp = "";
        $occuper[] = $information[1];
        print_r(json_encode(['occuper' => $occuper]));
    } else {
        $occuper = null;

        $salles = $emp->GetSalleDispo("$jour", "$seance", "$cdetab", "$anne[0]");
        print_r(json_encode(['salles' => $salles]));
    }
endif;


if (isset($_POST['ajt']) && isset($_POST['type'])) :
    // print_r($_POST);
    $frm = split($_POST['form']);
    $mat = "";
    $mat = $frm[0];
    $mdl = $frm[2];
    $grp = $_POST['grp'];
    $jour = $_POST['jour'];
    $seance = $_POST['seance'];

    $typsc = $_POST['type'];

    $sal = split($_POST['salle']);

    if ($mdl != "" && $mat != "" && $typsc != "" && $sal[0] != "") {
        if ($_POST['type'] == "Présentiel") {
            $emp->Add_cour("$grp", "$jour", "$seance", "$mdl", "$mat", "$sal[0]", "$typsc", "$cdetab", "$anne[0]");
        } else {
            $grps = json_decode($_POST['groupes']);
            foreach ($grps as $grp) {
                $emp->Add_cour("$grp", "$jour", "$seance", "$mdl", "$mat", "$sal[0]", "$typsc", "$cdetab", "$anne[0]");
            }
        }
    }
endif;


if (isset($_POST['sup'])) :
    try {
        $grp = $_POST['grp'];
        $jour = $_POST['jour'];
        $seance = $_POST['seance'];
        $emp->Delete_cour("$grp", "$jour", "$seance", "$cdetab", "$anne[0]");
    } catch (Exception $er) {;
    }
endif;
if (!isset($_POST['Valider']) && !isset($_POST['frm']) && !isset($_POST['typesc']) && !isset($_POST['ajt'])  && !isset($_POST['sup']) && !isset($_POST['ModuleGrpFormateur']) && !isset($_POST['ModifierModuleGrpFormateur']) && !isset($_POST['Matricule']))
    require "../View/V_EmploiGroupes.php";
