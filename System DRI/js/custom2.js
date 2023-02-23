async function pesquisarEt(registro) {
    // receber a matricula
    var et = document.querySelector('#et')

    var valoret = et.value;
    console.log(valoret)
        //Verificar se o usuario digitou 3 numeros
        if (valoret.length != 0){
            // realizar a requisição
            const dados = await fetch('buscar2.php?et=' + valoret);
            // ler os dados
            
            const resposta = await dados.json();
            console.log(resposta);
            // verificar se retona erro
            if(resposta['erro'] == true){
                //erro
            }else{
                document.getElementById("numserie").value = resposta['dados'].numserie;
            }
        }

}