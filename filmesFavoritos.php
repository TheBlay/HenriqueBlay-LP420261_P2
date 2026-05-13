
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="filmes.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Filmes</title>
</head>

<body><?php  include_once 'header.php' ?>
    <div class='title'>Filmes</div>
        <div class="caixa">
                
            <input type="text" id="nome" name="nome" placeholder="Nome do filme" required>
            <div id="descricaoContainer">
            
            <textarea rows="6" cols="50" id="descricao" name="descricao" placeholder="Descrição do Filme" required></textarea>
            </div>    
            
            <select name="genero" id="genero" required>
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
            
            <button type="button" onclick="cadastrarFilme()">Cadastrar Filme</button>
            <button type="button" onclick="carregarFilmes()">Exibir Filmes</button>
        </div>
        <div class="caixa lista" id="listaFilmes">

        </div>
    <script>
    //Componentes


    //Elementos
    
   
    lista = document.getElementById('listaFilmes');

    function gerarHTML(f) {
        return `<div class="elemento">
                    <h2>${f.nome}</h2> <br>
                    Descrição: ${f.descricao} <br>
                    <span class="displayGenero">Gênero: ${f.genero}</span>
                    </div> <hr/>
                `
    }

    function cadastrarFilme()
    {
        const generoSelect = document.getElementById('genero');
        
        const nome = document.getElementById('nome').value;
        const descricao = document.getElementById('descricao').value;
        const genero = generoSelect.selectedOptions[0].text;

        const body = new URLSearchParams(
            {
                nome: nome,
                descricao: descricao,
                genero: genero
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
            document.getElementById('listaFilmes').innerHTML =
                filme.map(gerarHTML).join('');
                
    })
    .catch(error => console.error('Erro: ', error));
    }


    function carregarFilmes(){
        
        fetch('filmes.php', { method: 'GET'})
            .then(response => response.json())
            .then(filme => {
                document.getElementById('listaFilmes').innerHTML =
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