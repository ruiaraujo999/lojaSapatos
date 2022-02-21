function removerCarrinhos(element){
    var removerProduto  = document.querySelectorAll('.artigos');
    var removerProdutos = document.querySelectorAll('.artigo');

    for(var i = 0; i < removerProduto.length; i++){
        if ((removerProduto[i].dataset.pro == element.dataset.pro) && 
            (removerProduto[i].dataset.client == element.dataset.client) &&
            (removerProduto[i].dataset.tam == element.dataset.tam)){
                removerProduto[i].remove();
        }
    }

    for(var i = 0; i < removerProdutos.length; i++){
        if ((removerProdutos[i].dataset.pro == element.dataset.pro) &&
            (removerProdutos[i].dataset.client == element.dataset.client) &&
            (removerProdutos[i].dataset.tam == element.dataset.tam)){
                    removerProdutos[i].remove();
        }
    }    

    removerBD(element.dataset.client, element.dataset.pro, element.dataset.tam);
}

function removerBD(cliente, produto_id, tamanho){
    let xhr = new XMLHttpRequest(); 
    xhr.open('GET','ajax/removerCarrinho.php?cliente_id='+cliente+'&produto_id='+produto_id+'&tamanho='+tamanho,true);
    xhr.send();
}
