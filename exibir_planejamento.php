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
    echo "<h2>Meus Planejamentos:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='planejamento flex flex-col items-center justify-center'>";
        echo "<p class='hidden'><strong>ID:</strong>" . htmlspecialchars($row["ID"]) . "</p>";

        echo "<div class='flex items-center justify-center w-[70%]'>";
        echo "<p class='w-[70%] border p-2 text-start'><strong>DATA:</strong> " . htmlspecialchars($row['DATA']) . "</p>";
        echo "<p class='w-[30%] border p-2 text-start'><strong>TURMA:</strong> " . htmlspecialchars($row['TURMA']) . "</p>";
        echo "</div>";

        echo "<div class='flex items-center justify-center w-[70%]'>";
        echo "<p class='w-[80%] border p-2 text-start'><strong>COMPONENTE CURRICULAR:</strong> " . htmlspecialchars($row['COMP_CURRICULAR']) . "</p>";
        echo "<p class='w-[20%] border p-2 text-start'><strong>UNIDADE:</strong> " . htmlspecialchars($row['UNIDADE']) . "</p>";
        echo "</div>";

        echo "<div class='w-[70%]'>";
        echo "<p class='w-full border p-2 text-start'><strong>UNIDADE TEMÁTICA:</strong> " . htmlspecialchars($row['UN_TEMATICA']) . "</p>";
        echo "</div>";

        echo "<div class='flex flex-col items-center justify-center w-[70%]'>";
        echo "<p class='w-full border p-2 text-center'> <strong>OBJETIVOS EDUCATIVOS ESPECÍFICOS:</strong></p>";
        echo "<p class='w-full border p-2 text-start'>" . htmlspecialchars($row['OBJETIVOS']) . "</p>";
        echo "</div>";

        echo "<div class='flex flex-col items-center justify-center w-[70%]'>";
        echo "<p class='w-full border p-2 text-center'><strong>PERCURSO:</strong></p>";
        echo "<p class='w-full border p-2 text-start'>" . htmlspecialchars($row['PERCURSO']) . "</p>";
        echo "</div>";

        echo "<div class='flex w-[70%] items-stretch'>";
        echo "<div class='flex flex-col items-center justify-center w-[50%] h-full'>";
        echo "<p class='w-full border p-2 text-start'><strong>RECURSOS:</strong></p>";
        echo "<p class='w-full border p-2 text-start'>" . htmlspecialchars($row['RECURSOS']) . "</p>";
        echo "</div>";
        echo "<div class='flex flex-col items-center justify-center w-[50%] h-full'>";
        echo "<p class='w-full border p-2 text-start'><strong>AVALIAÇÃO:</strong></p>";
        echo "<p class='w-full border p-2 text-start'>". htmlspecialchars($row['AVALIACAO']) . "</p>";
        echo "</div>";
        echo "<hr>";
        echo "</div>";
        echo "<a class='border bg-blue-400 rounded p-2 w-[10%] m-2' href='delete.php?id=" . $row['ID'] . "'>Delete</a>";
    }
} else {
    echo "<p>Nenhum planejamento encontrado.</p>";
}
?>
</body>

</html>