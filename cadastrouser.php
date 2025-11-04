<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema Kanban</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-form">
            <h2><i class="fas fa-user-plus"></i> Cadastro de Usuário</h2>
            
            <form id="cadastroForm">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" name="senha" required minlength="6">
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
            
            <p>Já tem conta? <a href="login.php">Faça login</a></p>
            
            <div id="message" class="message"></div>
        </div>
    </div>

    <script src="auth.js"></script>
</body>
</html>