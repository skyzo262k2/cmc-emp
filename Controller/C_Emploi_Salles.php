<?php
require "../Model/M_Connexion.php";


session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

$cnnx = new Connexion();
$cnnx->connexion();
$CodeEtab = $_SESSION['Etablissement']["CodeEtb"];
$anne = explode('/', $_SESSION['Annee']);

if ($_SESSION["Admin"]["Poste"] == "ChefSecteur")
    $Salles = $cnnx::$cnx->query("select CodeSl , descpSl from Salle where CodeEtab = '$CodeEtab' and secteur = '" . $_SESSION["Admin"]["secteur"] . "'")->fetchAll(PDO::FETCH_NUM);
else
    $Salles = $cnnx::$cnx->query("select CodeSl , descpSl from Salle where CodeEtab = '$CodeEtab'")->fetchAll(PDO::FETCH_NUM);

$Html_Table = "";
foreach ($Salles as $Sal) {
    $T_Jours = [
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]],
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]],
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]],
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]],
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]],
        [["", "", ""], ["", "", ""], ["", "", ""], ["", "", ""]]
    ];

    $T_Jour = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
    $Emploi_Salle = $cnnx::$cnx->query("call SP_Emploi_Salle('$Sal[0]','$CodeEtab','$anne[0]')")->fetchAll(PDO::FETCH_NUM);

    foreach ($Emploi_Salle as $Day) {
        for ($j = 0; $j < 6; $j++) {
            if ($T_Jour[$j] == $Day[1]) {
                for ($i = 0; $i < 4; $i++) {
                    if ($i + 1 == $Day[2]) {
                        $T_Jours[$j][$i] = [$Day[0], $Day[3], $Day[4]];
                    }
                }
            }
        }
    }
    $Html_Table .= "<tr><td class='NameSalle'>" . htmlspecialchars($Sal[1]) . "</td>";

    for ($j = 0; $j < 6; $j++) {
        for ($i = 0; $i < 4; $i++) {
            if ($T_Jours[$j][$i][0] == "") {
                $Html_Table .= "<td></td>";
            } else {
                $for = $T_Jours[$j][$i][0];
                $gr = $T_Jours[$j][$i][1];
                $mo = $T_Jours[$j][$i][2];

                $Html_Table .= "<td class='Nondisp bg-secondary text-center'>
                            <a href='javascript:void(0)' data-tooltips=\"" . htmlspecialchars($for . " ---- " . $gr . " ---- " . $mo) . "\" class='tooltips-top text-bg-danger bg-secondary'>X</a>
                            </td>";
            }
        }
    }
    $Html_Table .= "</tr>";
}

// $Day[0] <br> $Day[3] <br> $Day[4]

require "../View/V_Emploi_Salles.php";
