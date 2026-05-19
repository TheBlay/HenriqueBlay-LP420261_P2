<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'controller/conexao.php';
require_once 'model/Publicacao.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Método HTTP inválido');
    }

    $idPublicacao = (int) ($_GET['id'] ?? 0);
    if ($idPublicacao <= 0) {
        throw new Exception('ID de publicação inválido');
    }

    $publicacao = new Publicacao($conn);
    $resultado = $publicacao->getPublicacaoPorId($idPublicacao);

    if (!$resultado) {
        throw new Exception('Publicação não encontrada');
    }

    echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
