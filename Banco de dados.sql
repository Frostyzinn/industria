CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    cargo VARCHAR(100) NOT NULL,
    setor_id INT NOT NULL,
    FOREIGN KEY (setor_id) REFERENCES setores(id)
);

CREATE TABLE chamados_manutencao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'aberto',
    equipamento_id INT,
    user_id INT,
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE manutencoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipamento_id INT,
    funcionario_id INT,
    tipo VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    data_manutencao DATE NOT NULL,
    proxima_manutencao DATE,
    custo DECIMAL(10,2),
    status VARCHAR(20) NOT NULL DEFAULT 'pendente',
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id),
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
);

	CREATE TABLE ordens_producao (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    setor_id INT,
	    responsavel_id INT,
	    codigo_ordem VARCHAR(30) NOT NULL,
	    produto VARCHAR(100) NOT NULL,
	    quantidade_planejada INT NOT NULL,
	    quantidade_produzida INT NOT NULL DEFAULT 0,
	    data_inicio DATETIME,
	    data_fim DATETIME,
	    status VARCHAR(20) NOT NULL DEFAULT 'aberta',
	    observacoes TEXT,
	    FOREIGN KEY (setor_id) REFERENCES setores(id),
	    FOREIGN KEY (responsavel_id) REFERENCES funcionarios(id)
	);





