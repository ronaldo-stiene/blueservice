<?php
/**
 * Este arquivo implementa a listagem de produtos.
 *
 * Ele contém:
 * - Carregamento de uma lista de produtos
 * - Exibição de uma lsita de produtos
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
use Stiene\BlueShop\Tools\Failure;
use Stiene\BlueShop\Product;
use Stiene\BlueShop\Category;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if( ! isset( $_SESSION ) ) {
	session_start();
}

// Obtém os produtos a serem exibidos.
// Caso não exista, retorna um erro e redireciona para a página principal.
if ( isset( $_SESSION[ 'products' ] ) ) {
    $products = $_SESSION[ 'products' ];
} else {
	try {
		throw new \Exception( "Falha ao obter produtos", 1 );
	} catch ( \Exception $e ) {
		$error = new Failure( $e );
		$error->setError();
	}
	header( "Location: " . INDEX_PATH . "/" );
}

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
        <main class="main index">
			<div class="main-title index-title">
				<h3>Produtos</h3>
			</div>
            <?php foreach ( $products as $product ): ?>
            <div class="index-product">
                <a href="<?= INDEX_PATH ?>/produto/?id=<?= $product[ 'id' ] ?>"><img class="image index-product-image" src="<?= INDEX_PATH ?>/assets/img/products/<?= $product[ 'imagem' ] ?>.jpg" alt="<?= $product[ 'nome' ] ?>"></a>
                <div class="index-product-data">
                    <div class="product-subtitle">
                        <span class="index-product-name"><a href="<?= INDEX_PATH ?>/produto/?id=<?= $product[ 'id' ] ?>"><?= $product[ 'nome' ] ?></a></span>
                        <span class="index-product-category"><?= Category::getCategoryName( $product[ 'categoria_id' ] ) ?></span>
                        <span class="index-product-price">R$ <?= $product[ 'preco' ] ?></span>
                    </div>
                    <span class="index-product-features"><?= $product[ 'caracteristicas' ] ?></span>
                </div>
            </div>
			<?php endforeach ?>
        </main>
