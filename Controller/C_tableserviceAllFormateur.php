<?php

require "../Model/M_Connexion.php";
require "../Model/Word.php";


session_start();
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"]["Poste"] == "Surveille") {
    header("location:../Controller/C_Login.php");
}

$cnx=new Connexion();
$codetab=$_SESSION['Etablissement']['CodeEtb'];
$cnx->connexion();
$anne=explode('/',$_SESSION['Annee']); 


if(isset($_GET['tous']))
{  
    $af= new Affectation();
    $req3="CALL Sp_affecter_de_fromateurword('$codetab','$anne[0]');";
    $LESFomateurs=$cnx::$cnx->query($req3)->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($LESFomateurs as $mat)
    {   
        $mat_F=$mat['Matricule'];
        $nom_F=$mat['Nom'];
        $req3="CALL SP_ModuleAffecter_Formateur('$mat_F','$codetab','$anne[0]');";

        $InfoHeures = $cnx::$cnx->query("select sum(m.s1),sum(m.s2)
            from groupe g inner join  affectmodule af on g.CodeGrp= af.Groupe 
            inner join Modules m on af.ModuleCode = m.CodeMd 
            where g.CodeFlr = m.CodeFlr and af.Matricule ='$mat_F'
            and af.CodeEtab='$codetab' and af.AnneeFr='$anne[0]'")->fetch();

        $mass=$InfoHeures[0]+$InfoHeures[1];
        $nbparsemaine=$mass/$_SESSION["Etablissement"]["Sem_Annee"];
        $moduleFomateur=$cnx::$cnx->query($req3)->fetchAll(PDO::FETCH_ASSOC);

        $af->Cadre($moduleFomateur,$nom_F,$_SESSION['Annee'],$_SESSION['Etablissement']['Ville'],"$mass","$InfoHeures[0]","$InfoHeures[1]",$nbparsemaine);
    }

    $af->save('test');
    header("Location: ./C_affectationModule.php");
}

?>