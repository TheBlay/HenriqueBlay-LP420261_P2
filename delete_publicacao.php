<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'controller/conexao.php';
require_once 'model/Publicacao.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método HTTP inválido');
    }

    $idPublicacao = (int) ($_POST['idPublicacao'] ?? 0);
    if ($idPublicacao <= 0) {
        throw new Exception('ID de publicação inválido');
    }

    $publicacao = new Publicacao($conn);
    $deleted = $publicacao->excluirPublicacao($idPublicacao);

    if (!$deleted) {
        throw new Exception('Não foi possível excluir a publicação');
    }

    echo json_encode([
        'success' => true,
        'message' => 'Publicação excluída com sucesso'
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
