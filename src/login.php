<?php
/**
 * Este arquivo implementa a seção do login de usuário.
 *
 * Ele contém:
 * - Seção de login de usuário
 * - Seção de cadastro de usuário
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once 'global.php';

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
        <section class="login">
			<div class="login-fade" onclick="showLogin( 'login' )"></div>
            <div class="login-box">
				<div class="custom-underline login-title">
					<h3>Entrar</h3>
				</div>
                <form class="login-form" action="<?= INDEX_PATH ?>/usuario/login/" method="post">
                    <input id="login-email-id" class="input login-input" type="text" name="email" required placeholder="E-Mail">
                    <input id="login-pass-id" class="input login-input" type="password" name="pass" required placeholder="Senha">
                    <button class="button login-button" type="submit" name="button">Entrar</button>
					<div class="login-create-link">
						<span onclick="switchVisibility( '.login-box', '.create-user-box' )">Cadastrar novo usuário</span>
					</div>
                </form>
            </div>
			<div class="create-user-box">
				<div class="custom-underline create-user-title">
					<h3>Preencha os dados</h3>
				</div>
				<form class="create-user-form" action="<?= INDEX_PATH ?>/usuario/criar/" method="post">
                    <input class="input create-user-input" type="text" name="name" required placeholder="Nome">
                    <input class="input create-user-input" type="text" name="last-name" required placeholder="Sobrenome">
                    <input class="input create-user-input" type="text" name="email" required placeholder="E-Mail">
                    <input class="input create-user-input" type="password" name="pass" required placeholder="Senha">
                    <button class="button create-user-button" type="submit" name="button">Cadastrar</button>
					<div class="login-link">
						<span onclick="switchVisibility( '.create-user-box', '.login-box' )">Entrar com seus dados</span>
					</div>
                </form>
			</div>
        </section>
