<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
    header("Location: index.php"); // Redireciona para a página do cardápio se já estiver logado
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação da Reserva</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="about-section">
        <?php 
        // Captura os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Conexão ao banco de dados
        $conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
        mysqli_set_charset($conexao, 'utf8');

        // Verificação de erro na conexão
        if (!$conexao) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        // Consulta ao banco de dados
        $consulta = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email'") or die("Erro na consulta");

        // Verifica se o usuário existe
        if (mysqli_num_rows($consulta) == 0) {
            echo '<div class="resultadoruim">E-mail não encontrado.</div>';
        } else {
            // Usuário encontrado, agora verifica a senha
            $usuario = mysqli_fetch_assoc($consulta);
            
            // Se a senha estiver armazenada usando password_hash, use password_verify
            if (password_verify($senha, $usuario['senha'])) {
                // Autenticação bem-sucedida
                $_SESSION['username'] = $usuario['username']; // Armazena o nome do usuário na sessão
                echo '<div class="resultadobom">Você foi logado com sucesso!</div>';
                echo '<p>Ir para o cardápio <a href="index.php">Clique aqui</a></p>';
                exit(); // Saia do script para evitar qualquer saída adicional
            } else {
                echo '<div class="resultadoruim">Senha incorreta.</div>';
            }
        }

        // Fecha a conexão
        mysqli_close($conexao);
        ?>
    </div>
</body>
</html>
