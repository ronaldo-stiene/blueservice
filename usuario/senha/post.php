<?php
/**
 * Este arquivo implementa alteração de senha.
 *
 * Ele contém:
 * - Validação da senha atual
 * - Validação da senha nova
 * - Alteração da nova senha
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
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Verifica se as senhas digitadas correspondem e atualiza ela.
// Caso não correspondam, trocam a senha.
if ( $_POST[ 'new_pass' ] == $_POST[ 'confirm_new_pass' ] ) {
	$user = $_SESSION[ 'user' ];
    $user->updatePass( $_POST[ 'old_pass' ], $_POST[ 'new_pass' ] );
	$_SESSION[ 'user' ] = $user->getUser();
} else {
	try {
		throw new \Exception( "Senhas não correspondentes", 1 );
	} catch ( \Exception $e ) {
		$error = new Failure( $e );
		$error->setError( $js );
	}
}

// Verifica se um erro foi lançado e direciona para página correspondente.
if ( isset( $_SESSION[ 'error' ] ) ) {
	echo "<script>javascript:history.back()</script>";
} else {
	header( "Location: " . INDEX_PATH . "/usuario" );
}
