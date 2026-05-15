
<!DOCTYPE html>
<!--
Ícones de svgrepo.com | favicon feito usando Paint
 Autoria de Henrique Blay Barboza  |  RA: 1290482612001
 Confira no GitHub! -> https://github.com/TheBlay/HenriqueBlay-LP420261_P2

-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="filmes.css">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Publicações</title>
</head>

<body><?php
    require_once 'conexao.php';
    include_once 'header.php'; ?>
    <div class='title'>Publicações</div>
        <div class="caixa">
                
            <input type="text" id="nome" name="nome" placeholder="Título da Publicação" required>
            <div id="descricaoContainer">
            
            <label for="descricao">Resumo</label>
            <textarea rows="6" cols="50" id="descricao" name="descricao" placeholder="Resumo" required></textarea>
            </div>    
            
            <select name="tipoPublicacao" id="tipoPublicacao" required> <!--tinha name e id 'tipoPublicacao', revisar todas as ocorrencias para atualizar o nome -->
                <option value="">Gênero...</option>
                <option value="acao">Ação</option>
                <option value="aventura">Aventura</option>
                <option value="comedia">Comédia</option>
                <option value="drama">Drama</option>
                <option value="terror">Terror</option>
                <option value="ficcao">Ficção Científica</option>
                <option value="romance">Romance</option>
                <option value="suspense">Suspense</option>
                <option value="animacao">Animação</option>
                <option value="musical">Musical</option>
            </select>
            <select name="idClassificacao">
                <?php
                $stmt = $conn->query("SELECT idClassificacao, tipoClassificacao FROM tb_classificacao");
                foreach ($stmt as $row) {
                    echo "<option value='{$row['idClassificacao']} '>{$row['tipoClassificacao']}</option>";
                }
                ?>
            </select>
            <div class="operacoes">
                <button type="button" onclick="cadastrarPublicacao()">Cadastrar Publicação</button>
                <button type="button" onclick="carregarFilmes()">Botão Extra</button>
            </div>
        </div>
        <div class="caixa lista" id="listaPublicacoes">

        </div>
    <script>
    //Componentes


    //Elementos
    
   
    lista = document.getElementById('listaPublicacoes');

    function gerarHTML(f) {
        return `<div class="elemento">
                    <h2>${f.nome}</h2> <br>
                    Descrição: ${f.descricao} <br>
                    <span class="displaytipoPublicacao">Gênero: ${f.tipoPublicacao}</span>
                    </div> <hr/>
                `
    }

    function cadastrarPublicacao()
    {
        const tipoPublicacaoSelect = document.getElementById('tipoPublicacao');
        
        const nome = document.getElementById('nome').value;
        const descricao = document.getElementById('descricao').value;
        const tipoPublicacao = tipoPublicacaoSelect.selectedOptions[0].text;

        const body = new URLSearchParams(
            {
                nome: nome,
                descricao: descricao,
                tipoPublicacao: tipoPublicacao
            }
        );
        fetch('filmes.php',
         {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
            body: body.toString()
    })
    .then(response => response.json())
    .then(filme => {
            document.getElementById('listaPublicacoes').innerHTML =
                filme.map(gerarHTML).join('');
                
    })
    .catch(error => console.error('Erro: ', error));
    }


    function carregarFilmes(){
        
        fetch('filmes.php', { method: 'GET'})
            .then(response => response.json())
            .then(filme => {
                document.getElementById('listaPublicacoes').innerHTML =
                filme.map(gerarHTML).join('');
                
                
            })
            .catch(error => console.error('Erro: ', error));
    }

    window.onload = function() {
        carregarFilmes();
    }
</script>
</body>
</html>