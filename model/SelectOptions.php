<?php

class SelectOptions
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getTiposPublicacao(): array
    {
        return $this->fetchAll("SELECT idTipoPublicacao, nomeTipo FROM tb_tipopublicacao ORDER BY nomeTipo");
    }

    public function getClassificacoes(): array
    {
        return $this->fetchAll("SELECT idClassificacao, tipoClassificacao FROM tb_classificacao ORDER BY tipoClassificacao");
    }

    public function getAutores(): array
    {
        return $this->fetchAll("SELECT idAutor, nomeAutor, email FROM tb_autores ORDER BY nomeAutor");
    }

    public function getDivulgacoes(): array
    {
        return $this->fetchAll("SELECT idDivulgacao, descricao, local FROM tb_divulgacao ORDER BY descricao");
    }

    private function fetchAll(string $sql): array
    {
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
