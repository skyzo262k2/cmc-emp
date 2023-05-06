function aff(parentTr){
        const value_list = [];
        input_fields = document.getElementsByClassName('inputs');
        indice = 0;
        for(const value of parentTr.children){
            value_list.push(value.textContent);
        }
        for(const input of input_fields){
            input.value = value_list[indice];
            indice++;
        }
}