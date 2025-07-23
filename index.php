<!DOCTYPE html>
<html lang="pt-br">
    <head>
         <meta charset="UTF-8">
         <title>Usando php</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="text-center">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $banco = "planejamento_escolar";

    $conexao = new mysqli($servername, $username, $password, $banco);

    if($conexao->connect_error){
        die("Falha na conexão: " . conexao->connect_error);
    }

    echo "Conexão bem sucedida";
    ?>
    </body>

</html>        