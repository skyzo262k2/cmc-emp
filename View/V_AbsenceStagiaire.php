<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Absence Stagiaire</title>

    <style>
        .row {
            width: 100%;
        }

        .title {
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

        .icon {
            width: 30px;
        }

        .buttonvalide {
            text-align: end;
        }
    </style>


    <script>
        function ChangeDate() {
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            document.getElementById("informations").innerHTML = "<div class='text-center m-5'>  <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";

            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_AbsenceStagiaire.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("groupe_select").innerHTML = this.responseText;
                }
            };
            request.send(`date=${date}&seance=${seance}`);

        }

        function ChangeGroupe(grp) {
            const groupe = grp.value;
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            if (groupe != "choisir") {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_AbsenceStagiaire.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        document.getElementById("informations").innerHTML = this.responseText;
                    }
                };
                request.send(`groupe=${groupe}&date=${date}&seance=${seance}`);
            } else {
                document.getElementById("informations").innerHTML = "<div class='text-center m-5'>  <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";

            }
        }

        function tout_checked(chek) {
            // alert(classname)
            let bottons_check = document.getElementsByClassName(chek.value);
            if (chek.checked == true) {
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


        function ChangeJustify(div) {
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            const groupe = document.getElementById("groupe").value;
            const cef = div.children[1].textContent;
            const justify = div.children[0].textContent;
            // alert(cef);
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_AbsenceStagiaire.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`modcef=${cef}&date=${date}&seance=${seance}&justify=${justify}&groupe=${groupe}`);
        }

        function SupprimerAbsence(div) {
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            const groupe = document.getElementById("groupe").value;
            const cef = div.children[1].textContent;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_AbsenceStagiaire.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("informations").innerHTML = this.responseText;
                }
            };
            request.send(`supcef=${cef}&date=${date}&seance=${seance}&groupe=${groupe}`);
        }


        function AddAbsence() {
            let T_Value = [];
            const btn_checked = document.getElementsByClassName("inp_chek");
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            const groupe = document.getElementById("groupe").value;
            const module = document.getElementById("module").value;
            for (i = 0; i < btn_checked.length; i++) {
                if (btn_checked[i].checked == true) {
                    T_Value.push(btn_checked[i].value)
                }
            }
            // console.log(T_Value)
            if (T_Value.length != 0) {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_AbsenceStagiaire.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        document.getElementById("informations").innerHTML = this.responseText;
                    }
                };
                request.send(`add=${T_Value}&date=${date}&seance=${seance}&groupe=${groupe}&module=${module}`);

            }
        }
    </script>
</head>

<body>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-3">
                <div class="title">
                    <h3>Absences des stagiaires</h3>
                </div>
            </div>
            <div class="col-3">
                <div class="form-groupe">
                    <input type="date" name="date" id="date" value='<?= $sysdate ?>' class="form-control" onchange="ChangeDate()">
                </div>

            </div>

            <div class="col-3">
                <div class="form-groupe">
                    <select name="seance" id="seance" class="form-control" onchange="ChangeDate()">
                        <option value="choisir">Choisir Seance</option>
                        <option value="1">8:30H - 11:00</option>
                        <option value="2">11:00H - 13:30</option>
                        <option value="3">13:30H - 16:00</option>
                        <option value="4">16:00H - 18:30</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-groupe" id="groupe_select">
                    <select name="groupe" id="groupe" class="form-control" onchange="ChangeGroupe(this)">
                        <option value="choisir">Choisir Groupe</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div id="informations" class="m-2">

        <div class='text-center m-5'>
            <img src='../Images/nodata.jpg' width="250px" alt='aucun données' />
        </div>


    </div>
    <!-- </form> -->
</body>

</html>