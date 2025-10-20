<?php
session_start();
include 'db.php'; // sua conexão

// só usuários logados podem postar
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// pega dados do formulário
$titulo = $_POST['title'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';
$autor = $_SESSION['usuario'];

// valida se não está vazio
if ($titulo && $conteudo) {
    $sql = "INSERT INTO forum (titulo, conteudo, autor) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $titulo, $conteudo, $autor);
    $stmt->execute();
}

// redireciona de volta para a página inicial
header("Location: index.php");
exit;
?>
