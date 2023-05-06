function getExcelFile(){
    const table_names = {
    "fl" : "Filieres",
    "gp" : "Groupes",
    "fr" : "Formateurs",
    "md" : "Modules",
    "nv" : "Niveaux",
    "sl" : "Salles",
    "sc" : "Secteurs"
    }
    select_input = document.getElementById('select1');
    inputs = document.getElementsByClassName('inputs');
    bool = (select_input.value != "choisir") ? false : true;
    for(input of inputs){
        input.disabled = bool;
    }
    if(!(bool)){
        inputs[0].parentNode.href="../default/EX_" + table_names[select_input.value] + ".xlsx";
    }
}