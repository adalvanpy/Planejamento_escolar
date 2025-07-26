<?php
session_start();
include("conexao.php");
if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
}
else {
    header("Location: login.php");
    exit();
}

if (isset($_GET['ID'])){
    $id = $_GET['ID'] ?? null;

    if (!$id) {
        die("ID não informado.");
    }

    $stmt = $conexao->prepare("SELECT * FROM Planejamento WHERE ID_PLANEJAMENTO = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        die("Planejamento não encontrado.");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data']??"";
        $comp_curricular = $_POST['comp_curricular']??"";
        $un_tematica = $_POST['un_tematica']??"";
        $turma = $_POST['turma']??"";
        $unidade = $_POST['unidade']??"";
        $objetivos = $_POST['objetivos']??"";
        $percurso = $_POST['percurso']??"";
        $recursos = $_POST['recursos']??"";
        $avaliacao = $_POST['avaliacao']??"";
        $sql = "UPDATE planejamento SET
         DATA=?, 
         COMP_CURRICULAR=?,
        UN_TEMATICA=?, 
        TURMA=?, 
        UNIDADE=?, 
        OBJETIVOS=?, 
        PERCURSO=?,
        RECURSOS=?,
        AVALIACAO=?
         WHERE ID_PLANEJAMENTO=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssssssssi",
            $data,
            $comp_curricular,
            $un_tematica,
            $turma,
            $unidade,
            $objetivos,
            $percurso,
            $recursos,
            $avaliacao,
            $id);
        if ($stmt->execute()) {
            echo "Planejamento editado com sucesso!";
            header("Location: exibir_planejamento.php");
        } else {
            echo "Erro ao editar planejamento!";
        }
        $stmt->close();
    }
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
<header class="flex items-center justify-end h-20 p-2 border w-full bg-white">
    <li class=" text-blue-500 inline-block text-2xl p-2"><a href="criar_planejamento.php">Criar Planejamento</a></li>
    <p class="text-2xl text-center text-white  p-2 bg-blue-300 rounded-full w-12 h-12"><?= substr($usuario['NOME'], 0, 1) ?></p>
    <a href="logout.php" class="text-2xl text-blue-500 p-2">Sair</a>
