<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Bootstrap/css/bootstrap.min.css">
    <script src="../Css/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/export_download.js"></script>
    <!-- <script src="../JS/Remplir.js"></script> -->
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <select name="page_nom" id="select1" onchange="getExcelFile()">
            <option value="choisir">Choisir Un Tableau : </option>
            <?php foreach ($rules["names"] as $code_tbl => $table_name) : ?>
                <option value="<?= $code_tbl ?>"><?= $table_name ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <a href="#" download=""><button type="button" disabled class="inputs">IMPORT .xlsx (vide)</button></a>
        <br><br>
        <input type="file" name="tExport" disabled class="inputs">
        <br><br>
        <?php //<input hidden type="text" value="fl" name="page_nom"> 
        ?>
        <button type="submit" name="btnExporter" value="Exporter" disabled class="inputs">goo</button>
        <br>
    </form>
    <form action="" method="POST">
        <?php
        $data = $page->Pagination_Btn($_SESSION['Export_Data'], $_GET['get']);
        $page->Pagination_Nb($data, $_GET['get']);
        ?>
    </form>
    <table class="table table-striped table-sm table-bordered">
        <tbody>
            <?php
            $page->GetTablePage_export($_SESSION['Export_Data'], $_GET['get']);
            ?>
        </tbody>
    </table>
</body>

</html>