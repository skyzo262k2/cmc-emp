<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Absence Formateur</title>

    <style>
        .row {
            width: 95%;
        }

        .title {
            text-align: center;
        }

        .title h3 {
            color: blue;
            /* font-size: 2em; */
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

        .col-4 {
            text-align: center;
        }

        label {
            font-size: 20px;
            font-weight: 600;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .buttonvalide {
            text-align: end;
        }
    </style>


    <script>
        function ChangeDate() {
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            if (date != "" && seance != "choisir") {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_AbsenceFormateur.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        document.getElementById("informations").innerHTML = this.responseText;
                    }
                };
                request.send(`date=${date}&seance=${seance}`);
            } else {
                document.getElementById("informations").innerHTML = "<div class='text-center m-5'>  <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />  </div>";
            }

        }

    


        function tout_checked(chek) {
            let bottons_check = document.getElementsByClassName("checked_input");
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
            const mat = div.children[1].textContent;
            const justify = div.children[0].textContent;
            // alert(cef);
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_AbsenceFormateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("table_info").innerHTML = this.responseText;
                }
            };
            request.send(`modmat=${mat}&date=${date}&seance=${seance}&justify=${justify}`);
        }

        function SupprimerAbsence(div) {
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            const mat = div.children[1].textContent;
            var request = new XMLHttpRequest();
            request.open('POST', '../Controller/C_AbsenceFormateur.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    document.getElementById("table_info").innerHTML = this.responseText;
                }
            };
            request.send(`supmat=${mat}&date=${date}&seance=${seance}`);
        }


        function AddAbsence() {
            let T_Value = [];
            const btn_checked = document.getElementsByClassName("inp_chek");
            const date = document.getElementById("date").value;
            const seance = document.getElementById("seance").value;
            for (i = 0; i < btn_checked.length; i++) {
                if (btn_checked[i].checked == true && btn_checked[i].disabled == false) {
                    T_Value.push(btn_checked[i].value)
                }
            }
            if (T_Value.length != 0) {
                var request = new XMLHttpRequest();
                request.open('POST', '../Controller/C_AbsenceFormateur.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if (this.status == 200 && this.readyState == 4) {
                        document.getElementById("informations").innerHTML = this.responseText;
                    }
                };
                request.send(`add=${T_Value.join("**")}&date=${date}&seance=${seance}`);
            }
        }
    </script>
</head>

<body>



    <div class="container-fluid">
        <div class="row m-5">
            <div class="col-4">
                <div class="title">
                    <h3>Absences des formateurs</h3>
                </div>
            </div>
            <div class="col-3">
                <input type="date" name="date" id="date" value='<?= $sysdate ?>' class='form-control' onchange="ChangeDate()">
            </div>
            <div class="col-3">
                <select name="seance" id="seance" class='form-control' onchange="ChangeDate()">
                    <option value="choisir">Choisir Seance</option>
                    <option value="1">8:30H - 11:00</option>
                    <option value="2">11:00H - 13:30</option>
                    <option value="3">13:30H - 16:00</option>
                    <option value="4">16:00H - 18:30</option>
                </select>
            </div>
        </div>
    </div>
    <div id="informations">
        <div class='text-center m-5'>
            <img src='../Images/nodata.jpg' width='250px' alt='aucun données' />
        </div>
    </div>
</body>

</html>