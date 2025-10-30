# Gerenciamento de Tarefas - Aplicação PHP

Este projeto é uma aplicação simples de gerenciamento de tarefas desenvolvida em PHP para uma indústria alimentícia. Permite o cadastro de usuários e tarefas, além de gerenciar o status das tarefas em um formato kanban simplificado.

## Funcionalidades

- **Cadastro de Usuários**: Formulário para registrar novos usuários com validação de e-mail.
- **Cadastro de Tarefas**: Formulário para criar tarefas associadas a usuários, com seleção de setor e prioridade.
- **Gerenciamento de Tarefas**: Visualização das tarefas em três colunas (A Fazer, Fazendo, Pronto), com opções para editar, excluir e alterar status.
- **Menu Principal**: Navegação entre as telas do sistema.

## Estrutura do Banco de Dados

O banco de dados `gerenciamento_tarefas` inclui as seguintes tabelas:

- `Usuario`: Armazena informações dos usuários (id, nome, email, data_cadastro).
- `Tarefa`: Armazena tarefas (id, descrição, data_criação, id_setor, id_prioridade, id_status, id_usuario_vinculado).
- `Setor`: Tabela de setores (id, nome_setor).
- `Prioridade`: Tabela de prioridades (id, nome_prioridade).
- `StatusTarefa`: Tabela de status (id, nome_status).

## Instalação e Configuração

1. **Pré-requisitos**:
   - Servidor web com suporte a PHP (ex.: XAMPP, WAMP).
   - MySQL ou MariaDB.

2. **Configuração do Banco de Dados**:
   - Crie um banco de dados chamado `gerenciamento_tarefas` no MySQL.
   - Execute o script `db.sql` para criar as tabelas e inserir dados iniciais.

3. **Configuração da Aplicação**:
   - Coloque os arquivos do projeto na pasta `htdocs` do XAMPP (ou equivalente).
   - Verifique as configurações de conexão no arquivo `menu.php` (host, db, user, pass).

4. **Execução**:
   - Inicie o servidor Apache e MySQL no XAMPP.
   - Acesse `http://localhost/Atividade14/index.php` no navegador.

## Arquivos do Projeto

- `index.php`: Menu principal.
- `cadastro_usuario.php`: Tela de cadastro de usuários.
- `cadastro_tarefa.php`: Tela de cadastro/edição de tarefas.
- `gerenciamento_tarefas.php`: Tela de gerenciamento de tarefas (kanban).
- `menu.php`: Conexão com o banco de dados.
- `db.sql`: Script SQL para criação do banco de dados.
- `der.txt`: Descrição do Diagrama Entidade-Relacionamento.
- `caso_uso.txt`: Descrição do Diagrama de Caso de Uso.
- `README.md`: Este arquivo de documentação.
- `TODO.md`: Lista de tarefas do desenvolvimento.

## Diagramas

- **DER (Diagrama Entidade-Relacionamento)**: Descrito em `der.txt`, representa as entidades, atributos e relacionamentos do banco de dados.
- **Caso de Uso**: Descrito em `caso_uso.txt`, ilustra os atores e interações no sistema.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação para o backend.
- **MySQL**: Banco de dados.
- **PDO**: Extensão para acesso ao banco de dados.
- **HTML/CSS**: Para a interface web.

## Regras de Negócio Implementadas

- Todos os campos de cadastro são obrigatórios.
- E-mail deve ser válido.
- Status inicial de tarefas é "A Fazer".
- Um usuário pode ter múltiplas tarefas; uma tarefa pertence a um usuário.
- Gerenciamento permite visualizar, editar, excluir e alterar status das tarefas.

## Desenvolvimento

Este projeto foi desenvolvido como atividade prática para um curso técnico básico, focando em conceitos fundamentais de PHP, SQL e desenvolvimento web.
