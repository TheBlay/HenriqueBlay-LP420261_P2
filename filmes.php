<?php


header('Content-Type: application/json; charset=utf-8');
    $arquivoFilmes = 'filmes.json';

    if (!file_exists($arquivoFilmes)) {
        file_put_contents($arquivoFilmes, json_encode([]));
    }

    $filmes = json_decode(file_get_contents($arquivoFilmes), true);
    
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $genero = trim($_POST['genero'] ?? '') ;
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($nome !== '' && $descricao !== '' && $genero !== '')
    {

        $filmes[] = [
            "nome" => $nome,
            "descricao" => $descricao,
            "genero" => $genero
        ];
        file_put_contents($arquivoFilmes, json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    } else {
        echo "Preencha todos os campos corretamente.";
        exit;
    }
}
    




// Retorna sempre a lista atualizada como JSON (GET ou POST)
    echo json_encode($filmes, JSON_UNESCAPED_UNICODE);
    exit;
?>