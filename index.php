<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    $conexao = mysqli_connect('localhost', 'root', '', 'sistema_restaurante');
    mysqli_set_charset($conexao, 'utf8');

    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $consulta = mysqli_query($conexao, "SELECT * FROM produto") or die("Erro: " . mysqli_error($conexao));
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <header>
        <h1>Produtos Disponíveis</h1>
    </header>

    <section class="produtos">
        <center><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Burger_King_2020.svg/1879px-Burger_King_2020.svg.png" width='15%'></center>
        
        <?php while ($dados = mysqli_fetch_assoc($consulta)) { 
            $id = $dados['id_produto'];
            $nome = $dados['nome'];
            $preco = $dados['preco'];
            $img = $dados['img'];
        ?>
        
        <div class="produto">
            <img src="<?php echo $img; ?>" alt="Imagem de <?php echo $nome; ?>">
            <h2><?php echo $nome; ?></h2>
            <p>R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
            <a href="produto.php?id=<?php echo $id; ?>">Ver mais detalhes</a>
            <button><a href="index.php?action=add&id=<?php echo $id; ?>">Adicionar ao carrinho</a></button>
        </div>
        
        <?php } ?>
    </section>

</body>
</html>
