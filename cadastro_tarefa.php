<?php
include 'menu.php';

$message = '';
$edit = false;
$tarefa = null;

if (isset($_GET['id'])) {
    $edit = true;
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Tarefa WHERE id_tarefa = ?");
    $stmt->execute([$id]);
    $tarefa = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = trim($_POST['descricao']);
    $id_setor = $_POST['id_setor'];
    $id_prioridade = $_POST['id_prioridade'];
    $id_usuario = $_POST['id_usuario'];
    $id_status = $edit ? $_POST['id_status'] : 1; 

    if (empty($descricao) || empty($id_setor) || empty($id_prioridade) || empty($id_usuario)) {
        $message = 'Todos os campos são obrigatórios.';
    } else {
        try {
            if ($edit) {
                $stmt = $pdo->prepare("UPDATE Tarefa SET descricao = ?, id_setor = ?, id_prioridade = ?, id_status = ?, id_usuario_vinculado = ? WHERE id_tarefa = ?");
                $stmt->execute([$descricao, $id_setor, $id_prioridade, $id_status, $id_usuario, $tarefa['id_tarefa']]);
                $message = 'Tarefa atualizada com sucesso!';
            } else {
                $stmt = $pdo->prepare("INSERT INTO Tarefa (descricao, id_setor, id_prioridade, id_status, id_usuario_vinculado) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$descricao, $id_setor, $id_prioridade, $id_status, $id_usuario]);
                $message = 'Tarefa cadastrada com sucesso!';
            }
        } catch (PDOException $e) {
            $message = 'Erro: ' . $e->getMessage();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $edit ? 'Editar' : 'Cadastro de'; ?> Tarefa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        textarea { height: 100px; }
        button { margin-top: 20px; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { color: green; text-align: center; margin-top: 20px; }
        .error { color: red; }
        a { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <h1><?php echo $edit ? 'Editar' : 'Cadastro de'; ?> Tarefa</h1>
    <form method="post">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo $edit ? htmlspecialchars($tarefa['descricao']) : ''; ?></textarea>

        <label for="id_setor">Setor:</label>
        <select id="id_setor" name="id_setor" required>
            <option value="">Selecione</option>
            <?php foreach ($setores as $setor): ?>
                <option value="<?php echo $setor['id_setor']; ?>" <?php echo $edit && $tarefa['id_setor'] == $setor['id_setor'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($setor['nome_setor']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="id_prioridade">Prioridade:</label>
        <select id="id_prioridade" name="id_prioridade" required>
            <option value="">Selecione</option>
            <?php foreach ($prioridades as $prioridade): ?>
                <option value="<?php echo $prioridade['id_prioridade']; ?>" <?php echo $edit && $tarefa['id_prioridade'] == $prioridade['id_prioridade'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($prioridade['nome_prioridade']); ?></option>
            <?php endforeach; ?>
        </select>

        <?php if ($edit): ?>
        <label for="id_status">Status:</label>
        <select id="id_status" name="id_status" required>
            <option value="">Selecione</option>
            <?php foreach ($statuses as $status): ?>
                <option value="<?php echo $status['id_status']; ?>" <?php echo $tarefa['id_status'] == $status['id_status'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($status['nome_status']); ?></option>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>

        <label for="id_usuario">Usuário:</label>
        <select id="id_usuario" name="id_usuario" required>
            <option value="">Selecione</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo $edit && $tarefa['id_usuario_vinculado'] == $usuario['id_usuario'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($usuario['nome']); ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit"><?php echo $edit ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    <?php if ($message): ?>
        <p class="message <?php echo strpos($message, 'Erro') === 0 ? 'error' : ''; ?>"><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="gerenciamento_tarefas.php">Voltar ao Gerenciamento</a>
</body>
</html>
