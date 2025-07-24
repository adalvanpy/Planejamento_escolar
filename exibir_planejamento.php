<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usando php</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-center">
<?php
include 'conexao.php';

$sql = "SELECT ID, DATA, COMP_CURRICULAR, UN_TEMATICA, TURMA, UNIDADE, OBJETIVOS, PERCURSO, RECURSOS, AVALIACAO FROM planejamento";
$result = $conexao->query($sql);



if ($result->num_rows > 0) {
    echo "<div class='flex items-center justify-center p-4 '>";
    echo "<h2 class='bg-blue-400 p-2 w-[20%] rounded text-white font-bold'>Meus Planejamentos:</h2>";
    echo "</div>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='planejamento flex flex-col items-center justify-center'>";
        echo "<p class='hidden'><strong>ID:</strong>" . ($row["ID"]) . "</p>";

        echo "<div class='flex items-center justify-center w-[50%]'>";
        echo "<p class='w-[60%] border p-2 text-start'><strong>DATA:</strong> " . ($row['DATA']) . "</p>";
        echo "<p class='w-[40%] border p-2 text-start'><strong>TURMA:</strong> " . ($row['TURMA']) . "</p>";
        echo "</div>";

        echo "<div class='flex items-center justify-center w-[50%]'>";
        echo "<p class='w-[70%] border p-2 text-start'><strong>COMPONENTE CURRICULAR:</strong> " . ($row['COMP_CURRICULAR']) . "</p>";
        echo "<p class='w-[30%] border p-2 text-start'><strong>UNIDADE:</strong> " . ($row['UNIDADE']) . "</p>";
        echo "</div>";

        echo "<div class='w-[50%]'>";
        echo "<p class='w-full border p-2 text-start'><strong>UNIDADE TEMÁTICA:</strong> " . ($row['UN_TEMATICA']) . "</p>";
        echo "</div>";

        echo "<div class='flex flex-col items-center justify-center w-[50%]'>";
        echo "<p class='w-full border p-2 text-center'> <strong>OBJETIVOS EDUCATIVOS ESPECÍFICOS:</strong></p>";
        echo "<ul class='w-full border'>";
            echo "<li <p class='w-full  p-2 text-start'>" .  $row['OBJETIVOS'] . "</li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='flex flex-col items-center justify-center w-[50%]'>";
        echo "<p class='w-full border p-2 text-center'><strong>PERCURSO:</strong></p>";
        echo "<ul class='w-full border'>";
            echo "<li class='w-full  p-2 text-start'>" . $row['PERCURSO'] . "</li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='flex w-[50%] items-stretch border'>";
        echo "<div class='flex flex-col items-center justify-center w-[30%] h-full'>";
        echo "<p class='w-full border p-2 text-start'><strong>RECURSOS:</strong></p>";
        echo "<ul class='w-full border'>";
             echo "<li class='w-full  p-2 text-start'>" . $row['RECURSOS']. "</li>";
        echo "</ul>";
        echo "</div>";
        echo "<div class='flex flex-col items-center justify-center w-[70%] h-full'>";
        echo "<p class='w-full border p-2 text-start'><strong>AVALIAÇÃO:</strong></p>";
        echo "<ul class='w-full border'>";
            echo "<li class='w-full  p-2 text-start'>" . $row['AVALIACAO'] . "</li>";
        echo "</div>";
        echo "<hr>";
        echo "</div>";
        echo "<a class='border bg-blue-400 rounded p-2 w-[10%] m-2 font-bold text-white' href='delete.php?ID=" . $row['ID'] . "'>Delete</a>";
        echo "<a class='border bg-blue-400 rounded p-2 w-[10%] m-2 font-bold text-white' href='editar.php?ID=" . $row['ID'] . "'>Editar</a>";
    }

}
?>
</body>

</html>