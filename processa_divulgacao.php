<?php
require_once 'controller/conexao.php';

$dataEvento = $_POST['dataEvento'] ?? null;
$local = $_POST['local'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$convidados = $_POST['convidados'] ?? [];

try {
    // Validar dados obrigatórios
    if (empty($dataEvento) || empty($local) || empty($descricao)) {
        throw new Exception('Data do evento, local e descrição são obrigatórios');
    }

    // Inserir divulgação
    $sql = "INSERT INTO tb_divulgacao (dataEvento, local, descricao)
            VALUES (:dataEvento, :local, :descricao)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':dataEvento' => $dataEvento,
        ':local' => $local,
        ':descricao' => $descricao
    ]);

    $idDivulgacao = $conn->lastInsertId();

    // Inserir convidados se houver
    if (!empty($convidados) && is_array($convidados)) {
        $sqlConvidados = "INSERT INTO tb_divulgacao_convidado (idDivulgacao, idConvidado)
                          VALUES (:id_divulgacao, :id_convidado)";
        $stmtConvidados = $conn->prepare($sqlConvidados);

        foreach ($convidados as $idConvidado) {
            $stmtConvidados->execute([
                ':id_divulgacao' => $idDivulgacao,
                ':id_convidado' => (int) $idConvidado
            ]);
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'Divulgação cadastrada com sucesso!',
        'idDivulgacao' => $idDivulgacao
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro no banco de dados: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>