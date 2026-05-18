<?php
$host = 'localhost';
$db   = 'db_publicacoes';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Configurações do DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna dados como array associativo por padrão "$row['colunaX']" por exemplo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa emulação para maior segurança
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "<span id='statusConexao'>Conectado com sucesso!</span>";
} catch (\PDOException $e) {
     // Em produção, nunca dê echo no $e->getMessage() diretamente!
     die("Erro na conexão: " . $e->getMessage());
}