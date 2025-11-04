<?php
require_once 'config.php';
verificarLogin();

if ($_POST['action'] == 'criar') {
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $usuario_id = $_SESSION['usuario_id'];
    
    $stmt = $pdo->prepare("INSERT INTO tarefas (id_usuario, descricao, setor, prioridade) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $descricao, $setor, $prioridade]);
    echo json_encode(['success' => true]);
}

if ($_POST['action'] == 'listar') {
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $pdo->prepare("SELECT t.*, u.nome as usuario_nome FROM tarefas t 
                          JOIN usuarios u ON t.id_usuario = u.id 
                          WHERE t.id_usuario = ? ORDER BY t.data_cadastro DESC");
    $stmt->execute([$usuario_id]);
    $tarefas = $stmt->fetchAll();
    echo json_encode($tarefas);
}

if ($_POST['action'] == 'atualizar') {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE tarefas SET descricao = ?, setor = ?, prioridade = ?, status = ? WHERE id = ?");
    $stmt->execute([$descricao, $setor, $prioridade, $status, $id]);
    echo json_encode(['success' => true]);
}

if ($_POST['action'] == 'excluir') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
}

if ($_POST['action'] == 'atualizar_status') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE tarefas SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    echo json_encode(['success' => true]);
}
?>