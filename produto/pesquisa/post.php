<?php
/**
 * Este arquivo implementa a pesquisa dos produtos.
 *
 * Ele contém:
 * -
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'global.php';

// Classes usadas.
use Stiene\BlueShop\Tools\Failure;
use Stiene\BlueShop\Cart;
use Stiene\BlueShop\Product;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Verifica se foi definido uma busca por categoria.
// Caso contrário, utiliza todas as categorias.
if ( isset( $_POST[ 'category' ] ) ) {
    foreach ( $_POST[ 'category' ] as $categoryId ) {
        $products = verifyPost( $categoryId );
    }
} else {
    $products = verifyPost();
}

/**
 * Pesquisa os produtos com base nas condições.
 * @param  int $categoryId - Id da categoria
 * @return array           - Lista de produtos
 */
function verifyPost( $categoryId = false )
{
	// Condição para ser produrada no nome.
    if ( $_POST[ 'name' ] != null ) {
        $search[ 'nome' ] = $_POST[ 'name' ];
    }

	// Condição para ser produrada na descrição.
    if ( $_POST[ 'description' ] != null ) {
        $search[ 'descricao' ] = $_POST[ 'description' ];
    }

	// Condição para ser produrada nas características.
    if ( $_POST[ 'features' ] != null ) {
        $search[ 'caracteristicas' ] = $_POST[ 'features' ];
    }

	// Obtém a lista de produtos com base nas condições
    $products = Product::getProductsByManySearch( $search, $categoryId );

	// Retorna os produtos ou false, caso não tenha achado nada.
    if ( $products ) {
        return $products;
    } else {
        return false;
    }
}

// Retorna um erro, caso não tenha achado nenhum produto.
if ( $products == false ) {
	try {
		throw new \Exception( "Nenhum produto foi encontrado", 1 );
	} catch( \Exception $e ) {
		// Cria um erro.
		$error = new Failure( $e );

		// Chama o erro, enviado o comando.
		$error->setError();
	}
}

// verifica se foi retornado um erro e direciona para a página anterior.
// Caso tenha acho produtos, exibe os produtos achados.
if ( isset( $_SESSION [ 'error' ] ) ) {
	// Retorna para a página anterior.
	header( "Location: " . INDEX_PATH . "/produto/pesquisa/" );
} else {
	// Salva os produtos.
	$_SESSION[ 'products' ] = $products;

	// Direciona para a página que exibirá os produtos.
	header( "Location: " . INDEX_PATH . "/produto/pesquisa/resultado/" );
}
