<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
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
                        <img class="border rounded-circle img-profile" src="../Images/logo.jpg" width="60px">
                        <!-- <i class="fas fa-laugh-wink"></i> -->
                    </div>
                    <div class="sidebar-brand-text mx-2"><span><?= $_SESSION['Etablissement']['DescpFr'] ?></span></div>
                </a>
                <hr class="sidebar-divider my-0">

                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php if ($poste != "Surveille" && $poste != "formateur") : ?>
                        <?php if ($poste != "ChefSecteur") : ?>
                            <li class="nav-item">
                                <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Home.php">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-pencil-alt"></i>

                                <span>Absence</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_AbsenceStagiaire.php" target="iframe_a">Absence Stagiaire</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">Consulter Stagiaire</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_AbsenceFormateur.php" target="iframe_a">Absence Formateur</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_ConsulterAbsenceFormateur.php" target="iframe_a">Consulter Formateur</a></li>
                        </ul>

                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-table"></i>

                                <span>Emploi</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Controller/C_EmploiReel.php" target="iframe_a">Groupe</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Emploil_Brouillon.php" target="iframe_a">Bruillon Groupe</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Emploi_Groupes.php" target="iframe_a">Bruillon Large</a></li>
                            <?php if ($poste != "ChefSecteur") : ?>
                                <li><a class="dropdown-item" href="../Controller/C_EmploiArchiver.php" target="iframe_a">Archiver</a></li>
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
                            <li><a class="dropdown-item" href="../Controller/C_affectationModule.php" target="iframe_a">Affectation Module</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Groupe_Fomateur_Affecter.php" target="iframe_a">Modules Groupe</a></li>
                        </ul>


                        <li class="nav-item" data-bs-toggle="dropdown">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%> dropdown-toggle" href="/home">
                                <i class="fas fa-calendar"></i>

                                <span>Parametrage</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">Surveille</a></li> -->
                            <li><a class="dropdown-item" href="../Controller/C_Formateur.php" target="iframe_a">Formateur</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Stagiaire.php" target="iframe_a">Stagiaire</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Module.php" target="iframe_a">Module</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_salle.php" target="iframe_a">Salle</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_Groupe.php" target="iframe_a">Groupe</a></li>
                            <li><a class="dropdown-item" href="../Controller/C_filiere.php" target="iframe_a">Filière</a></li>
                            <?php if ($poste != "ChefSecteur") : ?>
                                <li><a class="dropdown-item" href="../Controller/C_Secteur.php" target="iframe_a">Secteur</a></li>
                                <li><a class="dropdown-item" href="../Controller/C_Niveau.php" target="iframe_a">Niveaux</a></li>
                                <li><a class="dropdown-item" href="../Controller/C_Surveille.php" target="iframe_a">Utilisateur</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="../Controller/C_Validateur.php" target="iframe_a">Validateur</a></li>
                        </ul>

                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Avancement_Module.php" target="iframe_a">
                                <i class="fas fa-calculator"></i>

                                <span>Avancement Module</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_TauxAvancemant_affectation.php" target="iframe_a">
                                <i class="fas fa-star"></i>

                                <span>Taux Avancement</span>
                            </a>
                        </li>
                    <?php elseif ($poste == 'formateur') : ?>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_affectationModule.php" target="iframe_a">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Module Affecter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Formateur.php" target="iframe_a">
                                <i class="fas fa-layer-group"></i>
                                <span>Emploi Formateur</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Consulter Stagiaire</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Gestion_EFM.php" target="iframe_a">
                                <i class="fas fa-layer-group"></i>
                                <span>Gestion EFM</span>
                            </a>
                        </li>
                        <?php if (count($data) != 0) : ?>
                            <li class="nav-item">
                                <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Valider.php" target="iframe_a">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Valider EFM</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_EmploiReel.php" target="iframe_a">

                                <i class="fas fa-layer-group"></i>
                                <span>Emploi Groupe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Salles.php" target="iframe_a">

                                <i class="fas fa-object-group"></i>
                                <span>Emploi Salles</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Emploi_Formateur.php" target="iframe_a">
                                <i class="fas fa-save"></i>
                                <span>Emploi Formateur</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_Stagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Gestion Stagiaire</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_AbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-pencil-alt"></i>
                                <span>Absence Stagiaire</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_ConsulterAbsenceStagiaire.php" target="iframe_a">

                                <i class="fas fa-archive"></i>

                                <span>Consulter Stagiaire</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <%=(locals.activeDash) ? 'active': ''%>" href="../Controller/C_AbsenceFormateur.php" target="iframe_a">


                                <i class="fas fa-pencil-ruler"></i>
                                <span>Absence Formateur</span>
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
                            Année Formation : <?= $annee ?>
                        </div>

                        <!-- <button class="btn btn-link d-md-none rounded-circle me-3"  id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button> -->
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <!-- <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php echo $nom . "  " . $prenom ?>
                                        </span>
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                        <!-- <img class="border rounded-circle img-profile"
                                            src="../Css/assets/img/avatars/avatar1.jpeg"> -->
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end bg-light animated--grow-in">
                                        <?php if ($poste != "Surveille" && $poste != "formateur") : ?>
                                            <a class="dropdown-item" href="../Controller/C_Profil.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php elseif ($poste == "formateur") : ?>
                                            <a class="dropdown-item" href="../Controller/C_ProfilFormateur.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php elseif ($poste == "Surveille") : ?>
                                            <a class="dropdown-item" href="../Controller/C_ProfilSurveille.php" target="iframe_a">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                        <?php endif; ?>


                                        <form method="POST" action="" id="disconnect">
                                            <!-- <input name="disconnect" value="true" hidden /> -->
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
    <!-- <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a> -->
    </div>
    <script src="../Css/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../Css/assets/js/chart.min.js"></script>
    <script src="../Css/assets/js/bs-init.js"></script>
    <script src="../Css/assets/js/theme.js"></script>
</body>