<?php
session_start(); // Inicie a sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Carrinho</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Seu Carrinho</h1>
    </header>
    <section class="carrinho">
        <?php
        // Verifique se o carrinho não está vazio
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            $total = 0;

            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                // Realize a consulta para obter detalhes do produto
                $conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
                mysqli_set_charset($conexao, 'utf8');

                if (!$conexao) {
                    die("Conexão falhou: " . mysqli_connect_error());
                }

                $consulta = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto = $id_produto");
                $produto = mysqli_fetch_assoc($consulta);

                if ($produto) {
                    $preco = $produto['preco'];
                    $nome = $produto['nome'];
                    $img = $produto['img'];
                    $subtotal = $preco * $quantidade;
                    $total += $subtotal;
                    ?>
                    <div class="item-carrinho">
                        <h2><?php echo $nome; ?></h2>
                        <img src="<?php echo $img; ?>" alt="Imagem de <?php echo $nome; ?>" width="50%">
                        <p>Quantidade: <?php echo $quantidade; ?></p>
                        <p>Preço: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                        <button><a href="carrinho.php?action=remove&id=<?php echo $id_produto; ?>">Remover</a></button>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="total">
                <h2>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h2>
            
            <form action="finalizar.php" method="GET">
            <input type="submit" value="Finalizar Compra">
            </form>
            </div>
            <a href="index.php">Voltar</a>
            <?php
        } else {
            echo "<p>Seu carrinho está vazio.</p>";
        }
        ?>
    </section>
</body>
</html>
