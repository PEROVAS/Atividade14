<?php
session_start();

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'kanban_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Se o banco não existir, criar
    if ($e->getCode() == 1049) {
        try {
            $pdo_temp = new PDO("mysql:host=$host", $user, $pass);
            $pdo_temp->exec("CREATE DATABASE $dbname");
            $pdo_temp->exec("USE $dbname");
            
            // Criar tabelas
            $pdo_temp->exec("
                CREATE TABLE usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    senha VARCHAR(255) NOT NULL,
                    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");
            
            $pdo_temp->exec("
                CREATE TABLE tarefas (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    id_usuario INT NOT NULL,
                    descricao TEXT NOT NULL,
                    setor VARCHAR(50) NOT NULL,
                    prioridade ENUM('baixa', 'media', 'alta') NOT NULL,
                    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    status ENUM('a_fazer', 'fazendo', 'pronto') DEFAULT 'a_fazer',
                    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
                )
            ");
            
            // Inserir usuário de teste
            $senha_hash = password_hash('123456', PASSWORD_DEFAULT);
            $stmt = $pdo_temp->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute(['Usuário Teste', 'teste@email.com', $senha_hash]);
            
            $pdo = $pdo_temp;
            
        } catch(PDOException $e2) {
            die("Erro ao criar banco: " . $e2->getMessage());
        }
    } else {
        die("Erro de conexão: " . $e->getMessage());
    }
}

// Função para verificar login
function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

// Função para logout
function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
    exit();
}
?>