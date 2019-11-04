<?php
/**
 * Este arquivo implementa a página de exibição do carrinho.
 *
 * Ele contém:
 * - Exibição dos itens do carrinho
 * - Confirmação de compra
 * - Retorno para a listagem de produtos
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
use Stiene\BlueShop\Cart;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Verifica se existe um usuário logado, se existe produtos no carrinho e atribui a uma varivavel.
if ( isset( $_SESSION[ 'user' ] ) ) {
	// Obtém o usuário logado.
    $user = $_SESSION[ 'user' ];
    if ( isset( $_SESSION[ 'cart' ] ) ) {
		// Obtém os itens no carrinho.
        $cart = $_SESSION[ 'cart' ];
        if ( $cart ){
			// Obtém os produtos do carrinho.
            foreach ( $cart as $request ) {
                $products[] = Product::getProductsById( $request[ 'product_id' ] );
            }
        }
    } else {
        $cart = false;
    }
} else {
    $cart = false;
}

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "cart", "Carrinho" ) ?>
<?php $loader->loadLogin() ?>
<?php $loader->loadCategoryAside() ?>
<?php
	// Carrega o erro, caso tenha sido gerado.
	if ( isset( $_SESSION[ 'error' ] ) ) {
		$loader->loadError();
	}
?>
        <main class="main cart">
            <div class="main-title cart-title">
                <h3>Carrinho</h3>
            </div>
            <?php if ( $cart ): ?>
            <table class="cart-list">
                <tr>
                    <th class="cart-description" colspan="2">Item</th>
                    <th class="cart-description">Quantidade</th>
                    <th class="cart-description">Preço</th>
                    <th class="cart-description">Excluir</th>
                </tr>
                <?php foreach ( $products as $key => $product ): ?>
                    <tr class="cart-item">
                        <td class="cart-image"><img class="image" src="<?= INDEX_PATH ?>/assets/img/products/<?= $product[ 'imagem' ] ?>.jpg" alt="<?= $product[ 'nome' ] ?>"></td>
                        <td class="cart-name"><span><?= $product[ 'nome' ] ?></span></td>
                        <td class="cart-quantity"><span><?= $cart[ $key ][ 'quantity' ] ?></span></td>
                        <td class="cart-price"><span>R$ <?= $cart[ $key ][ 'price' ] ?></span></td>
                        <td class="cart-delete"><a href="<?= INDEX_PATH ?>/carrinho/excluir/?id=<?= $key ?>"><div class="cart-delete-img"></div></a></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <button onclick="location.href='<?= INDEX_PATH ?>/carrinho/post.php'" class="button cart-buttom" type="button">Confirmar Compra</button>
            <button onclick="location.href='<?= INDEX_PATH ?>/'" class="button cart-buttom" type="button">Continuar Comprando</button>
            <?php else: ?>
            <table class="cart-list">
                <tr>
                    <th class="cart-description" colspan="2">Item</th>
                    <th class="cart-description">Quantidade</th>
                    <th class="cart-description">Preço</th>
                    <th class="cart-description">Excluir</th>
                </tr>
                <tr>
                    <td class="cart-empty" colspan="5"><span>Carrinho Vazio</span></td>
                </tr>
            </table>
            <?php endif ?>
        </main>
<?php $loader->loadFooter() ?>
