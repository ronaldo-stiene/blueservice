<?php
/**
 * Este arquivo implementa a exclusão de um item do carrinho.
 *
 * Ele contém:
 * - A exclusão de um item
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'global.php';

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Obtém os itens do carrinho.
$cart = $_SESSION[ 'cart' ];

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Descarta o item com o ID obtido no GET.
unset( $cart[ $_GET[ 'id' ] ] );

// Cria uma nova lista de itens, com os números ordenados.
foreach ( $cart as $item ) {
    $newCart[] = $item;
}

// Atribui ao carrinho a nova lista.
$_SESSION[ 'cart' ] = $newCart;

// Retorna para o carrinho.
header( "Location: " . INDEX_PATH . "/carrinho" );
