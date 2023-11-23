<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../Images/CMC.ico">
    <title>CMC Nador</title>
    <link rel="stylesheet" href="../Css/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../Css/assets/fonts/fontawesome-all.min.css">
    <style>
        .dropdown-menu {
            background-color: rgba(118, 154, 231, 0.26);
            /* color: rgb(202, 5, 5); */
            border: none;
        }

        .dropdown-menu li a:hover {
            background-color: rgba(133, 164, 231, 0.26);
            color: rgb(0, 0, 0);
            /* border: none; */
        }

        .dropdown-menu li a {
            color: rgb(201, 201, 201);
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-13">
                        <img class="border rounded-circle img-profile" src="../Images/cmc.jpg" width="60px">
                        <!-- <i class="fas fa-laugh-wink"></i> -->
                    </div>
                    <div class="sidebar-brand-text mx-2"><span><?= htmlspecialchars($_SESSION['Etablissement']['DescpFr']) ?></span></div>
                </a>
                <hr class="sidebar-divider my-0">

                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php if ($poste != "Surveille" && $poste != "formateur") : ?>
                        <?php if ($poste != "ChefSecteur") : ?>
                            <li class="nav-item">
                                <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Home.php">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Tableau de board</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-pencil-alt"></i>

                                <span>Absences</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_AbsenceStagiaire.php" target="iframe_a">Absences des stagiaires</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">Consultation stagiaire</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_AbsenceFormateur.php" target="iframe_a">Absences des formateurs</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_ConsulterAbsenceFormateur.php" target="iframe_a">Consultation formateus</a></li>
                        </ul>

                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-table"></i>

                                <span>Emploi de temps</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_EmploiReel.php" target="iframe_a">Groupe</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Emploil_Brouillon.php" target="iframe_a">Bruillon Groupe</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Emploi_Groupes.php" target="iframe_a">Bruillon Large</a></li>
                            <?php if ($poste != "ChefSecteur") : ?>
                                <li><a class="dropdown-item" href="../Controller/C_EmploiArchiver.php" target="iframe_a">Archive</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="../Controller/C_Emploi_Formateur.php" target="iframe_a">Formateur</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Emploi_Salles.php" target="iframe_a">Salles</a></li>
                        </ul>


                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">

                                <i class="fas fa-clipboard-check"></i>

                                <span>Affectation</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_affectationModule.php" target="iframe_a">Affectation des Modules</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Groupe_Fomateur_Affecter.php" target="iframe_a">Modules de Groupe</a></li>
                        </ul>


                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-calendar"></i>

                                <span>Paramètrage</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_Formateur.php" target="iframe_a">Gestion des formateurs</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Stagiaire.php" target="iframe_a">Gestion des stagiaires</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Module.php" target="iframe_a">Gestion des modules</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_salle.php" target="iframe_a">Gestion des salles</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Groupe.php" target="iframe_a">Gestion des groupes</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_filiere.php" target="iframe_a">Gestion des filière</a></li>
                            <?php if ($poste != "ChefSecteur") : ?>
                                <li><a class="dropdown-item" href="../Controller/C_Secteur.php" target="iframe_a">Gestion des secteurs</a></li>
                                <li><a class="dropdown-item" href="../Controller/C_Niveau.php" target="iframe_a"> Gestion des niveaux</a></li>
                                <li><a class="dropdown-item" href="../Controller/C_Surveille.php" target="iframe_a">Gestion des utilisateurs</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="../Controller/C_Validateur.php" target="iframe_a">Gestion des validateurs</a></li>
                        </ul>

                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Avancement_Module.php" target="iframe_a">
                                <i class="fas fa-calculator"></i>

                                <span>Avancement des modules</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_TauxAvancemant_affectation.php" target="iframe_a">
                                <i class="fas fa-star"></i>

                                <span>Taux d'avancement</span>
                            </a>
                        </li>
                    <?php elseif ($poste == 'formateur') : ?>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_affectationModule.php" target="iframe_a">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Mes modules</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Formateur.php" target="iframe_a">
                                <i class="fas fa-layer-group"></i>
                                <span>Emploi de temps</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Consultation d'absences</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Gestion_EFM.php" target="iframe_a">
                                <i class="fas fa-layer-group"></i>
                                <span>Gestion d'EFM</span>
                            </a>
                        </li>
                        <?php if (count($data) != 0) : ?>
                            <li class="nav-item">
                                <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Valider.php" target="iframe_a">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Validation d'EFM</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_EmploiReel.php" target="iframe_a">

                                <i class="fas fa-layer-group"></i>
                                <span>Emploi de groupe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Salles.php" target="iframe_a">

                                <i class="fas fa-object-group"></i>
                                <span>Emploi des salles</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Formateur.php" target="iframe_a">
                                <i class="fas fa-save"></i>
                                <span>Emploi des formateurs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Stagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Gestion des stagiaires</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_AbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-pencil-alt"></i>
                                <span>Absences des stagiaires</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Consultation des absences</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_AbsenceFormateur.php" target="iframe_a">


                                <i class="fas fa-pencil-ruler"></i>
                                <span>Absences des formateurs</span>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <div>
                            Année Formation : <?= htmlspecialchars($annee) ?>
                        </div>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?= htmlspecialchars($nom . "  " . $prenom) ?>
                                        </span>
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                      
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end bg-light animated--grow-in">
                                        <?php if ($poste != "Surveille" && $poste != "formateur" && $poste != "ChefSecteur") : ?>
                                            <a class="dropdown-item" href="../Controller/C_Profil.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php elseif ($poste == "formateur") : ?>
                                            <a class="dropdown-item" href="../Controller/C_ProfilFormateur.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php elseif ($poste == "Surveille" || $poste == "ChefSecteur") : ?>
                                            <a class="dropdown-item" href="../Controller/C_ProfilSurveille.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php endif; ?>


                                        <form method="POST" action="" id="disconnect">
                                            <button type="submit" class="dropdown-item" name="btnDeconnexion">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <?php
                $url = "../Controller/C_Dashboard.php";
                if ($poste == "Surveille")
                    $url = "../Controller/C_Emploi_Salles.php";

                if ($poste == "ChefSecteur")
                    $url = "../Controller/C_Emploi_Salles.php";

                if ($poste == "formateur")
                    $url = "../Controller/C_Emploi_Formateur.php";

                echo "<iframe src='$url' name='iframe_a' height='84%' width='100%' title='Iframe Example'></iframe>";
                ?>

            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="../Css/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../Css/assets/js/chart.min.js"></script>
    <script src="../Css/assets/js/bs-init.js"></script>
    <script src="../Css/assets/js/theme.js"></script>
</body>