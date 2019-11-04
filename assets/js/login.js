/**
 * Este arquivo contém os comandos em JavaScript da seção de login.
 *
 * Ele contém as funções que:
 * - Função que exibe a tela de login.
 * - Função que exibe a tela de cadastrar usuário.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Exibe a tela de login.
 * @param  {string} className - Nome da clase.
 */
function showLogin( className ) {
	// Obtém a classe.
	var element = getData( className )[ 0 ];

	// Muda a visibilidade.
	if ( element.style.visibility === "hidden" ) {
		element.style.visibility = "visible";
		element.style.opacity = "1";
	} else {
		element.style.visibility = "hidden";
		element.style.opacity = "0";
	}
}


/**
 * Exibe a tela de cadastro de usuário.
 * @param  {string} classVisible - Nome da classe visível
 * @param  {string} classHidden  - Nome da classe escondida
 */
function switchVisibility( classVisible, classHidden ) {
	// Obtém a classe visível.
	var visible = getData( classVisible )[ 0 ];

	// Obtém a classe invisível.
	var hidden = getData( classHidden )[ 0 ];

	// Muda a visibilidade.
	if ( hidden.style.display === "none" ) {
		hidden.style.display = "flex";
		visible.style.display = "none";
	} else {
		visible.style.display = "flex";
		hidden.style.display = "none";
	}
}
