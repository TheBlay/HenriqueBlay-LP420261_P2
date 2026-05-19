
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="divulgacoes.css">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Publicações</title>
    <style>
        .publicacao-form {
            max-width: 900px;
        }

        .form-section {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            background-color: #f9f9f9;
        }

        .form-section h3 {
            margin-top: 0;
            color: var(--cor-fonte-claro, #333);
            border-bottom: 2px solid var(--cor-primaria, #007bff);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--cor-fonte-claro, #333);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: Arial, sans-serif;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .toggle-novo-autor {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .toggle-novo-autor input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .autor-novo {
            display: none;
            padding: 15px;
            background-color: #e8f4f8;
            border-radius: 4px;
            margin-top: 10px;
        }

        .autor-novo.active {
            display: block;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .botoes button {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-salvar {
            background-color: var(--cor-primaria, #28a745);
            color: white;
        }

        .btn-salvar:hover {
            background-color: #218838;
        }

        .btn-limpar {
            background-color: #6c757d;
            color: white;
        }

        .btn-limpar:hover {
            background-color: #5a6268;
        }

        .lista-publicacoes {
            margin-top: 30px;
        }

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

        .manage-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0 10px;
            font-size: 15px;
        }

        .card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 10px;
        }

        .btn-action {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            color: white;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-action:hover {
            opacity: 0.9;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            width: 90%;
            max-width: 700px;
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 12px;
            right: 12px;
            border: none;
            background: transparent;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .modal-content h3 {
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<?php
require_once 'controller/conexao.php';
require_once 'model/SelectOptions.php';
require_once 'model/Publicacao.php';
include_once 'header.php';

$options = new SelectOptions($conn);
$tiposPublicacao = $options->getTiposPublicacao();
$classificacoes = $options->getClassificacoes();
$autores = $options->getAutores();
$divulgacoes = $options->getDivulgacoes();

$publicacao = new Publicacao($conn);
$todasPublicacoes = $publicacao->getTodasPublicacoes();
?>

<div class='title'>Publicações</div>

<div class="caixa publicacao-form">
    <h2>Cadastrar Nova Publicação</h2>

    <!-- Seção de dados da publicação -->
    <div class="form-section">
        <h3>Informações da Publicação</h3>
        
        <div class="form-group">
            <label for="titulo">Título da Publicação *</label>
            <input type="text" id="titulo" placeholder="Digite o título da publicação" required>
        </div>

        <div class="form-group">
            <label for="resumo">Resumo *</label>
            <textarea id="resumo" rows="6" placeholder="Digite o resumo da publicação" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="dataPublicacao">Data de Publicação</label>
                <input type="date" id="dataPublicacao" value="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group">
                <label for="idTipoPublicacao">Tipo de Publicação *</label>
                <select id="idTipoPublicacao" required>
                    <option value="">Selecione um tipo...</option>
                    <?php foreach ($tiposPublicacao as $row): ?>
                        <option value="<?= $row['idTipoPublicacao'] ?>">
                            <?= htmlspecialchars($row['nomeTipo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Seção de autor (foreign key) -->
    <div class="form-section">
        <h3>Autor</h3>
        
        <div class="form-group">
            <label for="idAutor">Selecione um Autor Existente</label>
            <select id="idAutor">
                <option value="">Nenhum (opcional)</option>
                <?php foreach ($autores as $row): ?>
                    <option value="<?= $row['idAutor'] ?>">
                        <?= htmlspecialchars($row['nomeAutor']) ?> (<?= htmlspecialchars($row['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="toggle-novo-autor">
            <input type="checkbox" id="criarNovoAutor">
            <label for="criarNovoAutor">Ou cadastrar um novo autor</label>
        </div>

        <div class="autor-novo" id="novoAutorForm">
            <div class="form-group">
                <label for="nomeAutor">Nome do Autor *</label>
                <input type="text" id="nomeAutor" placeholder="Digite o nome do autor">
            </div>

            <div class="form-group">
                <label for="emailAutor">Email do Autor *</label>
                <input type="email" id="emailAutor" placeholder="Digite o email do autor">
            </div>

            <div class="form-group">
                <label for="idClassificacaoAutor">Classificação do Autor *</label>
                <select id="idClassificacaoAutor">
                    <option value="">Selecione uma classificação...</option>
                    <?php foreach ($classificacoes as $row): ?>
                        <option value="<?= $row['idClassificacao'] ?>">
                            <?= htmlspecialchars($row['tipoClassificacao']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Seção de divulgação (foreign key) -->
    <div class="form-section">
        <h3>Divulgação (Evento)</h3>
        
        <div class="form-group">
            <label for="idDivulgacao">Selecione um Evento de Divulgação</label>
            <select id="idDivulgacao">
                <option value="">Nenhum (opcional)</option>
                <?php foreach ($divulgacoes as $row): ?>
                    <option value="<?= $row['idDivulgacao'] ?>">
                        <?= htmlspecialchars($row['descricao']) ?> (<?= htmlspecialchars($row['local']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="botoes">
        <button class="btn-salvar" onclick="cadastrarPublicacao()">Cadastrar Publicação</button>
        <button class="btn-limpar" onclick="limparFormulario()">Limpar</button>
    </div>
</div>

<div class="manage-toggle">
    <label>
        <input type="checkbox" id="modoGerenciamento">
        Ativar edição / exclusão de publicações
    </label>
</div>

<!-- Lista de publicações -->
<div class="caixa lista-publicacoes">
    <h2>Publicações Cadastradas</h2>
    <div id="listaPublicacoes"></div>
</div>

<div class="modal-overlay" id="modalEditPublicacao">
    <div class="modal-content">
        <button class="modal-close" onclick="closeEditModal()">&times;</button>
        <h3>Editar Publicação</h3>

        <input type="hidden" id="editIdPublicacao">

        <div class="form-group">
            <label for="editTitulo">Título</label>
            <input type="text" id="editTitulo" placeholder="Título da publicação">
        </div>

        <div class="form-group">
            <label for="editResumo">Resumo</label>
            <textarea id="editResumo" rows="5" placeholder="Resumo da publicação"></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="editDataPublicacao">Data de Publicação</label>
                <input type="date" id="editDataPublicacao">
            </div>

            <div class="form-group">
                <label for="editIdTipoPublicacao">Tipo de Publicação</label>
                <select id="editIdTipoPublicacao">
                    <option value="">Selecione um tipo...</option>
                    <?php foreach ($tiposPublicacao as $row): ?>
                        <option value="<?= $row['idTipoPublicacao'] ?>"><?= htmlspecialchars($row['nomeTipo']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="editIdAutor">Autor</label>
                <select id="editIdAutor">
                    <option value="">Nenhum</option>
                    <?php foreach ($autores as $row): ?>
                        <option value="<?= $row['idAutor'] ?>"><?= htmlspecialchars($row['nomeAutor']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="editIdDivulgacao">Evento de Divulgação</label>
                <select id="editIdDivulgacao">
                    <option value="">Nenhum</option>
                    <?php foreach ($divulgacoes as $row): ?>
                        <option value="<?= $row['idDivulgacao'] ?>"><?= htmlspecialchars($row['descricao']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="botoes">
            <button class="btn-salvar" onclick="salvarEdicao()">Salvar Alterações</button>
            <button class="btn-limpar" onclick="closeEditModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>
    // Toggle para criar novo autor
    document.getElementById('criarNovoAutor').addEventListener('change', function () {
        const novoAutorForm = document.getElementById('novoAutorForm');
        const idAutorSelect = document.getElementById('idAutor');

        if (this.checked) {
            novoAutorForm.classList.add('active');
            idAutorSelect.disabled = true;
        } else {
            novoAutorForm.classList.remove('active');
            idAutorSelect.disabled = false;
        }
    });

    const modoGerenciamento = document.getElementById('modoGerenciamento');
    let manageMode = false;

    modoGerenciamento.addEventListener('change', function () {
        manageMode = this.checked;
        carregarPublicacoes();
    });

    function gerarHTMLPublicacao(pub) {
        const tipoNome = pub.tipo?.nomeTipo || 'N/A';
        const autorNome = pub.autor?.nomeAutor || 'Sem autor';
        const autorEmail = pub.autor?.email || '';
        const divulgacao = pub.divulgacao?.descricao || 'Sem divulgação';
        const divulgacaoLocal = pub.divulgacao?.local || '';

        const actions = manageMode ? `
            <div class="card-actions">
                <button class="btn-action btn-edit" onclick="editarPublicacao(${pub.idPublicacao})">Editar</button>
                <button class="btn-action btn-delete" onclick="excluirPublicacao(${pub.idPublicacao})">Excluir</button>
            </div>
        ` : '';

        return `
            <div class="publicacao-item">
                ${actions}
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

    function cadastrarPublicacao() {
        const titulo = document.getElementById('titulo').value.trim();
        const resumo = document.getElementById('resumo').value.trim();
        const dataPublicacao = document.getElementById('dataPublicacao').value;
        const idTipoPublicacao = document.getElementById('idTipoPublicacao').value;
        const criarNovoAutor = document.getElementById('criarNovoAutor').checked;

        if (!titulo || !resumo || !idTipoPublicacao) {
            alert('Preencha os campos obrigatórios: Título, Resumo e Tipo de Publicação');
            return;
        }

        const body = new FormData();
        body.append('titulo', titulo);
        body.append('resumo', resumo);
        body.append('dataPublicacao', dataPublicacao);
        body.append('idTipoPublicacao', idTipoPublicacao);

        if (criarNovoAutor) {
            const nomeAutor = document.getElementById('nomeAutor').value.trim();
            const emailAutor = document.getElementById('emailAutor').value.trim();
            const idClassificacaoAutor = document.getElementById('idClassificacaoAutor').value;

            if (!nomeAutor || !emailAutor || !idClassificacaoAutor) {
                alert('Preencha todos os campos do novo autor');
                return;
            }

            body.append('novoAutor', 'sim');
            body.append('nomeAutor', nomeAutor);
            body.append('emailAutor', emailAutor);
            body.append('idClassificacaoAutor', idClassificacaoAutor);
        } else {
            const idAutor = document.getElementById('idAutor').value;
            if (idAutor) {
                body.append('idAutor', idAutor);
            }
        }

        const idDivulgacao = document.getElementById('idDivulgacao').value;
        if (idDivulgacao) {
            body.append('idDivulgacao', idDivulgacao);
        }

        fetch('processa_publicacao.php', {
            method: 'POST',
            body: body
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                limparFormulario();
                carregarPublicacoes();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function salvarEdicao() {
        const idPublicacao = document.getElementById('editIdPublicacao').value;
        const titulo = document.getElementById('editTitulo').value.trim();
        const resumo = document.getElementById('editResumo').value.trim();
        const dataPublicacao = document.getElementById('editDataPublicacao').value;
        const idTipoPublicacao = document.getElementById('editIdTipoPublicacao').value;
        const idAutor = document.getElementById('editIdAutor').value;
        const idDivulgacao = document.getElementById('editIdDivulgacao').value;

        if (!titulo || !resumo || !idTipoPublicacao) {
            alert('Preencha Título, Resumo e Tipo de Publicação');
            return;
        }

        const body = new FormData();
        body.append('idPublicacao', idPublicacao);
        body.append('titulo', titulo);
        body.append('resumo', resumo);
        body.append('dataPublicacao', dataPublicacao);
        body.append('idTipoPublicacao', idTipoPublicacao);

        if (idAutor) {
            body.append('idAutor', idAutor);
        }

        if (idDivulgacao) {
            body.append('idDivulgacao', idDivulgacao);
        }

        fetch('processa_publicacao.php', {
            method: 'POST',
            body: body
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeEditModal();
                carregarPublicacoes();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function excluirPublicacao(idPublicacao) {
        if (!confirm('Tem certeza de que deseja excluir esta publicação?')) {
            return;
        }

        const body = new URLSearchParams();
        body.append('idPublicacao', idPublicacao);

        fetch('delete_publicacao.php', {
            method: 'POST',
            body: body,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                carregarPublicacoes();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function editarPublicacao(idPublicacao) {
        fetch(`api_publicacao.php?id=${idPublicacao}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Erro: ' + data.message);
                    return;
                }
                showEditModal(data);
            })
            .catch(error => console.error('Erro:', error));
    }

    function showEditModal(pub) {
        document.getElementById('editIdPublicacao').value = pub.idPublicacao;
        document.getElementById('editTitulo').value = pub.titulo;
        document.getElementById('editResumo').value = pub.resumo;
        document.getElementById('editDataPublicacao').value = pub.dataPublicacao || new Date().toISOString().split('T')[0];
        document.getElementById('editIdTipoPublicacao').value = pub.tipo?.idTipoPublicacao || '';
        document.getElementById('editIdAutor').value = pub.autor?.idAutor || '';
        document.getElementById('editIdDivulgacao').value = pub.divulgacao?.idDivulgacao || '';

        document.getElementById('modalEditPublicacao').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('modalEditPublicacao').classList.remove('active');
    }

    function limparFormulario() {
        document.getElementById('titulo').value = '';
        document.getElementById('resumo').value = '';
        document.getElementById('dataPublicacao').value = new Date().toISOString().split('T')[0];
        document.getElementById('idTipoPublicacao').value = '';
        document.getElementById('idAutor').value = '';
        document.getElementById('idDivulgacao').value = '';
        document.getElementById('criarNovoAutor').checked = false;
        document.getElementById('novoAutorForm').classList.remove('active');
        document.getElementById('nomeAutor').value = '';
        document.getElementById('emailAutor').value = '';
        document.getElementById('idClassificacaoAutor').value = '';
    }

    function carregarPublicacoes() {
        fetch('api_publicacoes.php', { method: 'GET' })
            .then(response => response.json())
            .then(publicacoes => {
                if (!Array.isArray(publicacoes)) {
                    document.getElementById('listaPublicacoes').innerHTML = '<p>Erro ao carregar publicações.</p>';
                    return;
                }
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
