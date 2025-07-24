<?php
$servername = "localhost";
$username = "root";
$password = "";
$banco = "planejamento_escolar";

$conexao = new mysqli($servername, $username, $password, $banco);

if($conexao->connect_error){
    die("Falha na conexão: " . $conexao->connect_error);
}

//echo "Conexão bem sucedida";
?>
