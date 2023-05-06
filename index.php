<?php
session_start();
if (isset($_SESSION["Admin"])) {
    header("location:./Controller/C_Home.php");
}
else
header("location:./Controller/C_Login.php");
?>