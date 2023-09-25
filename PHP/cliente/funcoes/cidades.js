let idEstado = document.getElementById('id_estado');

idEstado.onchange = function (){
        let idCidade = document.getElementById('id_cidade');
        let valor = idEstado.value;
        fetch("funcoes/cidades.php?id_estado=" + valor)
        .then (Response =>{
            return Response.text();
        })
        .then(texto =>{
            idCidade.innerHTML=(texto);
        });
}

   