<html>

<head>
    <title>Connexion</title>
    <link rel="icon" type="image/jpg" href="../Images/CMC.ico">

    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <style>
        /* styles.css (reset) */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        label {
            font-weight: 600;
        }


        body {
            display: grid;
            place-items: center;
            margin: 0;
            background: linear-gradient(5deg, #000000,blueviolet, #A9A9A9, gray);
            background-size: 200% 200%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @media (width >=500px) {
            body {
                padding: 0;
            }
        }

        /* styles.css */

        .login-card {

            /* width: 90%; */
            padding: 0px 20px;
            border-radius: 24px;
            /* background: #ffffff; */
            background-color: #fff;
            /* text-align: center; */
            opacity: 0.9;
            box-shadow: 1px 0px 10px 0px gray;
        }



        @media (width >=500px) {
            .login-card {
                margin: 0;
                width: 400px;
            }
        }



        .login-form {
            width: 100%;

            margin: 0;
            display: grid;
            /* gap: 16px; */
        }
    </style>

</head>

<body>
    <div class="row pb-3 login-card">
        <div class='text-center'>
            <img src="../Images/cmc.jpg" width="150px">
        </div>
        <form action="" method="POST" class="login-form">
            <div class="form-group mt-2">
                <label for="login" class="p-2">Identifient</label>
                <input type="text" name="tlogin" id="login" value="<?= htmlspecialchars($login) ?>" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="Password" class="p-2">Mot de passe</label>
                <input type="password" name="tPassword" id="Password" value="<?= htmlspecialchars($password) ?>" class="form-control" required>
                <p class="text-danger"><?= $erreurpassword ?></p>
            </div>
            <div class="form-group">
                <label for="tAnnee" class="p-2">Année Formation</label>
                <select name="tAnnee" id="tAnnee" class="form-control">
                    <option value="choisir">Choisir Année</option>
                    <?php
                    foreach ($Annees as $an) {
                        $oldanne = explode("/", $Annee);
                        $anneprochaine = $an[0] + 1;
                        if ($oldanne[0] == $an[0]) {
                            echo "<option selected value='" . htmlspecialchars($an[0] . "/" . $anneprochaine) . "'>" . htmlspecialchars($an[0] . "/" . $anneprochaine) . "</option>";
                        } else {
                            echo "<option value='" . htmlspecialchars($an[0] . "/" . $anneprochaine) . "'>" . htmlspecialchars($an[0] . "/" . $anneprochaine) . "</option>";
                        }
                    }
                    ?>
                </select>
                <p class="text-danger"><?= $erreuranne ?></p>
            </div>

            <div class="form-group m-2">
                <input type="submit" name="btnConnecte" class="btn btn-primary w-100" value="Connexion">
            </div>
        </form>
    </div>

</body>

</html>