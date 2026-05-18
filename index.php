<?php
require_once 'controller/conexao.php';
echo "<br>";
$selectAutores = $pdo->query("SELECT * FROM tb_autores");
while ($row = $selectAutores->fetch()) {
    echo $row['nomeAutor'] . "<br>";
}
$selectConvidados = $pdo->query("SELECT d.descricao AS evento, c.nomeConvidado AS convidado
FROM tb_divulgacao d 
JOIN tb_divulgacao_convidado dc ON d.idDivulgacao = dc.idDivulgacao
JOIN tb_convidados c ON dc.idConvidado = c.idConvidado;");
while ($row = $selectConvidados->fetch()) {
    echo $row['evento'] . " | Convidados: " . $row['convidado'] . "<br>";
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
            <h2 style="color: var(--cor-fonte-escuro)">Lista de Publicações Atuais</h2>
            
    </div>
	
        <div class="caixa lista" id="listaPublicacoes">
        <?php


// O id também pode vir de um $_GET['id']
$idDivulgacao = 2; 

$sql = "SELECT 
            d.descricao, 
            c.nomeConvidado
        FROM 
            tb_divulgacao_convidado dc
        INNER JOIN 
            tb_divulgacao d ON dc.idDivulgacao = d.idDivulgacao
        INNER JOIN 
            tb_convidados c ON dc.idConvidado = c.idConvidado
        ORDER BY 
            d.nome_evento ASC";

// 4. Executa a busca de forma segura
$stmt = $pdo->query($sql);
$resultados = $stmt->fetchAll();

// 5. Exibe os dados na tela de forma organizada
if (!empty($resultados)) {
    // Como o nome do evento é igual em todas as linhas, pegamos o da primeira linha
    $evento = htmlspecialchars($resultados[0]['descricao']);
    echo "<h2 class='tituloEvento'>Evento: {$evento} </h2>";
    echo "<h3>Lista de Convidados:</h3>";
    echo "<ul class='listaConvidados'>";
    
    // Fazemos um loop para listar apenas os convidados
    foreach ($resultados as $linha) {
        $convidado = htmlspecialchars($linha['nomeConvidado']);
        echo "<li> {$convidado}</li>";
    }
    
    echo "</ul>";
} else {
    echo "<p>Nenhum convidado encontrado para esta divulgação (ou o evento não existe).</p>";
}
?>

        </div>

    <script>

     const listaP = document.getElementById('listaPublicacoes');

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