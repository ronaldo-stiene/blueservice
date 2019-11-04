<?php
/**
 * Este arquivo implementa os elementos do menu lateral.
 * Este menu mostra as seções de usuário.
 *
 * Ele contém:
 * - Listagem de páginas do usuário
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
        <aside class="side-menu">
            <h4 class="side-menu-title">Usuário</h4>
            <div class="side-menu-itens">
                <ul>
                    <a href="<?= INDEX_PATH ?>/usuario/"><li class="side-menu-item">Perfil</li></a>
                    <a href="<?= INDEX_PATH ?>/usuario/senha/"><li class="side-menu-item">Alterar Senha</li></a>
                    <a href="<?= INDEX_PATH ?>/usuario/pedidos/"><li class="side-menu-item">Pedidos</li></a>
                    <a href="<?= INDEX_PATH ?>/usuario/logout/"><li class="side-menu-item">Sair</li></a>
                </ul>
            </div>
        </aside>
