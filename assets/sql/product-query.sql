CREATE TABLE categorias
(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE produtos
(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  preco DOUBLE(9,2) NOT NULL,
  descricao VARCHAR(1000) NOT NULL,
  caracteristicas VARCHAR(500) NOT NULL,
  imagem VARCHAR(150) NOT NULL,
  categoria_id INT NOT NULL,
  PRIMARY KEY(id)
);

ALTER TABLE produtos ADD CONSTRAINT fk_categorias FOREIGN KEY (categoria_id) REFERENCES categorias(id);

INSERT INTO categorias (nome) VALUES
('Filmes'),
('Jogos'),
('Livros'),
('Revistas');
