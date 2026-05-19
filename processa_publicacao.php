<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'controller/conexao.php';
require_once 'model/Publicacao.php';
require_once 'model/Autor.php';

$response = ['success' => false, 'message' => ''];

try {
    // Validar método
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método HTTP inválido');
    }

    // Recuperar dados do formulário
    $titulo = trim($_POST['titulo'] ?? '');
    $resumo = trim($_POST['resumo'] ?? '');
    $dataPublicacao = trim($_POST['dataPublicacao'] ?? date('Y-m-d'));
    $idTipoPublicacao = (int) ($_POST['idTipoPublicacao'] ?? 0);
    $idAutor = !empty($_POST['idAutor']) ? (int) $_POST['idAutor'] : null;
    $idDivulgacao = !empty($_POST['idDivulgacao']) ? (int) $_POST['idDivulgacao'] : null;
    $idPublicacao = !empty($_POST['idPublicacao']) ? (int) $_POST['idPublicacao'] : 0;
    $isUpdate = $idPublicacao > 0;

    // Validar dados obrigatórios
    if (empty($titulo) || empty($resumo) || $idTipoPublicacao === 0) {
        throw new Exception('Título, resumo e tipo de publicação são obrigatórios');
    }

    // Se for cadastrar novo autor
    if (isset($_POST['novoAutor']) && $_POST['novoAutor'] === 'sim') {
        $nomeAutor = trim($_POST['nomeAutor'] ?? '');
        $emailAutor = trim($_POST['emailAutor'] ?? '');
        $idClassificacaoAutor = (int) ($_POST['idClassificacaoAutor'] ?? 0);

        if (empty($nomeAutor) || empty($emailAutor) || $idClassificacaoAutor === 0) {
            throw new Exception('Nome, email e classificação do autor são obrigatórios');
        }

        $autor = new Autor($conn);
        $idAutor = $autor->cadastrarAutor($nomeAutor, $emailAutor, $idClassificacaoAutor);
    }

    $publicacao = new Publicacao($conn);

    if ($isUpdate) {
        $updated = $publicacao->atualizarPublicacao(
            $idPublicacao,
            $titulo,
            $resumo,
            $dataPublicacao,
            $idTipoPublicacao,
            $idAutor,
            $idDivulgacao
        );

        if (!$updated) {
            throw new Exception('Não foi possível atualizar a publicação');
        }

        $response['success'] = true;
        $response['message'] = 'Publicação atualizada com sucesso!';
        $response['idPublicacao'] = $idPublicacao;
    } else {
        $idPublicacao = $publicacao->cadastrarPublicacao(
            $titulo,
            $resumo,
            $dataPublicacao,
            $idTipoPublicacao,
            $idAutor,
            $idDivulgacao
        );

        $response['success'] = true;
        $response['message'] = 'Publicação cadastrada com sucesso!';
        $response['idPublicacao'] = $idPublicacao;
    }

} catch (Exception $e) {
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
