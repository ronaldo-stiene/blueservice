<?php
/**
 * Este arquivo implementa o login do usuário.
 *
 * Ele contém:
 * - O login do usuário
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
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Verifica se o email e senha foram fornecidos pelo usuário ou por outro método.
// Assim que definido, passa o email e senha fornecido.
// Caso o contrário, retorna um erro.
if ( isset( $_SESSION[ 'login' ] ) ) {
	$email = $_SESSION[ 'login' ][ 'email' ];
	$pass = $_SESSION[ 'login' ][ 'pass' ];
	unset( $_SESSION[ 'login' ] );
} elseif ( isset( $_POST ) ) {
	$email = $_POST[ 'email' ];
	$pass = $_POST[ 'pass' ];
} else {
	try {
		// Erro lançado, caso ocorra algum erro.
		throw new \Exception( "Ocorreu um erro ao realizar o login.", 1 );
	} catch ( \Exception $e ) {
		// Cria um erro.
		$error = new Failure( $e );

		// Cria um comando, em JavaScript, que irá mostrar a tela de login.
		$js = "<script>showLogin( 'login' );</script>";

		// Chama o erro, enviado o comando.
		$error->setError( $js );
	}
}

// Loga o usuário.
User::loginUser( $email, $pass );

// Direciona para a página anterior.
echo "<script>javascript:history.back()</script>";
