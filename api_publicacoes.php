<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'controller/conexao.php';
require_once 'model/Publicacao.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Método HTTP inválido');
    }

    $publicacao = new Publicacao($conn);
    $publicacoes = $publicacao->getTodasPublicacoes();

    echo json_encode($publicacoes, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
