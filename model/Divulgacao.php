<?php

class Divulgacao
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Retorna todos os eventos com seus convidados
     * @return array Array agrupado por evento
     */
    public function getEventosComConvidados(): array
    {
        $sql = "SELECT 
                    d.idDivulgacao,
                    d.dataEvento,
                    d.local,
                    d.descricao AS evento,
                    c.nomeConvidado,
                    c.email,
                    c.telefone
                FROM 
                    tb_divulgacao d
                LEFT JOIN 
                    tb_divulgacao_convidado dc ON d.idDivulgacao = dc.idDivulgacao
                LEFT JOIN 
                    tb_convidados c ON dc.idConvidado = c.idConvidado
                ORDER BY 
                    d.idDivulgacao, d.descricao ASC";

        $stmt = $this->conn->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agrupa por evento
        $eventosAgrupados = [];
        foreach ($resultados as $row) {
            $idEvento = $row['idDivulgacao'];
            if (!isset($eventosAgrupados[$idEvento])) {
                $eventosAgrupados[$idEvento] = [
                    'idDivulgacao' => $row['idDivulgacao'],
                    'dataEvento' => $row['dataEvento'],
                    'local' => $row['local'],
                    'evento' => $row['evento'],
                    'convidados' => []
                ];
            }
            
            if ($row['nomeConvidado'] !== null) {
                $eventosAgrupados[$idEvento]['convidados'][] = [
                    'nome' => $row['nomeConvidado'],
                    'email' => $row['email'],
                    'telefone' => $row['telefone']
                ];
            }
        }

        return array_values($eventosAgrupados);
    }

    /**
     * Retorna convidados de um evento específico
     * @param int $idDivulgacao
     * @return array
     */
    public function getConvidadosPorEvento(int $idDivulgacao): array
    {
        $sql = "SELECT 
                    d.descricao,
                    c.nomeConvidado,
                    c.email,
                    c.telefone
                FROM 
                    tb_divulgacao_convidado dc
                INNER JOIN 
                    tb_divulgacao d ON dc.idDivulgacao = d.idDivulgacao
                INNER JOIN 
                    tb_convidados c ON dc.idConvidado = c.idConvidado
                WHERE 
                    d.idDivulgacao = :idDivulgacao
                ORDER BY 
                    c.nomeConvidado ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idDivulgacao' => $idDivulgacao]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna todos os eventos
     * @return array
     */
    public function getTodosEventos(): array
    {
        $sql = "SELECT 
                    idDivulgacao,
                    dataEvento,
                    local,
                    descricao
                FROM 
                    tb_divulgacao
                ORDER BY 
                    dataEvento DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
