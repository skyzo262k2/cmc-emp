<html>

<head>
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">

    <style>
        /* #form {
            display: flex;
            flex-direction: row;
            align-items:flex-start;
        }

        #execl {
            padding: 10px;
            margin: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #file {
            padding: 10px 20px;
            background-color:blue;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #file:hover {
            background-color: #3e8e41;
        } */

        .color {
            width: 20px;
            height: 20px;
        }

        .green {
            background-color: green;
        }

        .red {
            background-color: red;
        }

        .yellow {
            background-color: yellow;
        }

        .c1 {
            margin: 5px;
            display: flex;
        }

        .c2 {
            margin: 5px;
            display: flex;
        }

        .c3 {
            margin: 5px;
            display: flex;
        }

        .color {
            border: 1px solid black;
            margin-right: 10px;
        }

        .divColor {
            font-weight: 500;
        }

        .col-3 {
            padding-top: 50px;
        }

        .col-8 {
            text-align: center;
            align-items: center;
        }

        .inp {
            border-radius: 5px;
            margin-left: 5px;
            border: 1px solid black;
            padding-left: 10px;
            width: 200px;
            height: 30px;

        }

        .trinfo {
            background-color: beige;

        }

        .btn_val {
            text-align: center;
        }

        .title h4 {
            color: blue;
            /* font-size: 2em; */
            margin-bottom: 25px;
            animation: slideInFromTop 1s ease-in-out;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }

        #date {
            box-shadow: 0px 0px 5px 0px gray;
            border: none;
            border-radius: 5px;
            height: 37px;
        }
    </style>

</head>


<script>
    function Selection_Tout() {
        let bottons_check = document.getElementsByClassName("avc");
        if (document.getElementById("tout").checked == true) {
            for (i = 0; i < bottons_check.length; i++) {
                bottons_check[i].checked = true;
            }
        } else {
            for (i = 0; i < bottons_check.length; i++) {
                if (bottons_check[i].disabled == false)
                    bottons_check[i].checked = false;
            }
        }
    }

    function GetSeance() {
        const getdate = document.getElementById("date").value;
        const request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Avancement_Module.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                document.getElementById("informations").innerHTML = this.responseText;
            }
        };
        request.send(`getdate=${getdate}`);
    }

    function AddAvanvement() {
        let T_Value = [];
        const btn_checked = document.getElementsByClassName("avc");
        const date = document.getElementById("date").value;

        for (i = 0; i < btn_checked.length; i++) {
            if (btn_checked[i].checked == true && btn_checked[i].disabled == false) {
                T_Value.push(btn_checked[i].value)
            }
        }
        const request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Avancement_Module.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                document.getElementById("informations").innerHTML = this.responseText;
            }
        };
        request.send(`add=${T_Value}&date=${date}`);
    }

    function DeleteAvanvement(div) {
        let chaine = div.children[1].value;
        // alert(chaine)
        const request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Avancement_Module.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                document.getElementById("informations").innerHTML = this.responseText;
            }
        };
        request.send(`delete=${chaine}`);
    }
</script>


<body>

    <form method="POST">
        <div class="row m-3">
            <div class="col-8">
                <div class="title">
                    <h4>Avancement Module</h4>
                </div>
                <div class='form-groupe'>
                    <!-- <label for='date'>Choisir la date :</label> -->
                    <input type='date' name='date' id='date' onchange="GetSeance()" class='inp' value='<?php echo $sysdate ?>'>
                    <!-- <button type="button"  class="btn btn-primary">Get Seance</button> -->
                    <button style="background: none;border:none;" name="execl"><img src="../Images/execl.jpeg" style='width: 32px;height: 30px;' alt="not found"></button>

                </div>
            </div>

            <div class="col-4">
                <div class="divColor">
                    <div class="c1">
                        <div class="color green"></div>
                        <span>Avancement < 90%</span>
                    </div>

                    <div class="c2">
                        <div class="color yellow"></div>
                        <span>Avancement entre 90% et 100% </span>
                    </div>

                    <div class="c3">
                        <div class="color red"></div>
                        <span> Avancement >= 100%</span>
                    </div>
                </div>
            </div>

        </div>

    </form>
    <form action="" method="post" id="form" enctype="multipart/form-data">
        <input type="file" name="execl" id="execl">
        <input type="submit" value="Import" id="file" name="import">
    </form>

    <div id="informations">
        <?php GetSeance($sysdate); ?>
    </div>
</body>

</html>