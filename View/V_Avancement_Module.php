<html>

<head>
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">

    <style>
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

        .title h3 {
            color: blue;
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

    function AddAvanvement(btn) {
        let T_Value = [];
        const btn_checked = document.getElementsByClassName("avc");
        const date = document.getElementById("date").value;

        
        btn.innerHTML="chargement ...";
        btn.disabled=true;
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
                btn.innerHTML="Valider";
        btn.disabled=false;
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

    <div class="row m-3">
        <div class="col-8">
            <div class="d-flex">
                <div class="title w-50">
                    <h3>Avancement Module</h3>
                </div>
                <form method="POST" action='' class="w-50">
                    <div class='form-groupe w-100 d-flex'>
                        <input type='date' name='date' id='date' onchange="GetSeance()" class='form-control' value='<?= $sysdate ?>'>
                        <button style="background: none;border:none;" class="pb-3" name="execl"><img src="../Images/execl.jpeg" style='width: 32px;height: 30px;' alt=""></button>
                    </div>
                </form>
            </div>
            <div>
                <form action="" method="post" id="form" enctype="multipart/form-data" class="d-flex w-100 ">
                    <input type="file" name="execl" class="form-control m-2" id="execl">
                    <input type="submit" value="Importer" id="file" class="btn btn-success m-2" name="import">
                </form>
            </div>
        </div>

        <div class="col-4 p-3 alert alert-info">
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

    <div id="informations">
        <?php GetSeance($sysdate); ?>
    </div>
</body>

</html>