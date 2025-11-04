<?php
require_once 'config.php';

// Verificar se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Não autorizado']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $usuario_id = $_SESSION['usuario_id'];
        
        switch ($_POST['action']) {
            case 'criar':
                $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
                $setor = filter_var($_POST['setor'], FILTER_SANITIZE_STRING);
                $prioridade = $_POST['prioridade'];
                
                $stmt = $pdo->prepare("INSERT INTO tarefas (id_usuario, descricao, setor, prioridade) VALUES (?, ?, ?, ?)");
                $stmt->execute([$usuario_id, $descricao, $setor, $prioridade]);
                echo json_encode(['success' => true]);
                break;
                
            case 'listar':
                $stmt = $pdo->prepare("SELECT t.*, u.nome as usuario_nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id WHERE t.id_usuario = ? ORDER BY t.data_cadastro DESC");
                $stmt->execute([$usuario_id]);
                $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($tarefas);
                break;
                
            case 'atualizar':
                $id = $_POST['id'];
                $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
                $setor = filter_var($_POST['setor'], FILTER_SANITIZE_STRING);
                $prioridade = $_POST['prioridade'];
                $status = $_POST['status'];
                
                // Verificar se a tarefa pertence ao usuário
                $stmt = $pdo->prepare("SELECT id FROM tarefas WHERE id = ? AND id_usuario = ?");
                $stmt->execute([$id, $usuario_id]);
                
                if ($stmt->fetch()) {
                    $stmt = $pdo->prepare("UPDATE tarefas SET descricao = ?, setor = ?, prioridade = ?, status = ? WHERE id = ?");
                    $stmt->execute([$descricao, $setor, $prioridade, $status, $id]);
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada']);
                }
                break;
                
            case 'excluir':
                $id = $_POST['id'];
                
                // Verificar se a tarefa pertence ao usuário
                $stmt = $pdo->prepare("SELECT id FROM tarefas WHERE id = ? AND id_usuario = ?");
                $stmt->execute([$id, $usuario_id]);
                
                if ($stmt->fetch()) {
                    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ?");
                    $stmt->execute([$id]);
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada']);
                }
                break;
                
            case 'atualizar_status':
                $id = $_POST['id'];
                $status = $_POST['status'];
                
                // Verificar se a tarefa pertence ao usuário
                $stmt = $pdo->prepare("SELECT id FROM tarefas WHERE id = ? AND id_usuario = ?");
                $stmt->execute([$id, $usuario_id]);
                
                if ($stmt->fetch()) {
                    $stmt = $pdo->prepare("UPDATE tarefas SET status = ? WHERE id = ?");
                    $stmt->execute([$status, $id]);
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada']);
                }
                break;
        }
    }
}
?>