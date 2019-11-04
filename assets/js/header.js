/**
 * Este arquivo contém as funções utilizadas no cabeçalho das páginas..
 *
 * Ele contém as funções que:
 * - Exibe um submenu ao passar o mouse por cima de um menu.
 * - Esconde um elemento.
 * - Mostra um elemento.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Função que verifica se o mouse está sob o menu "Categorias".
 */
$( document ).ready( function() {
    $( "#menu-categories" ).hover( function() {
        showSubMenu( "#submenu-categories" );
    }, function() {
        hideSubMenu( "#submenu-categories" );
    } );
} );

/**
 * Mostra um elemento.
 * @param  {string} className - Classe que terá o display alterado.
 */
function showSubMenu( className ) {
	// Obtém o elemento da classe.
    var element = getData( className )[ 0 ];

	// Muda a visibilidade.
    element.style.visibility = "visible";
}

/**
 * Esconde um elemento.
 * @param  {string} className - Classe que terá o display alterado.
 */
function hideSubMenu( className ) {
	// Obtém o elemento da classe.
    var element = getData( className )[ 0 ];

	// Muda a visibilidade.
    element.style.visibility = "hidden";
}
