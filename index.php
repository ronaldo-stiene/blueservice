<?php
/**
 * Este arquivo implementa a página inicial da aplicação.
 *
 * Esta página mostra todos os produtos disponíveis.
 *
 * Ela contém:
 * - Obtenção de todos os produtos
 * - Carregamento do cabeçalho
 * - Carregamento da seção de login
 * - Carregamento da exibição de erros
 * - Carregamento do menu lateral
 * - Carregamento da lista de produtos
 * - Carregamento do rodapé
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @version 1.0.0
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once 'src' . DIRECTORY_SEPARATOR . 'global.php';

// Classes usadas.
use Stiene\BlueShop\Tools\Failure;
use Stiene\BlueShop\Tools\Loader;
use Stiene\BlueShop\Product;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if( ! isset( $_SESSION ) ) {
	session_start();
}

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

// Obtém todos os produtos.
$products = Product::getProducts();

/*********************************************************************************************************************/
/**                                                   CARREGAMENTO                                                  **/
/*********************************************************************************************************************/

/////////////////////////////////////////////////
/*          Carregamento do cabeçalho          */
/////////////////////////////////////////////////

// Carrega o cabeçalho.
$loader->loadHeader( "index" );

// Carrega a seção de login.
$loader->loadLogin();

/////////////////////////////////////////////////
/*             Carregamento do Erro            */
/////////////////////////////////////////////////

// Carrega a seção de exibição de erro, caso exista.
if ( isset( $_SESSION[ 'error' ] ) ) {
    $loader->loadError();
}

/////////////////////////////////////////////////
/*      Carregamento do Conteúdo Principal     */
/////////////////////////////////////////////////

// Carrega o menu lateral de categorias.
$loader->loadCategoryAside();

// Carrega a lista de produtos, com os produtos obtidos na página.
$loader->loadList( $products );

/////////////////////////////////////////////////
/*            Carregamento do Rodapé           */
/////////////////////////////////////////////////

// Carrega o rodapé.
$loader->loadFooter();
