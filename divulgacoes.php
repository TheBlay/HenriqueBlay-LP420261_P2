
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
    <link rel="stylesheet" href="divulgacoes.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divulgações</title>
</head>

<body>
    <?php
    require_once 'conexao.php';
    include_once 'header.php'; 
    ?>
    <div class='title'>Divulgação de Publicações</div>
        <div class="caixa">
                
            <div id="descricaoContainer">
<!-- Inserir exibição das Divulgações aqui com stmt
$stmt = $pdo->query("SELECT * FROM tb_divulgacoes");
while ($row = $stmt->fetch()) {
    echo $row['nomeAutor'] . "<br>";
} 
-->
            </div>    
            
            <button type="button" onclick="carregarFilmes()">Exibir Filmes</button>
        </div>
        <div class="caixa lista" id="listaDivulgacoes">

        </div>
    <script>
    //Componentes


    //Elementos
    
   
    lista = document.getElementById('listaDivulgacoes');

    function gerarHTML(f) {
        return `<div class="elemento">
                    <h2>${f.nome}</h2> <br>
                    Descrição: ${f.descricao} <br>
                    <span class="displayGenero">Gênero: ${f.genero}</span>
                    </div> <hr/>
                `
    }



    function carregarFilmes(){
        
        fetch('filmes.php', { method: 'GET'})
            .then(response => response.json())
            .then(filme => {
                document.getElementById('listaDivulgacoes').innerHTML =
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

