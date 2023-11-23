<html>

<head>
    <link rel="stylesheet" type="text/css" href="../Css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Css/tooltips.min.css">
</head>
<style>
    a {
        text-decoration: none;
    }

    .NameSalle {
        text-align: center;
        font-size: 15px;
        font-weight: 700;
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

    body {
        overflow-x: hidden;
    }
    
</style>


<body>
    <div class="row m-1">
        <table class="table table-striped table-sm table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="bg-light text-dark text-center pt-3 salle">Salles</th>
                    <th colspan="4" class="bg-light text-dark text-center">Lundi</th>
                    <th colspan="4" class="bg-light text-dark text-center">Mardi</th>
                    <th colspan="4" class="bg-light text-dark text-center">Mecredi</th>
                    <th colspan="4" class="bg-light text-dark text-center">Jeudi</th>
                    <th colspan="4" class="bg-light text-dark text-center">Vendredi</th>
                    <th colspan="4" class="bg-light text-dark text-center">Samedi</th>
                </tr>
                <tr>
                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>

                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>

                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>

                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>

                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>

                    <th scope="col" class="bg-light text-dark text-center">S1</th>
                    <th scope="col" class="bg-light text-dark text-center">S2</th>
                    <th scope="col" class="bg-light text-dark text-center">S3</th>
                    <th scope="col" class="bg-light text-dark text-center">S4</th>
                </tr>
            </thead>
            <?php
            echo $Html_Table;
            ?>
        </table>
    </div>
</body>

</html>