</header>
<main class="w-full flex flex-col items-center justify-center">
<h1 class="text-3xl font-bold mb-6 mt-4">Editar Planejamento</h1>
<form  method="post" class="bg-white p-8 rounded shadow-md w-[50%] space-y-4">
    <div class="flex items-center justify-between w-full gap-4">
        <div class=" w-full">
            <label for="data" class="block text-left font-semibold mb-1">DATA</label>
            <input type="text" name="data" id="data" value="<?= $row['DATA'] ?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>
        <div  class=" w-full">
            <label for="turma" class="block text-left font-semibold mb-1">TURMA</label>
            <input type="text" name="turma" id="turma" value="<?=$row['TURMA']?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div  class=" w-full">
            <label for="unidade" class="block text-left font-semibold mb-1">UNIDADE</label>
            <input type="text" name="unidade" id="unidade" value="<?=$row['UNIDADE']?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

    </div>
    <div class="flex items-center justify-between w-full gap-4">
        <div class="w-full ">
            <label for="comp_curricular" class="block text-left font-semibold mb-1">COMPONENTE CURRICULAR</label>
            <input type="text" name="comp_curricular" id="comp_curricular" value="<?=$row['COMP_CURRICULAR']?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="w-full ">
            <label for="un_tematica" class="block text-left font-semibold mb-1">UNIDADE TEMATICA</label>
            <input type="text" name="un_tematica" id="un_tematica" value="<?=$row['UN_TEMATICA']?>" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
    </div>
    <div class="border p-4 rounded">
        <label for="objetivos" class="block text-left font-semibold mb-1">OBJETIVOS</label>
        <input type="hidden" type="text" name="objetivos" id="objetivos">

        <div id="objetivos_" contenteditable="true"
             class="w-full rounded px-3 py-2 border min-h-[100px] focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?=$row['OBJETIVOS']?>
        </div>

        <div class="flex items-end justify-end gap-2 w-full mt-2">
            <button type="button" onclick="document.execCommand('bold')" class="border rounded px-2 font-bold">N</button>
            <button type="button" onclick="document.execCommand('italic')" class="border rounded px-2 italic">I</button>
            <button type="button" onclick="document.execCommand('justifyCenter')" class="border px-2">C</button>
            <button type="button" onclick="document.execCommand('justifyLeft')" class="border px-2">L</button>
            <button type="button" onclick="document.execCommand('underline')" class="border px-2 underline">S</button>
            <input type="color" class="w-[3%]" onchange="document.execCommand('foreColor', false, this.value)">
            <button type="button" onclick="criarLink()" class="border px-2">🔗</button>
        </div>
    </div>
    <div class="border p-4 rounded">
        <label for="percurso" class="block text-left font-semibold mb-1">PERCURSO</label>
        <input type="hidden"  name="percurso" id="percurso">
        <div id="percurso_" contenteditable="true"
             class="w-full rounded px-3 py-2 border min-h-[100px] focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?=$row['PERCURSO']?>

        </div>
        <div class="flex items-end justify-end gap-2 w-full mt-2">
            <button type="button" onclick="document.execCommand('bold')" class="border rounded px-2 font-bold">N</button>
            <button type="button" onclick="document.execCommand('italic')" class="border rounded px-2 italic">I</button>
            <button type="button" onclick="document.execCommand('justifyCenter')" class="border px-2">C</button>
            <button type="button" onclick="document.execCommand('justifyLeft')" class="border px-2">L</button>
            <button type="button" onclick="document.execCommand('underline')" class="border px-2 underline">S</button>
            <input type="color" class="w-[3%]" onchange="document.execCommand('foreColor', false, this.value)">
            <button type="button" onclick="criarLink()" class="border px-2">🔗</button>
        </div>
    </div>
    <div class="border p-4 rounded">
        <label for="recursos" class="block text-left font-semibold mb-1">RECURSOS</label>
        <input type="hidden"  name="recursos" id="recursos">
        <div id="recursos_" contenteditable="true"
             class="w-full rounded px-3 py-2 border min-h-[100px] focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?=$row['RECURSOS']?>

        </div>
        <div class="flex items-end justify-end gap-2 w-full mt-2">
            <button type="button" onclick="document.execCommand('bold')" class="border rounded px-2 font-bold">N</button>
            <button type="button" onclick="document.execCommand('italic')" class="border rounded px-2 italic">I</button>
            <button type="button" onclick="document.execCommand('justifyCenter')" class="border px-2">C</button>
            <button type="button" onclick="document.execCommand('justifyLeft')" class="border px-2">L</button>
            <button type="button" onclick="document.execCommand('underline')" class="border px-2 underline">S</button>
            <input type="color" class="w-[3%]" onchange="document.execCommand('foreColor', false, this.value)">
            <button type="button" onclick="criarLink()" class="border px-2">🔗</button>
        </div>
    </div>
    <div class="border p-4 rounded">
        <label for="avaliacao" class="block text-left font-semibold mb-1">AVALIAÇÃO</label>
        <input type="hidden"  name="avaliacao" id="avaliacao" required>
        <div id="avaliacao_" contenteditable="true"
             class="w-full rounded px-3 py-2 border min-h-[100px] focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?=$row['AVALIACAO']?>

        </div>
        <div class="flex items-end justify-end gap-2 w-full mt-2">
            <button type="button" onclick="document.execCommand('bold')" class="border rounded px-2 font-bold">N</button>
            <button type="button" onclick="document.execCommand('italic')" class="border rounded px-2 italic">I</button>
            <button type="button" onclick="document.execCommand('justifyCenter')" class="border px-2">C</button>
            <button type="button" onclick="document.execCommand('justifyLeft')" class="border px-2">L</button>
            <button type="button" onclick="document.execCommand('underline')" class="border px-2 underline">S</button>
            <input type="color" class="w-[3%]" onchange="document.execCommand('foreColor', false, this.value)">
            <button type="button" onclick="criarLink()" class="border px-2">🔗</button>
        </div>
    </div>
    <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-3 rounded hover:bg-blue-700 transition duration-300">
        Atualizar Planejamento
    </button>
</form>
</main>
<script>
    document.querySelector("form").addEventListener("submit", function () {
        document.getElementById("objetivos").value = document.getElementById("objetivos_").innerHTML;
        document.getElementById("percurso").value = document.getElementById("percurso_").innerHTML;
        document.getElementById("recursos").value = document.getElementById("recursos_").innerHTML;
        document.getElementById("avaliacao").value = document.getElementById("avaliacao_").innerHTML;
    });

    function criarLink() {
        const url = prompt("Cole o link:");
        if (url) document.execCommand('createLink', false, url);
    }
</script>
</body>
</html>

