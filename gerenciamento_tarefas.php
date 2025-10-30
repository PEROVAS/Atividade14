<?php
include 'menu.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM Tarefa WHERE id_tarefa = ?");
    $stmt->execute([$id]);
    header('Location: gerenciamento_tarefas.php');
    exit;
}

// Handle status change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])) {
    $id = $_POST['id_tarefa'];
    $new_status = $_POST['new_status'];
    $stmt = $pdo->prepare("UPDATE Tarefa SET id_status = ? WHERE id_tarefa = ?");
    $stmt->execute([$new_status, $id]);
    header('Location: gerenciamento_tarefas.php');
    exit;
}




?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .kanban { display: flex; justify-content: space-around; }
        .column { width: 30%; border: 1px solid #ccc; padding: 10px; background: #f9f9f9; }
        .task { border: 1px solid #ddd; padding: 10px; margin: 10px 0; background: white; }
        .task p { margin: 5px 0; }
        .buttons { margin-top: 10px; }
        .buttons a, .buttons form { display: inline; margin-right: 10px; }
        button { padding: 5px 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .delete { background: #dc3545; }
        .delete:hover { background: #c82333; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        .menu-link { display: block; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Gerenciamento de Tarefas</h1>
    <div class="kanban">
        <?php
        $status_names = ['A Fazer', 'Fazendo', 'Pronto'];
        foreach ($status_names as $status_name) {
            echo "<div class='column'><h2>$status_name</h2>";
            foreach ($tarefas as $tarefa) {
                if ($tarefa['nome_status'] == $status_name) {
                    echo "<div class='task'>";
                    echo "<p><strong>Descrição:</strong> " . htmlspecialchars($tarefa['descricao']) . "</p>";
                    echo "<p><strong>Setor:</strong> " . htmlspecialchars($tarefa['nome_setor']) . "</p>";
                    echo "<p><strong>Prioridade:</strong> " . htmlspecialchars($tarefa['nome_prioridade']) . "</p>";
                    echo "<p><strong>Usuário:</strong> " . htmlspecialchars($tarefa['usuario_nome']) . "</p>";
                    echo "<div class='buttons'>";
                    echo "<a href='cadastro_tarefa.php?id=" . $tarefa['id_tarefa'] . "'>Editar</a>";
                    echo "<a href='gerenciamento_tarefas.php?delete=" . $tarefa['id_tarefa'] . "' onclick='return confirm(\"Tem certeza que deseja excluir?\")' class='delete'>Excluir</a>";
                    echo "<form method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='id_tarefa' value='" . $tarefa['id_tarefa'] . "'>";
                    echo "<select name='new_status' required>";
                    foreach ($statuses as $status) {
                        if ($status['nome_status'] != $status_name) {
                            echo "<option value='" . $status['id_status'] . "'>" . htmlspecialchars($status['nome_status']) . "</option>";
                        }
                    }
                    echo "</select>";
                    echo "<button type='submit' name='change_status'>Alterar Status</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            echo "</div>";
        }
        ?>
    </div>
    <a href="index.php" class="menu-link">Voltar ao Menu</a>
</body>
</html>
