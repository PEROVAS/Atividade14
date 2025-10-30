<?php
include 'menu.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    if (empty($nome) || empty($email)) {
        $message = 'Todos os campos são obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'E-mail inválido.';
    } else {
        try {
            
        } catch (PDOException $e) {
            $message = 'Erro ao cadastrar: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { color: green; text-align: center; margin-top: 20px; }
        .error { color: red; }
        a { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Cadastrar</button>
    </form>
    <?php if ($message): ?>
        <p class="message <?php echo strpos($message, 'Erro') === 0 ? 'error' : ''; ?>"><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="index.php">Voltar ao Menu</a>
</body>
</html>
