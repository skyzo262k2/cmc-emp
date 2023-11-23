<?php
session_start();
if (isset($_SESSION["Admin"])) {
    header("location:./Controller/Application");
}
else
header("location:./Controller/Connexion");
?>