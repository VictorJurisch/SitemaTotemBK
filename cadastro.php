<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Adicione isso ao seu styles.css para estilos específicos da página de cadastro */
.login-section {
    background-color: #f9f9f9; /* Cor de fundo para a seção de cadastro */
    padding: 40px 20px; /* Adiciona espaço interno */
    border-radius: 8px; /* Bordas arredondadas */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

.container {
    max-width: 400px; /* Largura máxima da caixa de cadastro */
    margin: 0 auto; /* Centraliza a caixa na página */
}

h2 {
    text-align: center; /* Centraliza o título */
    color: #333; /* Cor do texto */
}

.form-group {
    margin-bottom: 15px; /* Espaçamento entre os campos */
}

label {
    display: block; /* Faz o rótulo ocupar toda a largura */
    margin-bottom: 5px; /* Espaçamento abaixo do rótulo */
    color: #555; /* Cor do rótulo */
}

input {
    width: 100%; /* Largura total para os campos de entrada */
    padding: 10px; /* Espaçamento interno */
    border: 1px solid #ddd; /* Borda do campo */
    border-radius: 5px; /* Bordas arredondadas */
    box-sizing: border-box; /* Inclui padding e borda na largura total */
}

input:focus {
    border-color: #28a745; /* Cor da borda ao focar no campo */
    outline: none; /* Remove o contorno padrão do navegador */
}

.btn {
    background-color: #28a745; /* Cor de fundo do botão */
    color: white; /* Cor do texto do botão */
    border: none; /* Remove a borda padrão */
    padding: 10px; /* Espaçamento interno do botão */
    cursor: pointer; /* Muda o cursor ao passar sobre o botão */
    width: 100%; /* Largura total do botão */
    border-radius: 5px; /* Bordas arredondadas do botão */
}

.btn:hover {
    background-color: #218838; /* Cor do botão ao passar o mouse */
}

.register-text {
    text-align: center; /* Centraliza o texto de registro */
    margin-top: 15px; /* Espaçamento acima do texto de registro */
}

    </style>
</head>
<body>

    <section id="login" class="login-section">
        <header>
            <h1>Cadastro</h1>
        </header>
        <div class="container">
            <form action="processa_cadastro.php" method="POST" class="form-login">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn">Cadastrar</button>
                <p class="register-text">Já possui uma conta? <a href="login.php">Logar</a></p>
            </form>
        </div>
    </section>
</body>
</html>
