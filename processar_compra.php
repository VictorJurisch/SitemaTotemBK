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
    // Defina o status do pedido
    $status = "andamento"; // Definindo o status como "Em Andamento"

    // Primeiro insira os dados na tabela pedido
    $query_pedido = "INSERT INTO pedido (status) VALUES ('$status')";
    if (mysqli_query($conexao, $query_pedido)) {
        // Recupere o ID do pedido recém-criado
        $id_pedido = mysqli_insert_id($conexao);

        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
            // Obtenha os detalhes do produto
            $consulta = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto = $id_produto");
            $produto = mysqli_fetch_assoc($consulta);

            if ($produto) {
                // Insira os dados na tabela produto_pedido
                $query_produto_pedido = "INSERT INTO produto_pedido (id_pedido, id_produto, quantidade) VALUES ('$id_pedido', '$id_produto', '$quantidade')";
                mysqli_query($conexao, $query_produto_pedido);
            }
        }

        // Limpe o carrinho após finalizar a compra
        unset($_SESSION['carrinho']);
    } else {
        echo "Erro ao processar o pedido.";
    }
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
} else {
    echo "Carrinho está vazio.";
}

// Fechar a conexão
mysqli_close($conexao);
?>
