<?php
session_start(); // Inicie a sessão

// Conexão com o banco de dados
$conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
mysqli_set_charset($conexao, 'utf8');

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifique se o carrinho não está vazio
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
        // Obtenha os detalhes do produto
        $consulta = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto = $id_produto");
        $produto = mysqli_fetch_assoc($consulta);

        if ($produto) {
            $nome_produto = $produto['nome'];
            $status = "andamento"; // Definindo o status como "Em Andamento"

            // Insira os dados na tabela de pedidos
            $query = "INSERT INTO pedidos (nome_produto, quantidade, status) VALUES ('$nome_produto', $quantidade, '$status')";
            mysqli_query($conexao, $query) or die("Erro: " . mysqli_error($conexao));
        }
    }

    // Limpe o carrinho após finalizar a compra
    unset($_SESSION['carrinho']);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Concluída</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Compra Concluída</h1>
    </header>
    <section class="compra-concluida">
        <h2>Obrigado pela sua compra!</h2>
        <p>Seu pedido foi processado com sucesso.</p>
        <a href="index.php">Voltar à Página Principal</a>
    </section>
</body>
</html>
<?php
}else{
    echo "Erro";
}
// Fechar a conexão
mysqli_close($conexao);
?>