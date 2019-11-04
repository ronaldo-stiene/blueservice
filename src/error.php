<?php
/**
 * Este arquivo implementa a exibição de uma exceção lançada.
 *
 * Ele contém:
 * - Obtenção do error
 * - Realiza operações em JavaScript para exibir o erro
 * - Exibe o erro
 * - Descarta o erro
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once 'global.php';

// Classes usadas.
use Stiene\BlueShop\Tools\Failure;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Atruibui uma variavel ao erro guardado.
$error = $_SESSION[ 'error' ];

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/

// Executa um código em JavaScript, caso tenha sido definida.
if ( isset( $error[ 'js' ] ) ) {
	echo $error[ 'js' ];
}
?>
		<section class="error" onclick="showError('error', 'error-box');">
		    <div class="error-fade"></div>
		    <div class="error-box">
		        <div class="error-title">
		            <h3>Ocorreu um Erro</h3>
		        </div>
		        <div class="error-data">
		            <span class="error-message"></span>
		        </div>
		    </div>
		</section>
<?php
// Mostra a caixa de erro.
$error[ 'error' ]->showError();

/*********************************************************************************************************************/
/**                                                     OPERAÇÃO                                                    **/
/*********************************************************************************************************************/

// Descarta o erro mostrado.
unset( $_SESSION[ 'error' ] );
?>
