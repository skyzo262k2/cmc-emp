<?php

require "../Model/M_Export.php";
require_once 'SimpleXLSX.php';
require "../Model/M_pagination.php";

use Shuchkin\SimpleXLSX;

session_start();
if (!isset($_SESSION["Admin"])) {
    header("location:../Controller/C_Login.php");
}

if (!isset($_GET['get'])) {
    $_GET['get'] = 1;
}

if (!isset($_SESSION['Export_Data'])) {
    $_SESSION['Export_Data'] = [];
}

$page = new Pagination();

$rules = [
    "fl" => ["/^.{0,20}$/", "/^.{0,100}$/", "/^.{1,15}$/", "/^.{1,15}$/"],
    "gp" => ["/^.{1,15}$/", "/^.{1,15}$/", "/^\d{1}$/", "/^(O|N)$/"],
    "fr" => ["/^.{1,15}$/", "/^\w{1,25}$/", "/^\w{1,25}$/", "/^(P|V)$/", "/^(\d){1,3}(,(\d)+)?$/"],
    "md" => ["/^.{1,15}$/", "/^.{0,20}$/", "/^\d{1}$/", "/^.{0,150}$/", "/^\d{1,2}/", "/^\d{1,2}/", "/^\d{1,2}/", "/^\d{1,2}/"],
    "nv" => ["/^\w{1,10}$/", "/^.{1,25}$/"],
    "sl" => ["/^\w{1,15}$/", "/^.{1,50}$/", "/^(ATELIER|SALLE)$/"],
    "sc" => ["/^\w{1,15}$/", "/^.{0,50}$/"],
    "names" => [
        "fl" => "Filieres",
        "gp" => "Groupes",
        "fr" => "Formateurs",
        "md" => "Modules",
        "nv" => "Niveaux",
        "sl" => "Salles",
        "sc" => "Secteurs"
    ]
];

if (isset($_FILES['tExport']['name']) and (isset($_POST['page_nom']))) {
    if (($_FILES['tExport']['name'] != "") and ($_POST['page_nom'] != "choisir")) {
        $path_filename_ext = "../excelformats/" . $_FILES['tExport']['name'];
        if (file_exists($path_filename_ext)) {
        } else {
            move_uploaded_file($_FILES['tExport']['tmp_name'], $path_filename_ext);
        }
        if ($xlsx = SimpleXLSX::parse($path_filename_ext)) {
            if ($values = $xlsx->rows()) {
                $rows_error = 0;
                $column_num = count($rules[$_POST['page_nom']]);
                $doc_col_num = 0;
                foreach ($values[0] as $col) {
                    if (!empty($col)) {
                        $doc_col_num++;
                    } else {
                        break;
                    }
                }
                if ($column_num == $doc_col_num) {
                    $rows_num = count($values);
                    $result = [];
                    for ($i = 0; $i < $rows_num; $i++) {
                        $error = false;
                        for ($j = 0; $j < $doc_col_num; $j++) {
                            if (!preg_match($rules[$_POST['page_nom']][$j], $values[$i][$j])) {
                                $error = true;
                            }
                        }
                        if ($error) {
                            $rows_error++;
                            continue;
                        } else {
                            array_push($result, array_slice($values[$i], 0, $column_num));
                        }
                    }
                    $export = new Export($result, "{$_POST['page_nom']}");
                    if ($rapport = $export->AddAll()) {
                        echo "<script>alert('executed with success')</script>";
                        echo "<br>Number of Rows added to the DB : " . $rapport[0] . "<br>";
                        echo "Number of Rows with a problem (not added) : " . ($rapport[1] + $rows_error) . "<br>";
                        $_SESSION['Export_Data'] = $rapport["result"];
                    } else {
                        echo "<script>alert('Inserting the Excel data was met with a problem.')</script>";
                    }
                } else {
                    echo "<script>alert('Le Fichier .xlsx est Incorrect.')</script>";
                }
            } else {
                echo "<script>alert('Le Fichier .xlsx est vide d\'enregstrements.')</script>";
            }
        } else {
            echo "<script>alert('Parsing the Excel data was met with a problem.')</script>";
        }
        unlink($path_filename_ext);
    } else {
        echo "<script>alert('Veullez inserter un Fichier et/ou choisir un table.')</script>";
    }
}
require "../View/V_Export.php";
