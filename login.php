<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Kanban</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-form">
            <h2><i class="fas fa-tasks"></i> Sistema Kanban</h2>
            
            <form id="loginForm">
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
            
            <p>Não tem conta? <a href="cadastro_usuario.php">Cadastre-se</a></p>
            
            <div id="message" class="message"></div>
        </div>
    </div>

    <script src="auth.js"></script>
</body>
</html>