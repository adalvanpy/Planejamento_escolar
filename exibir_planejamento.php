<?php
session_start();
include 'conexao.php';
if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
}
else {
    header("Location: login.php");
    exit();
}
$sql = "SELECT ID_PLANEJAMENTO, DATA, COMP_CURRICULAR, UN_TEMATICA, TURMA, UNIDADE, OBJETIVOS, PERCURSO, RECURSOS, AVALIACAO FROM planejamento";
$result = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usando php</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center w-full p-6">
<header class="flex items-center justify-end h-20 p-2 border w-full bg-white">
    <li class=" text-blue-500 inline-block text-2xl p-2"><a href="criar_planejamento.php">Criar Planejamento</a></li>
    <p class="text-2xl text-center text-white  p-2 bg-blue-300 rounded-full w-12 h-12"><?= substr($usuario['NOME'], 0, 1) ?></p>
    <a href="logout.php" class="text-2xl text-blue-500 p-2">Sair</a>
</header>
<main class="w-full flex flex-col items-center justify-center">
<?php if ($result->num_rows > 0) { ?>
    <div class='flex items-center justify-center p-4 w-[50%]'>
        <h2 class='bg-blue-400 p-2 w-[30%] text-center rounded text-white font-bold'>Meus Planejamentos:</h2>
    </div>
    <?php while($row = $result->fetch_assoc()) { ?>
     <div class='flex flex-col items-center justify-center p-4 w-full bg-white '>
         <table class="w-[50%] border border-gray-300 text-left mt-4">
             <thead class="bg-blue-200">
             <tr>
                 <th class="p-2 border">COMPONENTE CURRICULAR</th>
                 <th class="p-2 border"></th>
                 <th class="p-2 border"></th>
                 <th class="p-2 border"></th>
                 <th class="p-2 border"></th>
             </tr>
             </thead>
             <tbody>
             <tr class="hover:bg-gray-100">
                 <td class="p-2 border"><?= $row["COMP_CURRICULAR"] ?></td>
                 <td class="p-2 border"><a href='editar.php?ID=<?= $row['ID_PLANEJAMENTO'] ?>'
                             class="text-blue-600 hover:underline cursor-pointer">Editar</a></td>
                 <td class="p-2 border"><a href='delete.php?ID=<?= $row['ID_PLANEJAMENTO'] ?>'
                             class="text-blue-600 hover:underline cursor-pointer">Excluir</a></td>
                 <td class="p-2 border">
                     <button onclick="exibirP('<?=$row['ID_PLANEJAMENTO']?>')" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                         Exibir
                     </button>
                 <td class="p-2 border text-blue-600 underline">
                     <a href="#" onclick="baixarPdf(<?=$row['ID_PLANEJAMENTO']?>)">
                         Baixar
                     </a>
                 </td>
             </tr>
             </tbody>
         </table>
        <div id="<?=$row['ID_PLANEJAMENTO']?>" class='flex hidden flex-col items-center justify-center w-full mt-4'>
            <div class='flex items-center justify-center w-[50%]'>
                <p class='w-[60%] border p-2 text-start'><strong>DATA:</strong> <?= $row['DATA'] ?></p>
                <p class='w-[40%] border p-2 text-start'><strong>TURMA:</strong> <?= $row['TURMA'] ?></p>
            </div>

            <div class='flex items-center justify-center w-[50%]'>
                <p class='w-[70%] border p-2 text-start'><strong>COMPONENTE CURRICULAR:</strong> <?= $row['COMP_CURRICULAR'] ?></p>
                <p class='w-[30%] border p-2 text-start'><strong>UNIDADE:</strong> <?= $row['UNIDADE'] ?></p>
            </div>

            <div class='w-[50%]'>
                <p class='w-full border p-2 text-start'><strong>UNIDADE TEMÁTICA:</strong> <?= $row['UN_TEMATICA'] ?></p>
            </div>

            <div class='flex flex-col items-center justify-center w-[50%]'>
                <p class='w-full border p-2 text-center'><strong>OBJETIVOS EDUCATIVOS ESPECÍFICOS:</strong></p>
                <ul class='w-full border'>
                    <li class='w-full p-2 text-start'><?= $row['OBJETIVOS'] ?></li>
                </ul>
            </div>

            <div class='flex flex-col items-center justify-center w-[50%]'>
                <p class='w-full border p-2 text-center'><strong>PERCURSO:</strong></p>
                <ul class='w-full border'>
                    <li class='w-full p-2 text-start'><?= $row['PERCURSO'] ?></li>
                </ul>
            </div>

            <div class='flex w-[50%] items-stretch border'>
                <div class='flex flex-col items-center justify-center w-[30%] h-full'>
                    <p class='w-full border p-2 text-start'><strong>RECURSOS:</strong></p>
                    <ul class='w-full border'>
                        <li class='w-full p-2 text-start'><?= $row['RECURSOS'] ?></li>
                    </ul>
                </div>
                <div class='flex flex-col items-center justify-center w-[70%] h-full'>
                    <p class='w-full border p-2 text-start'><strong>AVALIAÇÃO:</strong></p>
                    <ul class='w-full border'>
                        <li class='w-full p-2 text-start'><?= $row['AVALIACAO'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
     </div>
    <?php } ?>
<?php } ?>
</main>
<script>
    function exibirP(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }

    function baixarPdf(id) {
        const conteudo = document.getElementById(id);
        if (!conteudo) return alert('Elemento não encontrado');

        conteudo.classList.add('w-full', 'max-w-none');

        html2pdf()
            .set({
                margin: 0,
                filename: 'planejamento.pdf',
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            })
            .from(conteudo)
            .save();
    }
</script>
</body>
</html>