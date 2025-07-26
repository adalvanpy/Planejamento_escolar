<?php
session_start();
include 'conexao.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($email != "" && $senha != ""){
       $stmt = $conexao->prepare("SELECT * FROM usuario WHERE EMAIL = ?");
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $result = $stmt->get_result();

       if($result->num_rows == 1){
           $usuario = $result->fetch_assoc();
           if(password_verify($senha, $usuario['SENHA'])){
               $_SESSION['usuario'] = $usuario;
               header('location: exibir_planejamento.php');
               exit();
           }
           else{
               echo "Senha Incorreta";
           }

       }
       else{
           echo "Usuário não encontrado";
       }
    }
    else{
        echo "Preencha todos os campos";
    }
}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="flex items-center h-20 p-2">
    <li class="inline-block p-2"><a class="text-3xl inline-block p-2" href="index.php">Pagina inicial</a></li>
</header>
<main class="flex items-center justify-center border p-4">
    <form class=" mt-40 w-[50%] p-4" method="POST" action="login.php">
        <div class="flex flex-col items-center justify-center w-full p-4 gap-4">
          <input class=" p-2 border w-[50%]" type="email" name="email" placeholder="E-mail" required>
          <input class=" p-2 border w-[50%]" type="password" name="senha" placeholder="Senha" required>
          <button class=" p-2 text-center border w-[50%]" type="submit">Entrar</button>
          </div>
    </form>
</main>
</body>
</html>
