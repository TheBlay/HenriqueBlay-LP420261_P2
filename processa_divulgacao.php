<?php
include 'conexao.php';

$dataEvento = $_POST['data_evento'];
$localEvento = $POST['local_evento'];
$descricao = $POST['descricao'];
$convidados = $POST['convidados'];

try {
$sql = "INSERT INTO tb_divulgacao (data_evento, localEvento, descricao)
        VALUES (:data+evento, :local_evento, :descricao)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':data_evento' => $dataEvento,
    ':local_evento' => $localEvento
]);

$idDivulgacao = $conn->lastInsertId();

$sqlConvidados = $conn->prepare($sqlConvidados);

foreach ($convidados as $idConvidado) {
    $stmtConvidados->execute([
        ':id_divulgacao' => $idDivulgacao,
        ':id_convidado' => $idConvidado
    ]);

}

echo "Divulgação cadastrada com sucesso!";


} catch (PDOException $e){
    echo "Erro: " . $e->getMessage();
}
?>