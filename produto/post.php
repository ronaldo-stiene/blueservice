<?php
/**
 * Este arquivo implementa o processo da inserção de um produto no carrinho.
 *
 * Ele contém:
 * - Inserção de um produto no carrinho
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
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Define um produto no carrinho.
$_SESSION[ 'cart' ][] = [
    'quantity' => $_POST[ 'quantity' ],
    'price' => ( $_POST[ 'product-price' ] * $_POST[ 'quantity' ] ),
    'product_id' => $_POST[ 'product-id' ]
];

// Direciona para o carrinho.
header( "Location: " . INDEX_PATH . "/carrinho" );
