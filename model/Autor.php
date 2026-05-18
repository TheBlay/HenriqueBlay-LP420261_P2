<?php

class Autor
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Retorna todos os autores com suas classificações
     * @return array
     */
    public function getTodosAutores(): array
    {
        $sql = "SELECT 
                    a.idAutor,
                    a.nomeAutor,
                    a.email,
                    a.idClassificacao,
                    c.tipoClassificacao
                FROM 
                    tb_autores a
                LEFT JOIN 
                    tb_classificacao c ON a.idClassificacao = c.idClassificacao
                ORDER BY 
                    a.nomeAutor ASC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna um autor específico
     * @param int $idAutor
     * @return array|null
     */
    public function getAutorPorId(int $idAutor): ?array
    {
        $sql = "SELECT 
                    a.idAutor,
                    a.nomeAutor,
                    a.email,
                    a.idClassificacao,
                    c.tipoClassificacao
                FROM 
                    tb_autores a
                LEFT JOIN 
                    tb_classificacao c ON a.idClassificacao = c.idClassificacao
                WHERE 
                    a.idAutor = :idAutor";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idAutor' => $idAutor]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cadastra um novo autor
     * @param string $nomeAutor
     * @param string $email
     * @param int $idClassificacao
     * @return int ID do autor inserido
     */
    public function cadastrarAutor(string $nomeAutor, string $email, int $idClassificacao): int
    {
        $sql = "INSERT INTO tb_autores (nomeAutor, email, idClassificacao) 
                VALUES (:nomeAutor, :email, :idClassificacao)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nomeAutor' => $nomeAutor,
            ':email' => $email,
            ':idClassificacao' => $idClassificacao
        ]);

        return (int) $this->conn->lastInsertId();
    }
}
