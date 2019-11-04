<?php
/**
 * Este arquivo implementa a realização da compra de um produto.
 *
 * Ele contém:
 * - Criação de pedido com base nos itens do carrinho
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
use Stiene\BlueShop\Cart;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Obtém o usuário logado.
$user = $_SESSION[ 'user' ];

// Obtém os itens do carrinho.
$cart = $_SESSION[ 'cart' ];

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Cria um pedido para cada item e os remove do carrinho.
foreach ( $cart as $key => $request ) {
    Cart::setRequest( $request[ 'quantity' ], $request[ 'price' ], $user->id, $request[ 'product_id' ] );
    unset( $_SESSION[ 'cart' ][ $key ] );
}

// Direciona para a página de pedidos do usuário.
header( "Location: " . INDEX_PATH . "/usuario/pedidos/" );
