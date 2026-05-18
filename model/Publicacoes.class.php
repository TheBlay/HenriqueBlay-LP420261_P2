<?php

class Publicacao
{

    protected  $conn;

    public function __construct(\mysqli $conn){

        $this->conn =$conn;
    }


    public function exibirTodos()
    {
        require_once 'controller/conexao.php';

        $sql = "SELECT * FROM tb_publicacao";
        $resultado = $this->conn->query($sql);
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        while ($linhas = $resultado->fetch_array()) {
                echo '<p>'.$linhas['titulo'].'</p>';
            } 

    }

    public function adicionar()
    {
        require_once 'controller/conexao.php';
    }

}


