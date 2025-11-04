<?php
require_once 'config.php';
verificarLogin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Tarefa - Sistema Kanban</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1><i class="fas fa-tasks"></i> Nova Tarefa</h1>
            <div class="nav-links">
                <a href="index.php" class="btn">Voltar</a>
                <a href="?logout=true" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <form id="tarefaForm">
                <div class="form-group">
                    <label>Descrição da Tarefa:</label>
                    <textarea name="descricao" required></textarea>
                </div>
                
                <div class="form-group">
                    <label>Setor:</label>
                    <input type="text" name="setor" required>
                    <small>Dica: Use o CEP para buscar cidade/estado</small>
                    <div class="api-actions">
                        <input type="text" id="cep_input" placeholder="Digite um CEP (ex: 01001000)">
                        <button type="button" id="buscar_cep" class="btn btn-info">Buscar por CEP</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Prioridade:</label>
                    <select name="prioridade" required>
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>

                <div class="api-section">
                    <button type="button" id="sugerir_atividade" class="btn btn-secondary">
                        <i class="fas fa-magic"></i> Sugerir Atividade
                    </button>
                    <div id="sugestao_atividade" class="sugestao"></div>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Tarefa</button>
            </form>
            
            <div id="message" class="message"></div>
        </div>
    </div>

    <script src="tarefas.js"></script>
</body>
</html>

<?php
if (isset($_GET['logout'])) {
    logout();
}
?>