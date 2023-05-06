<html>

<head>
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <style>
        .inp2 {
            box-shadow: 0px 0px 5px 0px gray;
            border: none;
            border-radius: 5px;
            height: 37px;

        }

        .inp1 {
            box-shadow: 0px 0px 5px 0px gray;

            border: none;
            border-radius: 5px;
            padding-left: 10px;
            height: 37px;

        }


        .title {
            text-align: center;
            margin: 10px;
        }



        .trinfo {
            background-color: beige;

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

        .row {
            width: 100%;
        }
        .col-6{
            text-align: center;
        }
    </style>

    <script>
        function GetTauxAvencement() {
            const taux = document.getElementById("taux").value;
            const type = document.getElementById("type").value;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_TauxAvancemant_affectation.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`taux=${taux}&type=${type}`);
        }
    </script>
</head>

<body>
    <div class="header">
        <div class="title">
            <h4>Taux d'avancement Module</h4>
        </div>
        <div class="row">
            <div class="col-3"> </div>

            <div class="col-6">
                <select name="taux" id="taux" class="inp1">
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
                <select name="type" id="type" class="inp2">
                    <option value="tout">Tout</option>
                    <option value="groupe">Change le Groupe Pour Formateur</option>
                    <option value="module">Change le Module Pour Formateur</option>
                </select>
                <button class="btn btn-primary" onclick="GetTauxAvencement()">GO</button>

            </div>
            <div class="col-3"> </div>

        </div>
    </div>

    <div id="informations" class="m-3">


    </div>
</body>

</html>