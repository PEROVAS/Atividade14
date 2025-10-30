CREATE TABLE StatusTarefa (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    nome_status VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO StatusTarefa (nome_status) VALUES ('A Fazer'), ('Fazendo'), ('Pronto');

CREATE TABLE Prioridade (
    id_prioridade INT PRIMARY KEY AUTO_INCREMENT,
    nome_prioridade VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Prioridade (nome_prioridade) VALUES ('Baixa'), ('Média'), ('Alta');

CREATE TABLE Setor (
    id_setor INT PRIMARY KEY AUTO_INCREMENT,
    nome_setor VARCHAR(100) NOT NULL UNIQUE
);
INSERT INTO Setor (nome_setor) VALUES ('Financeiro');

CREATE TABLE Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarefa (
    id_tarefa INT PRIMARY KEY AUTO_INCREMENT,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    id_setor INT NOT NULL,
    id_prioridade INT NOT NULL,
    id_status INT NOT NULL,
    id_usuario_vinculado INT NOT NULL, 
    
    FOREIGN KEY (id_setor) REFERENCES Setor(id_setor),
    FOREIGN KEY (id_prioridade) REFERENCES Prioridade(id_prioridade),
    FOREIGN KEY (id_status) REFERENCES StatusTarefa(id_status),
    FOREIGN KEY (id_usuario_vinculado) REFERENCES Usuario(id_usuario)
);

