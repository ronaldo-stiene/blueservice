<?php
/**
 * Este arquivo implementa o cabeçalho de todas as páginas da aplicação.
 *
 * Ele contém:
 * - Carregamento dos arquivos JavaScript e CSS
 * - Definição do título
 * - Definição dos icones
 * - Definição do menu e submenu
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once 'global.php';

// Classes usadas.
use Stiene\BlueShop\Category;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Define o usuário salvo na sessão, caso tenha.
if ( isset( $_SESSION[ 'user' ] ) ) {
    $user = $_SESSION['user'];
}

// Define o título principal da página, caso seja diferente.
// Caso não seja, define um título padrão.
if ( isset( $_SESSION[ 'main-title' ] ) ) {
    $title = $_SESSION[ 'main-title' ];
    unset( $_SESSION[ 'main-title' ] );
} else {
    $title = "Blue Shop";
}

// Obtém todas as categorias.
$categories = Category::getCategories();

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link rel="shortcut icon" href="<?= INDEX_PATH ?>/assets/img/icon.ico">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/reset.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/master.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/header.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/aside.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/login.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/footer.css">
        <link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/error.css">
		<?php if ( file_exists( MAIN_DIR . "/assets/css/" . $_SESSION[ 'assets' ] . ".css" ) ): ?>
		<link rel="stylesheet" href="<?= INDEX_PATH ?>/assets/css/<?= $_SESSION[ 'assets' ] ?>.css">
	<?php endif ?>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/lib/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/master.js"></script>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/header.js"></script>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/login.js"></script>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/error.js"></script>
		<?php if ( file_exists( MAIN_DIR . "/assets/js/" . $_SESSION[ 'assets' ] . ".js" ) ): ?>
		<script type="text/javascript" src="<?= INDEX_PATH ?>/assets/js/<?= $_SESSION[ 'assets' ] ?>.js"></script>
		<?php endif ?>
    </head>
    <body>
        <header class="menu">
            <section class="menu-main">
                <h1 class="menu-title"><a href="<?= INDEX_PATH ?>/">Blue Shop</a></h1>
				<div class="menu-search">
					<a href="<?= INDEX_PATH ?>/produto/pesquisa"><div class="menu-search-icon"></div></a>
				</div>
                <div class="menu-cart">
					<a href="<?= INDEX_PATH ?>/carrinho"><div class="menu-cart-icon">
		            <?php if ( isset( $_SESSION[ 'cart' ] ) ): ?>
		                <span class="menu-cart-quantity"><?= sizeof( $_SESSION[ 'cart' ] ) ?></span>
		            <?php else: ?>
		                <span class="menu-cart-quantity">0</span>
		            <?php endif ?>
					</div></a>
				</div>
                <div class="menu-user">
                <?php if( ! isset( $_SESSION[ 'user' ] ) ): ?>
					<div class="menu-user-icon" onclick="showLogin('login')"></div>
                    <span class="menu-user-log" onclick="showLogin('login')">Entrar</span>
                <?php else: ?>
					<a href="<?= INDEX_PATH ?>/usuario"><div class="menu-user-icon"></div></a>
                    <a href="<?= INDEX_PATH ?>/usuario"><span class="menu-user-name"><?= $user->name ?></span></a>
                    <a href="<?= INDEX_PATH ?>/usuario/logout"><span class="menu-user-log">Sair</span></a>
                <?php endif ?>
                </div>
            </section>
            <nav class="menu-options">
                <div class="menu-itens">
                    <span class="menu-item"><a href="<?= INDEX_PATH ?>/">Produtos</a></span>
                </div>
                <div class="menu-itens">
                    <span id="menu-categories" class="menu-item">Categorias</span>
                    <div id="submenu-categories" class="menu-submenu-itens">
                        <ul>
                        <?php foreach ( $categories as $category ): ?>
							<a href="<?= INDEX_PATH ?>/produto/<?= strtolower( $category[ 'nome' ] ) ?>"><li class="menu-submenu-item"><?= $category[ 'nome' ] ?></li></a>
                        <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
