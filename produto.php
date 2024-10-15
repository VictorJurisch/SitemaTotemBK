<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="styles.css">
    <?php
session_start(); // Inicie a sessão no início do arquivo

date_default_timezone_set('America/Sao_Paulo');
$conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
mysqli_set_charset($conexao, 'utf8');

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$consulta = mysqli_query($conexao, "SELECT * FROM produto") or die("Erro: " . mysqli_error($conexao));
$total_linhas = $consulta->num_rows;

// Adicione um novo produto ao carrinho
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $id_produto = intval($_GET['id']);
    $quantidade = 1; // Você pode alterar isso para permitir que o usuário escolha a quantidade

    // Verifique se o carrinho já existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adicione o produto ao carrinho
    if (array_key_exists($id_produto, $_SESSION['carrinho'])) {
        $_SESSION['carrinho'][$id_produto] += $quantidade; // Aumenta a quantidade se o produto já estiver no carrinho
    } else {
        $_SESSION['carrinho'][$id_produto] = $quantidade; // Adiciona o novo produto
    }

    // Redirecionar para a página do carrinho
    header("Location: carrinho.php");
    exit; 
}
?>
</head>
<body>
    <?php 

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            die("ID do produto não informado.");
        }

        $consulta = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto = $id") or die("Erro: " . mysqli_error($conexao));
        $produto = mysqli_fetch_assoc($consulta);

        if (!$produto) {
            die("Produto não encontrado.");
        }
        
        $nome = $produto['nome'];
        $preco = $produto['preco'];
        $imagem = $produto['img']; 
        $descricao = $produto['descricao'];

    ?>

    <header>
        <h1>Detalhes do Produto</h1>
    </header>

    <section class="detalhes-produto">
        <div class="imagem-produto">
            <img src="<?php echo $imagem; ?>" alt="Imagem de <?php echo $nome; ?>">
        </div>
        <div class="info-produto">

            <h2><?php echo $nome; ?></h2>
            <p class="preco">R$ <?php echo $preco; ?></p>
            <p class="descricao"><?php echo $descricao; ?></p> 
            <button><a href="index.php?action=add&id=<?php echo $id; ?>">Adicionar ao carrinho</a></button><br><br>
            <a href="index.php">Voltar</a>
        </div>
    </section>
</body>
</html>
