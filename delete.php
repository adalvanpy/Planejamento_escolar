<?php
include "conexao.php";
include "exibir_planejamentos.php";

$sql = "DELETE FROM planejamento WHERE ID = ".$_GET['ID'];
?>