<?php
/**
 * Este arquivo implementa o tratamento dos dados obtidos no formulário na página do usuário.
 *
 * Ele contém:
 * - Altera os dados obtidos no formulário
 * - Direciona para a página do usuário
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

// Atribui o usuário logado a uma variavel.
$user = $_SESSION[ 'user' ];

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Atualiza o nome.
$user->updateData( $_POST[ 'name' ], "nome" );

// Atualiza o sobrenome
$user->updateData( $_POST[ 'last-name' ], "sobrenome" );

// Atualiza o email.
$user->updateData( $_POST[ 'email' ], "email" );

// Atualiza o endereço.
$user->updateAdress( $_POST[ 'zip' ], $_POST[ 'street' ], $_POST[ 'complement' ], $_POST[ 'neighborhood' ], $_POST[ 'city' ], $_POST[ 'state' ] );

// Obtém o usuário logado com os dados atualizados.
$_SESSION[ 'user' ] = $user->getUser();

// Direciona para a página do usuário.
header( "Location: " . INDEX_PATH . "/usuario" );
