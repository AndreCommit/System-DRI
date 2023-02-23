

async function pesquisarid(registro) {
    // receber a matricula
    var id = document.querySelector('#id')

    var valorid = id.value;
    console.log(valorid)
        //Verificar se o usuario digitou 3 numeros
        if (valorid.length != 0){
            // realizar a requisição
            const dados = await fetch('buscar.php?id=' + valorid);
            // ler os dados
            
            const resposta = await dados.json();
            console.log(resposta);
            // verificar se retona erro
            if(resposta['erro'] == true){
                //erro
            }else{
                if(resposta['dados'].status == "registrado") {
                    alert("Esse chamado já foi Registrado.");
                } else {
                document.getElementById("et").value = resposta['dados'].et;
                document.getElementById("numserie").value = resposta['dados'].numserie;
                document.getElementById("motivo").value = resposta['dados'].motivo;
                document.getElementById("usuario").value = resposta['dados'].usuario;
                document.getElementById("status").value = resposta['dados'].status;
            }
        }
    }
}
