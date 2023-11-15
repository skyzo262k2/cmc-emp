<?php
require "../Model/M_Formateur.php";
require "../Model/M_Pagination.php";

session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$rech = "";
$info = "";

$Formateur = new Formateur();
$Formateur->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];


$Formateur->connexion();
$AlSecteurs = $Formateur::$cnx->query("select CodeSect,DescpSect from secteur;")->fetchAll(PDO::FETCH_NUM);
$Formateur->Deconnexion();

$Pag = new Pagination();

$poste = $_SESSION['Admin']['Poste'];
$secteur = isset($_SESSION['Admin']['secteur']) ? $_SESSION['Admin']['secteur'] : null;

$anne = explode('/', $_SESSION['Annee'])[0];

$cryptage_password = password_hash('OFPPT', PASSWORD_DEFAULT);


// Utilisation de la page 1 par defaut
if (!isset($_GET["get"])) {
    $_GET["get"] = 1;
}

if (isset($_POST["sup"])) {
    $Formateur->Matricule = $_POST["sup"];
    $Formateur->Delete();
}
if (isset($_POST["Reinitialiser"])) {
    $Formateur->connexion();
    $Formateur::$cnx->exec("UPDATE formateur SET Mdp='$cryptage_password' WHERE Matricule='{$_POST["Reinitialiser"]}'");
}

// Methode Ajouter un formateur quant en click le button Ajouter
if (isset($_POST["btnAjouter"])) {
    if (!empty($_POST["tMatricule"]) && !empty($_POST["tNom"]) && !empty($_POST["tPrenom"]) && $_POST["tType"] != "choisir" && $_POST["tMasseHoraire"] != "choisir") {
        $Formateur->Matricule = $_POST["tMatricule"];
        $Formateur->Nom = $_POST["tNom"];
        $Formateur->Prenom = $_POST["tPrenom"];
        $Formateur->Type = $_POST["tType"];
        $Formateur->MassHoraire = $_POST["tMasseHoraire"];
        $Formateur->Password = $cryptage_password;
        $Formateur->Secteur = $_POST["tSecteur"];
        $Formateur->Add();
    }
}

// Methode Modifier un formateur quant en click le button Modifier
if (isset($_POST["btnModifier"])) {
    if (!empty($_POST["tMatricule"]) && !empty($_POST["tNom"]) && !empty($_POST["tPrenom"])  && empty($_POST["tType"]) != "choisir" && $_POST["tSecteur"] != "choisir" && $_POST["tMasseHoraire"] != "choisir") {
        $Formateur->Matricule = $_POST["tMatricule"];
        $Formateur->Nom = $_POST["tNom"];
        $Formateur->Prenom = $_POST["tPrenom"];
        $Formateur->Type = $_POST["tType"];
        $Formateur->MassHoraire = $_POST["tMasseHoraire"];
        $Formateur->Secteur = $_POST["tSecteur"];
        $Formateur->Update();
    }
}

// Methode Supprimer un formateur quant en click le button Supprimer
if (isset($_POST["btnSupprimer"])) {
    $Formateur->DeleteAll();
}




if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfoformateur"] = $info;
    if ($info == "") {
        if ($poste != "ChefSecteur")
            $_SESSION['Formateurs'] = $Formateur->GetAll();
        else
            $_SESSION['Formateurs'] = $Formateur->GetFormateurSecteur($secteur,$anne);
    } else {
        $Formateur->connexion();
        if ($poste != "ChefSecteur")
            $_SESSION['Formateurs'] = $Formateur->Find($info);
        else
            $_SESSION['Formateurs'] = $Formateur->FindSecteur($info, $secteur);
    }

    for ($i = 0; $i < count($_SESSION['Formateurs']); $i++) {
        if ($_SESSION['Formateurs'][$i]["secteur"] == "") {
            $_SESSION['Formateurs'][$i]["secteur"] = "Sans";
        }
    }

    echo "<div class='pagi_sup'>
                <div class='pagination'>";

    $Formateus = $Pag->Pagination_Btn($_SESSION['Formateurs'], $_GET['get']);
    $Pag->Pagination_Nb($Formateus, $_GET['get']);

    echo "</div>
                <div class='deleteAll'>
                    <form action='' method='post'>
                        <input type='submit' value='Supprimer tous' class='btn btn-primary' name='btnSupprimer' class='end-0' onclick='return confirm('Tu es Sure pour Supprimer Tous ?')' id='btnSupprimer'>
                    </form>
                </div>
            </div>

            <div class='table-affiche'>
                <table class='table table-striped table-sm table-bordered'>
                    <thead>
                        <tr class='table-success'>
                            <th scope='col'>Matricule</th>
                            <th scope='col'>Nom</th>
                            <th scope='col'>Prénom</th>
                            <th scope='col'>Type</th>
                            <th scope='col'>Masse Horaire</th>
                            <th scope='col'>Secteur</th>
                            <th scope='col'>Réinitialiser</th>
                            <th scope='col'>Action</th>
                        </tr>
                    </thead>
                   
            <tbody >
            ";
    $Pag->GetTablePage($_SESSION['Formateurs'], $_GET['get'], 'formateur');
    echo " 
            </tbody>
            </table>
            </div>";
} else {
    if (isset($_SESSION["rechinfoformateur"])) {
        $info = $_SESSION["rechinfoformateur"];
        if ($info == "") {
            if ($poste != "ChefSecteur")
                $_SESSION['Formateurs'] = $Formateur->GetAll();
            else
                $_SESSION['Formateurs'] = $Formateur->GetFormateurSecteur($secteur,$anne);
        } else {
            $Formateur->connexion();
            if ($poste != "ChefSecteur")
                $_SESSION['Formateurs'] = $Formateur->Find($info);
            else
                $_SESSION['Formateurs'] = $Formateur->FindSecteur($info, $secteur);
        }
    } else {
        if ($poste != "ChefSecteur")
            $_SESSION['Formateurs'] = $Formateur->GetAll();
        else
            $_SESSION['Formateurs'] = $Formateur->GetFormateurSecteur($secteur,$anne);
    }
    for ($i = 0; $i < count($_SESSION['Formateurs']); $i++) {
        if ($_SESSION['Formateurs'][$i]["secteur"] == "") {
            $_SESSION['Formateurs'][$i]["secteur"] = "Sans";
        }
    }

    
    require "../View/V_Formateur.php";
}
