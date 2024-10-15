<?php
session_start(); // Inicie a sessão
date_default_timezone_set('America/Sao_Paulo');

// Verifique se o carrinho não está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header("Location: index.php"); // Redireciona para a página principal se o carrinho estiver vazio
    exit;
}

// Conexão com o banco de dados
$conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
mysqli_set_charset($conexao, 'utf8');

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Inicializa total
$total = 0;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Finalizar Compra</h1>
        <h2>Produtos no Carrinho</h2>
    </header>
    <section class="carrinho">
        
        <?php
        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
            // Realize a consulta para obter detalhes do produto
            $consulta = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto = $id_produto");
            $produto = mysqli_fetch_assoc($consulta);

            if ($produto) {
                $preco = $produto['preco'];
                $nome = $produto['nome'];
                $img = $produto['img'];
                $subtotal = $preco * $quantidade;
                $total += $subtotal; // Adiciona ao total
                ?>
                <div class="item-carrinho">
                    <h2><?php echo $nome; ?></h2>
                    <img src="<?php echo $img; ?>" alt="Imagem de <?php echo $nome; ?>" width="50%">
                    <p>Quantidade: <?php echo $quantidade; ?></p>
                    <p>Preço: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                </div>
                <?php
            }
        }
        ?>
        <div class="total">
            <h2>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h2>

            <img src="https://s.profissionaisti.com.br/wp-content/uploads/2011/07/QR-code.png" width="70%">
        
        <form action="processar_compra.php" method="POST">
            <input type="submit" value="Já fiz meu pagamento">
        </form>
        </div>
    </section>
</body>
</html>
