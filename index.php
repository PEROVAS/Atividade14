<?php
require_once 'config.php';

// Verificar se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    logout();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban - Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1><i class="fas fa-tasks"></i> Sistema Kanban</h1>
            <div class="nav-links">
                <span>Olá, <?php echo $_SESSION['usuario_nome']; ?></span>
                <a href="cadastro_tarefas.php" class="btn">Nova Tarefa</a>
                <a href="?logout=true" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="kanban-board">
            <div class="column" data-status="a_fazer">
                <h3>A Fazer</h3>
                <div class="tasks" id="a_fazer_tasks"></div>
            </div>
            
            <div class="column" data-status="fazendo">
                <h3>Fazendo</h3>
                <div class="tasks" id="fazendo_tasks"></div>
            </div>
            
            <div class="column" data-status="pronto">
                <h3>Pronto</h3>
                <div class="tasks" id="pronto_tasks"></div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Editar Tarefa</h3>
            <form id="editForm">
                <input type="hidden" id="edit_id">
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea id="edit_descricao" required></textarea>
                </div>
                <div class="form-group">
                    <label>Setor:</label>
                    <input type="text" id="edit_setor" required>
                </div>
                <div class="form-group">
                    <label>Prioridade:</label>
                    <select id="edit_prioridade" required>
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                <button type="submit" class="btn">Salvar</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
if (isset($_GET['logout'])) {
    logout();
}
?>