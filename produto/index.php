<?php
/**
 * Este arquivo implementa a página que exibe um produto.
 *
 * Ele contém:
 * - Dados do produto
 * - Compra do produto e quantidade
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'global.php';

// Classes usadas.
use Stiene\BlueShop\Tools\Failure;
use Stiene\BlueShop\Tools\Loader;
use Stiene\BlueShop\Product;
use Stiene\BlueShop\Category;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Verifica se o usuário está logado.
if ( isset( $_SESSION[ 'user' ] ) ) {
	if ( $_SESSION[ 'user' ] != null ) {
		$user = $_SESSION[ 'user' ];
	} else {
		$user = false;
	}
} else {
	$user = false;
}

// Obtém o produto que será exibido na página.
$product = Product::getProductsById( $_GET[ 'id' ] );

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "product", $product[ 'nome' ] ) ?>
		<?php $loader->loadLogin() ?>
        <?php $loader->loadCategoryAside() ?>
		<?php
			// Carrega o erro, caso tenha sido gerado.
			if ( isset( $_SESSION[ 'error' ] ) ) {
			    $loader->loadError();
			}
		?>
        <main class="main product">
            <div class="product-info">
                <img class="image product-image" src="<?= INDEX_PATH ?>/assets/img/products/<?= $product['imagem'] ?>.jpg" alt="<?= $product['nome'] ?>">
                <div class="product-data">
                    <div class="product-subtitle">
                        <h2 class="product-name"><?= $product['nome'] ?></h2>
                        <p class="product-category"><?= Category::getCategoryName( $product['categoria_id'] ) ?></p>
                    </div>
                    <span class="product-features"><?= $product['caracteristicas'] ?></span>
                    <p class="product-description"><?= $product['descricao'] ?></p>
                </div>
                <form class="product-form" action="<?= INDEX_PATH ?>/produto/post.php" method="post">
                    <span class="product-price">R$ <?= $product['preco'] ?></span>
                    <label class="custom-underline product-quantity-information">
                        <span>Quantidade:</span>
                        <input class="input product-quantity" type="number" name="quantity" required value="1" min="1" max="10">
                    </label>
                    <input type="hidden" name="product-id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product-price" value="<?= $product['preco'] ?>">
					<button class="button product-form-button" type="submit">Comprar</button>
                    <script type="text/javascript">
                        if ( <?= ! $user ?> ) {
                            showLoginOnEmpyBuy( 'product-form' );
                        }
                    </script>
                </form>
            </div>
        </main>
<?php $loader->loadFooter() ?>
