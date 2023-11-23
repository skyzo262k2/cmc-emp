<html>

<head>
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <style>
        .title {
            text-align: center;
        }



        .trinfo {
            background-color: beige;

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

        .row {
            width: 100%;
        }

        .col-6 {
            text-align: center;
        }

        #loader {
            width: 100px;
            height: 100px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
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
            document.getElementById("informations").innerHTML = "<div class='text-center mt-5'><div id='loader'></div><span class='text-primary h4'>chargement ...</span></div>";
        }
    </script>
</head>

<body>
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-4">
                <div class="title">
                    <h3>Taux d'avancement Module</h3>
                </div>
            </div>

            <div class="col-6 d-flex">
                <div class='w-25 p-1'>
                    <select name="taux" id="taux" class="form-control">
                        <option value="50">50%</option>
                        <option value="60">60%</option>
                        <option value="70">70%</option>
                        <option value="80">80%</option>
                        <option value="90">90%</option>
                        <option value="100">100%</option>
                    </select>
                </div>
                <div class='w-50 p-1'>
                    <select name="type" id="type" class="form-control">
                        <option value="tout">Tout</option>
                        <option value="groupe">Change le Groupe Pour Formateur</option>
                        <option value="module">Change le Module Pour Formateur</option>
                    </select>
                </div>
                <div class='w-25 p-1'>
                    <button class="btn btn-primary w-100" onclick="GetTauxAvencement()">Afficher</button>
                </div>
            </div>

        </div>
    </div>

    <div id="informations" class="m-3">


        <div class='text-center m-5'>
            <img src='../Images/nodata.jpg' width="250px" alt='aucun données' />
        </div>

    </div>
</body>

</html>