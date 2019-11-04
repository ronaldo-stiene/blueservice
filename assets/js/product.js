/**
 * Este arquivo contém os comandos em JavaScript da página Produtos.
 *
 * Ele contém as funções que:
 * - Função que exibe a tela de login e impede o submit
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Exibe a tela de login e previne a execução do submit.
 * @param  {string} className - Nome da classe
 */
function showLoginOnEmpyBuy( className  ){
	// Obtém o formulário.
    var form = document.getElementsByClassName( className )[ 0 ];

	// Exibe o login e previni o submit.
    form.addEventListener( 'submit', function( e ){
		// Mostra a tela de login.
        showLogin( 'login' );

		// Evita o submit.
        e.preventDefault();
    });
}
