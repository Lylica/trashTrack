<?php
// Use um token secreto para evitar que qualquer um acione seu deploy
$secretToken = 'EAFG-A02B';

if (isset($_GET['token']) && $_GET['token'] === $secretToken) {
    // Caminho para o repositório
    $repoPath = '/var/www/html/trashTrack';

    // Comando para executar o git pull
    // Note: O usuário do Apache (www-data) precisa de permissão de escrita no 
    // diretório .git e nos arquivos, e precisa da chave SSH configurada!
    $command = "/usr/bin/git -C $repoPath pull";

    // Executa o comando
    $output = shell_exec($command . ' 2>&1');

    // Responde ao webhook
    echo "<pre>Log de Atualização:\n$output</pre>";
} else {
    // Resposta de falha de autenticação
    header('HTTP/1.0 403 Forbidden');
    echo 'Acesso negado.';
}
?>