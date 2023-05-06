<?php
    
    require "../Model/M_Salle.php";
    require "../Model/M_pagination.php";

    session_start();
    if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
        header("location:../Controller/C_Login.php");
    }
    

    $info = "";
    

    if(!isset($_GET['get']))
        $_GET['get']=1;
    $sal= new Salle();
    $sal->CodeEtab = $_SESSION["Etablissement"]["CodeEtb"];

    if (isset($_POST["sup"])){
        $sal->codesalle = $_POST["sup"];
        $sal->Deletesalle();        
    }

    $sal->CodeEtab=$_SESSION['Admin']['CodeEtab'];
    $page=new Pagination();
    
    if(isset($_POST['btnAjouter']))
    {    
            if(!empty($_POST['cdsl']) and !empty($_POST['descrpsl']) and isset($_POST['type']))
            {
                $sal->codesalle=$_POST['cdsl'];
                $sal->descrpsal=$_POST['descrpsl'];
                $sal->type=$_POST['type'];
                $sal->AddSalle();  
            }
    }

    if(isset($_POST['btnModifier']))
    {   

        if(!empty($_POST['cdsl']) and !empty($_POST['descrpsl']) and isset($_POST['type']))
        {
            $sal->codesalle=$_POST['cdsl'];
            $sal->descrpsal=$_POST['descrpsl'];
            $sal->type=$_POST['type'];
            $sal->Updatesalle(); 
        }
    }
    if(isset($_POST['btnSupprimer']))
    {   
        $sal->DeleteAllSalle(); 
    }



    
$tblName = "SL";


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    $_SESSION["rechinfosalle"] = $info;
    if ($info == "") {
        $_SESSION['salles'] = $sal->GetAllSalles();
    } else {
        $sal->connexion();
        $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$sal->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
    }

    echo " <div class='pagi_sup'>

    <div class='pagination'>
       ";
        $salles = $page->Pagination_Btn($_SESSION['salles'], $_GET['get']);
        $page->Pagination_Nb($salles, $_GET['get']);
       
    echo "</div>
    <div class='deleteAll'>
        <form action='' method='post'>
            <input type='submit' value='Supprimer tous' name='btnSupprimer' class='btn btn-primary end-0' onclick='return confirm('Tu es Sure pour Supprimer Tous ?')' id='btnSupprimer'>
        </form>
    </div>

</div>

<div class='table-affiche'>

    <table class='table table-striped table-sm table-bordered'>
        <thead>
            <tr class='table-success'>
                <th scope='col'>code salle</th>
                <th scope='col'>Description salle</th>
                <th scope='col'>Type</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
            <tbody>
                ";

                $page->GetTablePage($_SESSION['salles'], $_GET['get']);
             
            echo "</tbody>
    </table>
</div>";
} else {
    if (isset($_SESSION["rechinfosalle"])) {
        $info = $_SESSION["rechinfosalle"];
        if ($info == "") {
            $_SESSION['salles'] = $sal->GetAllSalles();
        } else {
            $sal->connexion();
            $_SESSION['salles'] = $sal::$cnx->query("call sp_RechercherGlobal('$info','$tblName','$sal->CodeEtab')")->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $_SESSION['salles'] = $sal->GetAllSalles();
    }
    require "../View/V_salle.php";
}

?>