<?php
require_once 'controller/conexao.php';
require_once 'model/Divulgacao.php';
require_once 'model/Publicacao.php';

$publicacao = new Publicacao($conn);
$publicacoes = $publicacao->getTodasPublicacoes();

$divulgacao = new Divulgacao($conn);
$eventos = $divulgacao->getEventosComConvidados();



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
    <style>
        .publicacao-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .publicacao-item h3 {
            margin-top: 0;
            color: var(--cor-primaria, #007bff);
        }

        .publicacao-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
            font-size: 14px;
        }

        .meta-grupo {
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }

        .meta-label {
            font-weight: bold;
            color: #666;
        }

        .meta-valor {
            color: #333;
            margin-top: 5px;
        }
    </style>
</head>


<body>
<?php  include_once 'header.php'; ?>
<hr/><div class='title'>Publicações Atuais</div>
	<div class="caixa">
            <h2 style="color: var(--cor-fonte-escuro)">Lista de Publicações Atuais</h2>
            
    </div>

    <div class="caixa lista-publicacoes">
    <h2>Publicações Cadastradas</h2>
    <div id="listaPublicacoes"></div>
</div>
        

        </div>

    <script>

     const listaP = document.getElementById('listaPublicacoes');

     function gerarHTMLPublicacao(pub) {
        const tipoNome = pub.tipo?.nomeTipo || 'N/A';
        const autorNome = pub.autor?.nomeAutor || 'Sem autor';
        const autorEmail = pub.autor?.email || '';
        const divulgacao = pub.divulgacao?.descricao || 'Sem divulgação';
        const divulgacaoLocal = pub.divulgacao?.local || '';

        return `
            <div class="publicacao-item">
                <h3>${pub.titulo}</h3>
                <p><strong>Resumo:</strong> ${pub.resumo}</p>
                
                <div class="publicacao-meta">
                    <div class="meta-grupo">
                        <div class="meta-label">Tipo de Publicação</div>
                        <div class="meta-valor">${tipoNome}</div>
                    </div>
                    
                    <div class="meta-grupo">
                        <div class="meta-label">Data</div>
                        <div class="meta-valor">${pub.dataPublicacao || 'N/A'}</div>
                    </div>
                    
                    <div class="meta-grupo">
                        <div class="meta-label">Autor</div>
                        <div class="meta-valor">${autorNome}</div>
                        ${autorEmail ? `<div style="font-size: 12px; color: #666;">${autorEmail}</div>` : ''}
                    </div>
                    
                    <div class="meta-grupo">
                        <div class="meta-label">Divulgação</div>
                        <div class="meta-valor">${divulgacao}</div>
                        ${divulgacaoLocal ? `<div style="font-size: 12px; color: #666;">${divulgacaoLocal}</div>` : ''}
                    </div>
                </div>
            </div>
        `;
    }

         function carregarPublicacoes() {
        // Buscar publicações do servidor
        fetch('api_publicacoes.php', { method: 'GET' })
            .then(response => response.json())
            .then(publicacoes => {
                const html = publicacoes.map(pub => gerarHTMLPublicacao(pub)).join('');
                document.getElementById('listaPublicacoes').innerHTML = html || '<p>Nenhuma publicação cadastrada ainda.</p>';
            })
            .catch(error => console.error('Erro ao carregar publicações:', error));
    }
        
        // Carregar publicações ao abrir a página
    window.addEventListener('load', carregarPublicacoes);
        

</script>
</body>

</html>