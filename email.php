<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];
            
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
            }
        }
        
        if ($_POST['action'] === 'cadastrar') {
            $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            
            // Validar email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Email inválido']);
                exit;
            }
            
            try {
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $senha]);
                
                // Logar automaticamente após cadastro
                $usuario_id = $pdo->lastInsertId();
                $_SESSION['usuario_id'] = $usuario_id;
                $_SESSION['usuario_nome'] = $nome;
                
                echo json_encode(['success' => true]);
            } catch(PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo json_encode(['success' => false, 'message' => 'Este email já está cadastrado']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro no cadastro: ' . $e->getMessage()]);
                }
            }
        }
    }
}
?>