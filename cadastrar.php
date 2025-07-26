<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['NOME'];
    $email = $_POST['EMAIL'];
    $senha = password_hash($_POST['SENHA'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (NOME, EMAIL, SENHA) VALUES ('$nome', '$email', '$senha')";
    if ($conexao->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
        header("location: login.php");
    }
    else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }

}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="flex items-center h-20 p-2">
    <li class="inline-block p-2"><a class="text-3xl inline-block p-2" href="index.php">Pagina inicial</a></li>
</header>
<main class="flex items-center justify-center border p-4">
<form class=" mt-40 w-[50%] p-4" method="POST" action="cadastrar.php" enctype="multipart/form-data">
    <div class="flex flex-col items-center justify-center w-full p-4 gap-4">
      <input class=" p-2 border w-[50%]" type="text" name="NOME" placeholder="Nome" required>
      <input class=" p-2 border w-[50%]" type="email" name="EMAIL" placeholder="Email" required>
      <input class=" p-2 border w-[50%]" type="password" name="SENHA" placeholder="Senha" required>
      <button class=" p-2 border w-[50%]" type="submit">Cadastrar</button>
    </div>
</form>
</main>
</body>
</html>
