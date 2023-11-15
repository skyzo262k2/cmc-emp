<?php
require "../Model/M_Emploil_Brouillon.php";



session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$empG = new Emploi_group();
$codetb = $_SESSION['Etablissement']['CodeEtb'];
$anne = explode('/', $_SESSION['Annee']);

if ($_SESSION["Admin"]["Poste"] != 'ChefSecteur') {
    $Groupes= $empG->GetAllGroupes($codetb, $anne[0]);
} else {
    $Groupes= $empG->GetAllGroupesParSeteur($codetb, $anne[0],$_SESSION['Admin']['secteur']);
}

$tableser = $hidden = $jour = $seance = $hiddensup = $salles = $occuper = "";
$blocktype = 'disabled';
$blocksalle = 'disabled';

if (isset($_POST['utl'])) :
    try {
        $empG->Utiliser();
    } catch (Exception $er) {;
    }
endif;

if (isset($_POST['ajt']) && isset($_POST['type'])) :
    print_r($_POST);
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
            $empG->Add_cour("$grp", "$jour", "$seance", "$mdl", "$mat", "$sal[0]", "$typsc", "$codetb", "$anne[0]");
        } else {
            $grps = json_decode($_POST['groupes']);
            foreach ($grps as $grp) {
                $empG->Add_cour("$grp", "$jour", "$seance", "$mdl", "$mat", "$sal[0]", "$typsc", "$codetb", "$anne[0]");
            }
        }
    }
endif;


if (isset($_POST['sup'])) {
    $jour = $_POST['jour'];
    $seance = $_POST['seance'];
    $grp = $_POST['grp'];
    $empG->Delete_cour($grp, $jour, $seance, $codetb, $anne[0]);
}

if (isset($_POST['ModuleGrpFormateur'])) {
    $modulesgps = $empG->ModuledeGoupeformateur($_POST['mat'], $_POST['grop'], $codetb, $anne[0]);
    $sallesmod = $empG->GetSalleDispo($_POST['jour'], $_POST['seance'], $codetb, $anne[0]);
    $data = ['modules' => $modulesgps, 'salles' => $sallesmod];
    echo json_encode($data);
}

if (isset($_POST['ModifierModuleGrpFormateur'])) {
    $ver = $empG->ModifierCour($_POST['mat'], $_POST['mdl'], $_POST['sal'], $_POST['grop'], $_POST['jour'], $_POST['seance'], $codetb, $anne[0]);
    if (count($ver) != 0)
        echo json_encode($ver);
    else
        echo json_encode(['true' => 1]);
}

if (isset($_POST['group']) && $_POST['group'] != "") {

    $hiddensup = 'hidden';
    $grp = $_POST['group'];
    $emploiG = $empG->EmploiGroupes($codetb, $anne[0], $grp);
    $formateur = $empG->GetFormateur($codetb, $anne[0], $grp);


    $data = ['group' => $emploiG, 'formateur' => $formateur];
    echo json_encode($data);
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
        $groupes = $empG->MemeModule_group("$mdl", "$mat", "$jour", "$seance", "$codetb", "$anne[0]");
        print_r(json_encode($groupes));
    }

endif;



if (isset($_POST['frm']) && $_POST['frm'] != "") :
    $blocktype = '';

    $information = split($_POST['frm']);

    $mat = $information[0];

    $jour = $_POST['jour'];

    $seance = $_POST['seance'];

    $occuper = $empG->EmploiFormateurdispo($mat, $jour, $seance, $codetb, $anne[0]);

    if (count($occuper) != 0) {
        $mat = "";
        $nomp = "";
        $occuper[] = $information[1];
        print_r(json_encode(['occuper' => $occuper]));
    } else {
        $occuper = null;

        $salles = $empG->GetSalleDispo("$jour", "$seance", "$codetb", "$anne[0]");
        print_r(json_encode(['salles' => $salles]));
    }
endif;

function split($tab)
{
    $tb = explode('/', $tab);
    return $tb;
}

if (!isset($_POST['group']) && !isset($_POST['frm']) && !isset($_POST['typesc']) && !isset($_POST['ajt']) && !isset($_POST['sup']) && !isset($_POST['ModuleGrpFormateur']) && !isset($_POST['ModifierModuleGrpFormateur']))
    require "../View/V_Emploil_Brouillon.php";
