<?php
include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = $_POST['data'];
    $comp_curricular = $_POST['comp_curricular'];
    $un_tematica = $_POST['un_tematica'];
    $turma = $_POST['turma'];
    $unidade = $_POST['unidade'];
    $objetivos = $_POST['objetivos'];
    $percurso = $_POST['percurso'];
    $recursos = $_POST['recursos'];
    $avaliacao = $_POST['avaliacao'];

    $sql = "INSERT INTO Planejamento(DATA, COMP_CURRICULAR, UN_TEMATICA, TURMA, UNIDADE, OBJETIVOS, PERCURSO, RECURSOS, AVALIACAO) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssssss", $data, $comp_curricular, $un_tematica, $turma, $unidade, $objetivos, $percurso, $recursos, $avaliacao);

    if($stmt->execute()){
        echo "Planejamento criado com sucesso!";
    }
    else{
        echo "Erro ao criar planejamento!";
    }

    $stmt->close();

}
$conexao->close();

?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Usando PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen p-6">
<h1 class="text-3xl font-bold mb-6">Criar Planejamento</h1>
<form action="criar_planejamento.php" method="post" class="bg-white p-8 rounded shadow-md w-[50%] space-y-4">
    <div class="flex items-center justify-between w-full gap-4">
        <div class=" w-full">
            <label for="data" class="block text-left font-semibold mb-1">DATA</label>
            <input type="text" name="data" id="data" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div  class=" w-full">
            <label for="turma" class="block text-left font-semibold mb-1">TURMA</label>
            <input type="text" name="turma" id="turma" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div  class=" w-full">
            <label for="unidade" class="block text-left font-semibold mb-1">UNIDADE</label>
            <input type="text" name="unidade" id="unidade" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

    </div>
    <div class="flex items-center justify-between w-full gap-4">
        <div class="w-full ">
            <label for="comp_curricular" class="block text-left font-semibold mb-1">COMPONENTE CURRICULAR</label>
            <input type="text" name="comp_curricular" id="comp_curricular" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="w-full ">
            <label for="un_tematica" class="block text-left font-semibold mb-1">UNIDADE TEMATICA</label>
            <input type="text" name="un_tematica" id="un_tematica" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
    </div>
    <div>
        <label for="objetivos" class="block text-left font-semibold mb-1">OBJETIVOS</label>
        <textarea type="text" name="objetivos" id="objetivos" required
                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </textarea>
    </div>
    <div>
        <label for="percurso" class="block text-left font-semibold mb-1">PERCURSO</label>
        <textarea type="text" name="percurso" id="percurso" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </textarea>
    </div>
    <div>
        <label for="recursos" class="block text-left font-semibold mb-1">RECURSOS</label>
        <textarea type="text" name="recursos" id="recursos" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </textarea>
    </div>
    <div>
        <label for="avaliacao" class="block text-left font-semibold mb-1">AVALIAÇÃO</label>
        <textarea type="text" name="avaliacao" id="avaliacao" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </textarea>
    </div>
    <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-3 rounded hover:bg-blue-700 transition duration-300">
        Criar Planejamento
    </button>
</form>
</body>
</html>
