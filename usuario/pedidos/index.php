<?php
/**
 * Este arquivo implementa a exibição dos pedidos comprados pelo usuário.
 *
 * Ele contém:
 * - Pedidos realizados pelo usuário
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
use Stiene\BlueShop\Tools\Loader;
use Stiene\BlueShop\Cart;
use Stiene\BlueShop\Product;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Verifica se o usuário está logado.
// Caso não esteja, direciona para a página principal.
if ( isset( $_SESSION[ 'user' ] ) ) {
	$user = $_SESSION[ 'user' ];
} else {
	header( "Location: " . INDEX_PATH . "/" );
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Armazena todos os pedidos do usuário em uma variavel.
$requests = Cart::getRequestByUser( $user->id );

// Obtém informações dos produtos de cada pedido.
foreach ( $requests as $request ) {
    $products[] = Product::getProductsById( $request[ 'produto_id' ] );
}

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "request", $user->fullName ) ?>
<?php $loader->loadUserAside() ?>
<?php
	// Carrega o erro, caso tenha sido gerado.
	if ( isset( $_SESSION[ 'error' ] ) ) {
	    $loader->loadError();
	}
?>
        <main class="main requests">
            <div class="main-title requests-title">
                <h3>Pedidos</h3>
            </div>
            <table class="requests-list">
                <tr>
                    <th class="request-description" colspan="2">Item</th>
                    <th class="request-description">Quantidade</th>
                    <th class="request-description">Preço</th>
                </tr>
                <?php foreach ( $requests as $key => $request ): ?>
                <tr class="request-item">
                    <td class="request-image"><img class="image" src="<?= INDEX_PATH ?>/assets/img/products/<?= $products[ $key ][ 'imagem' ] ?>.jpg" alt="<?= $products[ $key ][ 'nome' ] ?>"></td>
                    <td class="request-name"><span><?= $products[ $key ][ 'nome' ] ?></span></td>
                    <td class="request-quantity"><span><?= $request[ 'quantidade' ] ?></span></td>
                    <td class="request-price"><span>R$ <?= $request[ 'valor' ] ?></span></td>
                </tr>
			<?php endforeach ?>
            </table>
        </main>
<?php $loader->loadFooter() ?>
