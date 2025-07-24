<?php
include "conexao.php";

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql = "DELETE FROM planejamento WHERE ID = $id";

    if (mysqli_query($conexao, $sql)) {
        header("Location: exibir_planejamento.php");
        exit;
    } else {
        echo "Erro ao deletar: " . mysqli_error($conexao);
    }
} else {
    echo "ID não fornecido.";
}
?>