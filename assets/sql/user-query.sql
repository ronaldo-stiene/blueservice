CREATE TABLE usuarios
(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  sobrenome VARCHAR(150) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  cep VARCHAR(15),
  rua VARCHAR(100),
  complemento VARCHAR(100),
  bairro VARCHAR(100),
  cidade VARCHAR(100),
  estado VARCHAR(100),
  PRIMARY KEY(id)
);

CREATE TABLE pedidos
(
  id INT NOT NULL AUTO_INCREMENT,
  quantidade INT NOT NULL,
  valor DOUBLE(9,2) NOT NULL,
  usuario_id INT NOT NULL,
  produto_id INT NOT NULL,
  PRIMARY KEY(id)
);

ALTER TABLE pedidos ADD CONSTRAINT fk_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
ALTER TABLE pedidos ADD CONSTRAINT fk_produtos FOREIGN KEY (produto_id) REFERENCES produtos(id);
