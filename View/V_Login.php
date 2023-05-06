<html>

<head>
    <title>Login</title>

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

        a,
        input[type='submit'] {
            cursor: pointer;
        }

        body {
            display: grid;
            place-items: center;
            margin: 0;
            animation: pan 6s infinite alternate linear;
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
            background-color: #f9f9f9;
            /* text-align: center; */
            opacity: 0.8;
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

        .login-form>a {
            color: #216ce7;
        }



        .login-form>input,
        select {
            height: 56px;

            border-radius: 8px;
            font-size: larger;

        }


        .login-form input,
        select {

            border: 2px solid #ebebeb;
            outline: 1px solid gray;


        }



        .login-form input[type='submit'] {
            border: 0;
            background: #216ce7;
            height: 56px;
            color: #f9f9f9;
            font-weight: 600;

        }

        label {
            margin-bottom: 10px;
            padding-left: 10px;
        }

        h1 {
            margin-top: 20px;
        }

        img {
            border-radius: 50%;
            /* opacity: 0.7; */
        }

        /* .login-card{
            opacity: 0.7;
        } */

        h1 {
            color: blue;
            /* font-size: 2em; */
            margin-bottom: 25px;
            animation: slideInFromTop 1s ease-in-out;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-60%);
            }

            to {
                transform: translateY(0%);
            }
        }

    </style>

</head>

<body>
    <div class="row">

        <div class="col-7">
            <img src="../Images/logo.jpg" width="85%">
        </div>

        <div class="col-4 login-card m-4">

            <center>
                <h1>Bienvenue</h1>
            </center>
            <form action="" method="POST" class="login-form">

                <label for="login"><b>Login</b></label>
                <input type="text" name="tlogin" id="login" value="<?php echo $login ?>" required><br>
                <p style="color: red;"><?php echo $erreurlogin
                                        ?></p>


                <label for="Password"><b>Password</b></label>
                <input type="password" name="tPassword" id="Password" value="<?php echo $password ?>" required><br>



                <label for="tAnnee"><b>Année Formation</b></label>
                <select class="inputs" name="tAnnee" id="tAnnee">
                    <option value="choisir">Choisir Année</option>
                    <?php
                    foreach ($Annees as $an) {
                        $oldanne = explode("/", $Annee);
                        $anneprochaine = $an[0] + 1;
                        if ($oldanne[0] == $an[0]) {
                            echo "<option selected value='$an[0]/$anneprochaine'>$an[0]/$anneprochaine</option>";
                        } else {
                            echo "<option value='$an[0]/$anneprochaine'>$an[0]/$anneprochaine</option>";
                        }
                    }
                    ?>

                </select>
                <p style="color: red;"><b><?php echo $erreuranne
                                            ?></b></p>
                <p style="color: red;"><b><?php echo $erreurpassword
                                            ?></b></p>


                <input type="submit" name="btnConnecte" value="Connecte">
            </form>
        </div>
    </div>

</body>

</html>