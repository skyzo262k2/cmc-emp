<?php

session_start();
require '../Model/M_ProfilFormateur.php';
if(!isset($_SESSION["userFormateur"]))
        header("location:../Controller/C_Login.php");

$prf=new ProfileFormateur();
$mat=$_SESSION["userFormateur"]["Matricule"];
$nom=$_SESSION["userFormateur"]["Nom"];
$prenom=$_SESSION["userFormateur"]["Prenom"];

if(isset($_POST['valider'])){
        if($_POST['MotN']==$_POST['MotC'])
                $prf->Modifier($mat,$_POST['motA'],$_POST['MotN']);
}

require '../View/V_ProfilFormateur.php';
