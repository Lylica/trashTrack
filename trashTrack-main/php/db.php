<?php
$host = "localhost";
$user = "root"; // padrão do XAMPP
$pass = "";     // senha vazia por padrão
$db   = "trashtrack";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
