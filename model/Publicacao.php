<?php

class Publicacao
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Retorna todas as publicações com seus autores e divulgação
     * @return array Array com publicações agrupadas
     */
    public function getTodasPublicacoes(): array
    {
        $sql = "SELECT 
                    p.idPublicacao,
                    p.titulo,
                    p.resumo,
                    p.dataPublicacao,
                    p.idTipoPublicacao,
                    tp.nomeTipo,
                    tp.descricao AS tipoDescricao,
                    a.idAutor,
                    a.nomeAutor,
                    a.email,
                    a.idClassificacao,
                    d.idDivulgacao,
                    d.dataEvento,
                    d.local,
                    d.descricao AS descricaoDivulgacao
                FROM 
                    tb_publicacao p
                LEFT JOIN 
                    tb_tipopublicacao tp ON p.idTipoPublicacao = tp.idTipoPublicacao
                LEFT JOIN 
                    tb_autores a ON p.idAutor = a.idAutor
                LEFT JOIN 
                    tb_divulgacao d ON p.idDivulgacao = d.idDivulgacao
                ORDER BY 
                    p.idPublicacao DESC";

        $stmt = $this->conn->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agrupa por publicação
        $publicacoesAgrupadas = [];
        foreach ($resultados as $row) {
            $idPublicacao = $row['idPublicacao'];
            
            if (!isset($publicacoesAgrupadas[$idPublicacao])) {
                $publicacoesAgrupadas[$idPublicacao] = [
                    'idPublicacao' => $row['idPublicacao'],
                    'titulo' => $row['titulo'],
                    'resumo' => $row['resumo'],
                    'dataPublicacao' => $row['dataPublicacao'],
                    'tipo' => [
                        'idTipoPublicacao' => $row['idTipoPublicacao'],
                        'nomeTipo' => $row['nomeTipo'],
                        'descricao' => $row['tipoDescricao']
                    ],
                    'autor' => [
                        'idAutor' => $row['idAutor'],
                        'nomeAutor' => $row['nomeAutor'],
                        'email' => $row['email'],
                        'idClassificacao' => $row['idClassificacao']
                    ],
                    'divulgacao' => [
                        'idDivulgacao' => $row['idDivulgacao'],
                        'dataEvento' => $row['dataEvento'],
                        'local' => $row['local'],
                        'descricao' => $row['descricaoDivulgacao']
                    ]
                ];
            }
        }

        return array_values($publicacoesAgrupadas);
    }

    /**
     * Retorna uma publicação específica com seus dados relacionados
     * @param int $idPublicacao
     * @return array|null
     */
    public function getPublicacaoPorId(int $idPublicacao): ?array
    {
        $sql = "SELECT 
                    p.idPublicacao,
                    p.titulo,
                    p.resumo,
                    p.dataPublicacao,
                    p.idTipoPublicacao,
                    tp.nomeTipo,
                    tp.descricao AS tipoDescricao,
                    a.idAutor,
                    a.nomeAutor,
                    a.email,
                    a.idClassificacao,
                    d.idDivulgacao,
                    d.dataEvento,
                    d.local,
                    d.descricao AS descricaoDivulgacao
                FROM 
                    tb_publicacao p
                LEFT JOIN 
                    tb_tipopublicacao tp ON p.idTipoPublicacao = tp.idTipoPublicacao
                LEFT JOIN 
                    tb_autores a ON p.idAutor = a.idAutor
                LEFT JOIN 
                    tb_divulgacao d ON p.idDivulgacao = d.idDivulgacao
                WHERE 
                    p.idPublicacao = :idPublicacao";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idPublicacao' => $idPublicacao]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return [
            'idPublicacao' => $row['idPublicacao'],
            'titulo' => $row['titulo'],
            'resumo' => $row['resumo'],
            'dataPublicacao' => $row['dataPublicacao'],
            'tipo' => [
                'idTipoPublicacao' => $row['idTipoPublicacao'],
                'nomeTipo' => $row['nomeTipo'],
                'descricao' => $row['tipoDescricao']
            ],
            'autor' => [
                'idAutor' => $row['idAutor'],
                'nomeAutor' => $row['nomeAutor'],
                'email' => $row['email'],
                'idClassificacao' => $row['idClassificacao']
            ],
            'divulgacao' => [
                'idDivulgacao' => $row['idDivulgacao'],
                'dataEvento' => $row['dataEvento'],
                'local' => $row['local'],
                'descricao' => $row['descricaoDivulgacao']
            ]
        ];
    }

    /**
     * Cadastra uma nova publicação
     * @param string $titulo
     * @param string $resumo
     * @param string $dataPublicacao (YYYY-MM-DD)
     * @param int $idTipoPublicacao
     * @param int|null $idAutor
     * @param int|null $idDivulgacao
     * @return int ID da publicação inserida
     */
    public function cadastrarPublicacao(
        string $titulo,
        string $resumo,
        string $dataPublicacao,
        int $idTipoPublicacao,
        ?int $idAutor = null,
        ?int $idDivulgacao = null
    ): int {
        $sql = "INSERT INTO tb_publicacao (titulo, resumo, dataPublicacao, idTipoPublicacao, idAutor, idDivulgacao) 
                VALUES (:titulo, :resumo, :dataPublicacao, :idTipoPublicacao, :idAutor, :idDivulgacao)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':resumo' => $resumo,
            ':dataPublicacao' => $dataPublicacao,
            ':idTipoPublicacao' => $idTipoPublicacao,
            ':idAutor' => $idAutor,
            ':idDivulgacao' => $idDivulgacao
        ]);

        return (int) $this->conn->lastInsertId();
    }

    /**
     * Retorna publicações filtradas por tipo
     * @param string $tipoPublicacao
     * @return array
     */
    public function getPublicacoesPorTipo(string $tipoPublicacao): array
    {
        $sql = "SELECT 
                    p.idPublicacao,
                    p.titulo,
                    p.resumo,
                    p.dataPublicacao,
                    p.idTipoPublicacao,
                    tp.nomeTipo,
                    tp.descricao AS tipoDescricao,
                    a.idAutor,
                    a.nomeAutor,
                    a.email,
                    a.idClassificacao,
                    d.idDivulgacao,
                    d.dataEvento,
                    d.local,
                    d.descricao AS descricaoDivulgacao
                FROM 
                    tb_publicacao p
                LEFT JOIN 
                    tb_tipopublicacao tp ON p.idTipoPublicacao = tp.idTipoPublicacao
                LEFT JOIN 
                    tb_autores a ON p.idAutor = a.idAutor
                LEFT JOIN 
                    tb_divulgacao d ON p.idDivulgacao = d.idDivulgacao
                WHERE 
                    tp.nomeTipo = :tipoPublicacao
                ORDER BY 
                    p.idPublicacao DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tipoPublicacao' => $tipoPublicacao]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agrupa por publicação
        $publicacoesAgrupadas = [];
        foreach ($resultados as $row) {
            $idPublicacao = $row['idPublicacao'];
            
            if (!isset($publicacoesAgrupadas[$idPublicacao])) {
                $publicacoesAgrupadas[$idPublicacao] = [
                    'idPublicacao' => $row['idPublicacao'],
                    'titulo' => $row['titulo'],
                    'resumo' => $row['resumo'],
                    'dataPublicacao' => $row['dataPublicacao'],
                    'tipo' => [
                        'idTipoPublicacao' => $row['idTipoPublicacao'],
                        'nomeTipo' => $row['nomeTipo'],
                        'descricao' => $row['tipoDescricao']
                    ],
                    'autor' => [
                        'idAutor' => $row['idAutor'],
                        'nomeAutor' => $row['nomeAutor'],
                        'email' => $row['email'],
                        'idClassificacao' => $row['idClassificacao']
                    ],
                    'divulgacao' => [
                        'idDivulgacao' => $row['idDivulgacao'],
                        'dataEvento' => $row['dataEvento'],
                        'local' => $row['local'],
                        'descricao' => $row['descricaoDivulgacao']
                    ]
                ];
            }
        }

        return array_values($publicacoesAgrupadas);
    }
}
