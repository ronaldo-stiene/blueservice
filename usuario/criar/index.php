<?php
/**
 * Este arquivo implementa a criação de usuários.
 *
 * Ele contém:
 * - Criação do novo usuário com os dados fornecidos
 * - Login do usuário criado
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

// Atruibui os dados do formulário em variaveis
$name = $_POST[ 'name' ];
$lastName = $_POST[ 'last-name' ];
$email = $_POST[ 'email' ];
$pass = $_POST[ 'pass' ];

// Cria um novo usuário
User::newUser( $name, $lastName, $email, $pass );

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Verifica se um erro foi retornado e direciona para a página correspondente.
if ( isset( $_SESSION[ 'error' ] ) ) {
	// Direciona para página anterior.
	echo "<script>javascript:history.back()</script>";
} else {
	// Usa os dados do usuário criado para logar.
	$_SESSION[ 'login' ] = [
		'email' => $email,
		'pass' => $pass
	];

	// Direciona para o login.
	header( "Location: " . INDEX_PATH . "/usuario/login/" );
}
