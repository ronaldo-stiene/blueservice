<?php
/**
 * Este arquivo implementa a página do usuário.
 *
 * Ele contém:
 * - Exibição dos dados do usuário.
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
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if (  ! isset(  $_SESSION  )  ) {
	session_start();
}

// Verifica se o usuário está logado.
// Caso não esteja, direciona para a página principal
if ( isset( $_SESSION[ 'user' ] ) ) {
	$user = $_SESSION[ 'user' ];
} else {
	header( "Location: " . INDEX_PATH . "/" );
}

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "user", $user->fullName ) ?>
<?php $loader->loadUserAside() ?>
<?php
	// Carrega o erro, caso tenha sido gerado.
	if (  isset(  $_SESSION[ 'error' ]  )  ) {
	    $loader->loadError();
	}
?>
        <main class="main user">
            <div class="main-title user-title">
                <h3><?= $user->fullName ?></h3>
            </div>
            <form class="user-form" action="<?= INDEX_PATH ?>/usuario/post.php" method="post">
                <fieldset class="user-data">
                    <legend>Dados</legend>
                    <div class="user-info-section">
                        <label id="user-name" class="user-info">
                            <span class="user-info-name">Nome:</span>
                            <input class="input user-input" type="text" name="name" value="<?= $user->name ?>">
                        </label>
                        <label id="user-last-name" class="user-info">
                            <span class="user-info-name">Sobrenome:</span>
                            <input class="input user-input" type="text" name="last-name" value="<?= $user->lastName ?>">
                        </label>
                        <label id="user-email" class="user-info">
                            <span class="user-info-name">Email:</span>
                            <input class="input user-input" type="text" name="email" value="<?= $user->email ?>">
                        </label>
                        <label id="user-pass" class="user-info">
                            <span class="user-info-name">Senha:</span>
                            <a href="<?= INDEX_PATH ?>/usuario/senha"><span class="button change-pass-link">Alterar Senha</span></a>
                        </label>
                    </div>
                </fieldset>
                <fieldset class="user-adress">
                    <legend>Endereço</legend>
                    <div class="user-info-section">
                        <label id="user-zip" class="user-info">
                            <span class="user-info-name">CEP:</span>
                            <input class="input user-input" type="text" name="zip" placeholder="CEP" value="<?= $user->zip ?>">
                        </label>
                        <label id="user-street" class="user-info">
                            <span class="user-info-name">Rua:</span>
                            <input class="input user-input" type="text" name="street" placeholder="Rua" value="<?= $user->street ?>">
                        </label>
                        <label id="user-complement" class="user-info">
                            <span class="user-info-name">Complemento:</span>
                            <input class="input user-input" type="text" name="complement" placeholder="Complemento" value="<?= $user->complement ?>">
                        </label>
                        <label id="user-neighborhood" class="user-info">
                            <span class="user-info-name">Bairro:</span>
                            <input class="input user-input" type="text" name="neighborhood" placeholder="Bairro" value="<?= $user->neighborhood ?>">
                        </label>
                        <label id="user-city" class="user-info">
                            <span class="user-info-name">Cidade:</span>
                            <input class="input user-input" type="text" name="city" placeholder="Cidade" value="<?= $user->city ?>">
                        </label>
                        <label id="user-state" class="user-info">
                            <span class="user-info-name">Estado:</span>
                            <input id="user-state-input" class="input user-input" type="text" placeholder="UF" name="state" value="<?= $user->state ?>">
                        </label>
                    </div>
                </fieldset>
                <button class="button user-form-button" type="submit" name="button">Alterar</button>
            </form>
        </main>
<?php $loader->loadFooter() ?>
