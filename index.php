<?php
require_once 'conexao.php';
echo "<br>";
$stmt = $pdo->query("SELECT * FROM tb_autores");
while ($row = $stmt->fetch()) {
    echo $row['nomeAutor'] . "<br>";
}

?>
<!--

Ícones de svgrepo.com | favicon feito usando Paint
 Autoria de Henrique Blay Barboza  |  RA: 1290482612001
 Confira no GitHub! -> https://github.com/TheBlay/HenriqueBlay-LP420261_P2

b) O modelo propõe a “Divulgação” de diversas
“Publicações”.
c) Entenda uma publicação, por exemplo, como um
livro que está sendo publicado e que há um evento de
divulgação deste livro.
d) Os “Autores” possuem tipos de classificação como
Coautores, Revisores, etc.
-->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Publicações</title>
</head>


<body>
<?php  include_once 'header.php'; ?>
<hr/><div class='title'>Publicações Atuais</div>
	<div class="caixa">
            <input type="text" id="nome" name="nome" placeholder="Nome do Produto">
            <textarea rows="6" cols="50 id="descricao" name="descricao" placeholder="Descrição do Produto"></textarea>
            <input type="number" id="preco" name="preco" type="number" step="0.01" placeholder="Preço do Produto">
            <button onclick="cadastrarProduto()">Adicionar produto</button>
            
    </div>
	
        <div class="caixa lista" id="listaProdutos"></div>

    <script>

     const listaP = document.getElementById('listaProdutos');

         function cadastrarProduto()
        {
             const nome = document.getElementById('nome').value;
             const descricao = document.getElementById('descricao').value;
             const preco = document.getElementById('preco').value;

             const body = new URLSearchParams({
                nome: nome,
                descricao: descricao,
                preco: preco
            });
            fetch('produtos.php', 
            {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: body.toString()
                })
                .then(response => response.json())
                .then(produto => {
                    // Atualiza o conteúdo da div com a lista atualizada; tb usado no carregarProduto
                    listaProdutos.innerHTML =
                    produto.map(p => `<div class="elemento">Produto: <br>
                    Nome: ${p.nome} <br>
                    Descrição: ${p.descricao} <br>
                    Preço: R$ ${p.preco} </div><hr/>
                `).join('');
                })
                .catch(error => console.error('Erro:', error));

                
        }

        function carregarProdutos()
         { //Exibir
            fetch('produtos.php', { method: 'GET' })
                .then(response => response.json())
                .then(produto => {
                    document.getElementById('listaProdutos').innerHTML =
                    produto.map(p => `<div class="elemento">Produto: <br>
                    Nome: ${p.nome} <br>
                    Descrição: ${p.descricao} <br>
                    Preço: R$ ${parseFloat(p.preco)} </div><hr/>
                `).join('');
                })
                .catch(error => console.error('Erro ao carregar:', error));
         }
        
        window.onload = function() {
            carregarProdutos();
        }
        

</script>
</body>

</html>