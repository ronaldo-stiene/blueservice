<?php
/**
 * Este arquivo implementa a página de alteração de senha.
 *
 * Ele contém:
 * - Página de alteração de senha
 * - Menu do usuário
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
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Verifica se o usuário está logado.
// Caso não esteja, direciona para a página principal
if ( isset( $_SESSION['user'] ) ) {
	$user = $_SESSION['user'];
} else {
	header( "Location: " . INDEX_PATH . "/" );
}

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "pass", $user->fullName ) ?>
<?php $loader->loadUserAside() ?>
<?php
	// Carrega o erro, caso tenha sido gerado.
	if ( isset( $_SESSION[ 'error' ] ) ) {
	    $loader->loadError();
	}
?>
        <main class="main pass-change">
            <div class="main-title pass-change-title">
                <h3>Alterar Senha</h3>
            </div>
            <form class="pass-form" action="<?= INDEX_PATH ?>/usuario/senha/post.php" method="post">
                <input class="input pass-input" type="password" name="old_pass" required placeholder="Senha Atual">
                <input class="input pass-input" type="password" name="new_pass" required placeholder="Nova Senha">
                <input class="input pass-input" type="password" name="confirm_new_pass" required placeholder="Confirme a Nova Senha">
                <button class="button pass-button" type="submit" name="button">Alterar</button>
            </form>
        </main>
<?php $loader->loadFooter() ?>
