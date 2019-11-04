/**
 * Este arquivo contém os comandos em JavaScript da página de erro.
 *
 * Ele contém as funções que:
 * - Função que exibe o error
 * - Função que informa a mensagem do erro
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Mostra a caixa do erro.
 * @param  {string} className    - Nome da classe
 * @param  {string} subClassName - Nome da segunda classe
 */
function showError( className, subClassName ) {
	// Obtém o elemento da classe principal.
	var element = getData( className )[ 0 ];

	// Obtém o elemento da classe secundária.
	var subElement = getData( subClassName )[ 0 ];

	// Muda a visibilidade.
	if ( element.style.visibility === "hidden" ) {
		element.style.visibility = "visible";
		element.style.opacity = "1";
        subElement.style.transform = "scale(1)";
	} else {
		element.style.visibility = "hidden";
		element.style.opacity = "0";
        subElement.style.transform = "scale(0)";
	}
}

/**
 * Mostra a mensagem do erro.
 * @param  {string} className - Nome da classe
 * @param  {string} error     - Mensagem do erro
 */
function informError( className, error ) {
	// Obtém o elemento.
	var element = document.getElementsByClassName( className )[ 0 ];

	// Informa o erro no elemento.
    element.innerHTML = error;
}
