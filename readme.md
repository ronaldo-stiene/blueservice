# Teste prático de desenvolvimento para Blue Service

Essa aplicação é um teste de desenvolvimento, solicitado pela empresa **Blue Service**. Ela cumpre os seguintes requisitos:

- Lista de categorias 
- Lista de produtos 
- Busca de produtos
- Detalhes do produto 
- Carrinho 
- Criação do pedido 
- Lista de pedidos

Os produtos são ligados a um banco de dados relacional e possuem as seguintes informações:
- Nome
- Descrição
- Imagem
- Preço
- Categoria
- Características

O carrinho é salvo em cache, assim como o login de usuário, para que não seja perdido durante a navegação.

Os dados são validados em PHP, com alguns comandos em JavaScript.

Cada página possuí um arquivo 'index.php', onde contém um código em PHP e tags em HTML para exibição. O redirecionamento de página é realizado para o diretório (que irá abrir o index automaticamente).

Desenvolvido em _PHP, HTML, CSS, JavaScript e JQuery_, usando o banco de dados _MySQL_ através de conexão com _PDO_.

A aplicação funcional pode ser acessada no seguinte link: [**BlueShop**](blueservice.stiene.com.br)

## Instalação

Para instalar o programa, basta baixa-lo e executar em sua pasta raiz, onde será executado o arquivo 'index.php'.

### Banco de dados

Para conexão com o banco de dados, é necessário fornecer as seguintes informações:

- Drive: Qual banco é usado. Por padrão na aplicação, é usado o MySQL.
- Host: Servidor do banco.
- User: Usuário do banco.
- Pass: Senha do banco.
- Database: Banco de dados.

Essas informações devem ser colocadas no arquivo _config.php_, dentro do diretório _/src_.

```
Connection::defineDataBase(
    'mysql', // Tipo do banco.
    'host', // Host.
    'database', // Banco de Dados.
    'user', // Usuário do banco.
    'pass' // Senha do banco.
);
```

### Caminho para redirecionamento

Para a troca de páginas, a aplicação direciona para a pasta, que irá executar o arquivo index dentro dela.

Para isso, é usado o seguinte método de redirecionamento no HTML:

```
href="/"
```

Com a barra no começo, a aplicação volta a busca para a pasta raiz do servidor, onde será feito o direcionamento para cada diretório.

Caso a aplicação seja executada em um diretório que não seja a pasta raiz, deve ser colocado o caminho até a sua pasta, para que a execução ocorra sem problemas.

Por exemplo, se ela foi instalada no diretório _aplicacao/blueservice/_, onde pode ser acessada pelo endereço _localhost:8000/aplicacao/blueservice/_, deve ser feita a seguinte configuração no arquivo _config.php_:

```
// Define o caminho até a index da aplicação.
define( 'INDEX_PATH', '/aplicacao/blueservice' );
```

É importante que o nome comece com uma barra e termine com o nome do diretório, sem outra barra.

Caso a execução seja feita na raiz da aplicação, sem a necessidade de colocar um diretório, deve ser mantida a configuração original:

```
// Define o caminho até a index da aplicação.
define( 'INDEX_PATH', '' );
```

### Criação dos produtos no banco de dados

Para exibir os produtos corretamente, e configurar as tabelas necessárias, deve ser executado o script contido no arquivo _query.sql_, no diretório _/assets/sql_.

## Utilização

Segue abaixo um guia de como realizar as operações na aplicação.

### Operações com usuário

#### Criar usuário

1. Clicar em _Entrar_ ou no ícone de pessoa, no canto superior direito.
1. Clicar no botão _Cadastrar novo usuário_.
1. Preencher os dados e clicar em _Cadastrar_.

#### Logar com usuário

1. Clicar em _Entrar_ ou no ícone de pessoa, no canto superior direito.
1. Colocar email e senha do usuário e clicar em _Entrar_.

#### Alterar dados

1. Logar com o email e senha.
1. Clicar no nome ou no ícone de pessoa, no canto superior direito.
1. Alterar os dados na seção _Dados_ e clicar em _Alterar_.

#### Alterar senha do usuário

1. Logar com o email e senha.
1. Clicar no nome ou no ícone de pessoa, no canto superior direito.
1. Clicar em _Alterar Senha_, na seção _Dados_, ou clicar em _Alterar Senha_, no menu lateral.
1. Colocar a senha atual, nova senha e clicar em _Alterar_.

#### Cadastrar e alterar endereço.

1. Logar com o email e senha.
1. Clicar no nome ou no ícone de pessoa, no canto superior direito.
1. Preencher os dados na seção _Endereço_ e clicar em _Alterar_.

#### Visualizar pedidos

1. Logar com o email e senha.
1. Clicar no nome ou no ícone de pessoa, no canto superior direito.
1. Clicar em _Pedidos_, no menu lateral.

#### Realizar logout

1. Clicar em _Sair_, no canto superior direito.

----

### Operações com os produtos

#### Buscar produtos

1. Clicar no ícone de lupa, no canto superior direito da tela.
1. Preencher as condições nas caixas de texto:
	- _Nome_: Pesquisa a condição no nome do produto.
	- _Descrição_: Pesquisa a condição na descrição do produto.
	- _Características_: Pesquisa a condição nas características do produto.
1. Informar em qual categoria deseja procurar o produto.
	- Caso deixe todas as opções desmarcadas, a pesquisa será realizada em todas categorias.
1. Clicar em _Procurar_.

#### Comprar produto

1. Logar com o usuário e senha.
1. Clicar em um produto.
1. Escolher a quantidade desejada.
1. Clicar em _Comprar_.
1. Entrar no carrinho, através do ícone de carrinho, no canto superior direito.
1. Clicar em _Confirmar Compra_.

#### Excluir produto do carrinho

1. Entrar no carrinho, através do ícone de carrinho, no canto superior direito.
1. Clicar no ícone de lixeira.
