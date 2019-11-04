/**
 * Este arquivo contém as funções básicas utilizadas nos scripts das páginas.
 *
 * Ele contém as funções que:
 * - Obtém todos os arquivos CSS em que uma classe está configurada.
 * - Verifica um arquivo CSS, em busca da configuração de uma classe.
 * - Retorna as regras CSS dos arquivos em que possuí uma determinada classe configurada.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Essa função obtém os arquivos CSS em que uma classe fornecida está configurada, e retorna com as regras delas, nestes arquivos.
 * @param  {string} className - Nome da classe HTML
 * @return {array}            - Retorna um array com regras CSS da classe.
 */
function getData( className ) {
    // Obtém os arquivos CSS, com base no nome da classe.
    var styleSheets = getStyleSheets( className );

	// Cria um array e uma variavel para iterar sobre ele.
    var data = new Array();
    var index = 0;

	// Salva as regras em um array e retorna ele.
    for ( var i = 0; i < styleSheets.length; i++ ) {
		// Obtém as regras do css.
        var rules = styleSheets[ i ].rules || styleSheets[ i ].cssRules;

		// Verifica as classes do css.
        for ( var x = 0; x < rules.length; x++ ) {
			// Verifica se a regra pertence a classe e salva no array.
			// Caso contrário, continua o loop.
            if ( rules[ x ].cssText.match( className ) == className ) {
                data[ index ] = rules[ x ];
                index += 1;
            } else {
                continue;
            }
        }
    }
    return data;
}

/**
 * Esta função obtém todos os arquivos CSS e verifica se a classe informada está configurada no arquivo.
 * @param  {string} className - Nome da classe HTML
 * @return {array}            - Retorna array de classes que contém a classe.
 */
function getStyleSheets( className ) {
    // Pega os arquivos CSS.
    var styleSheets = document.styleSheets;

	// Cria um array e uma variavel para iterar sobre ele.
    var usefulStyleSheets = new Array();
    var index = 0;

	// Verifica os arquivos que contém a classe e os salva em um array.
    for ( var i = 0; i < styleSheets.length; i++ ) {
        if ( verifyRules( styleSheets[ i ], className ) ) {
            usefulStyleSheets[ index ] = styleSheets[ i ];
            index += 1;
        }
    }

	// Retorna as StyleSheets que contém a classe.
    return usefulStyleSheets;
}

/**
 * Essa função verifica se um arquivo CSS possuí a configuração da classe.
 * @param  {styleSheet} styleSheet - Arquivo CSS
 * @param  {string}     className  - Nome da classe HTML
 * @return {boolean}               - Retorna se o arquivo contém ou não a classe.
 */
function verifyRules( styleSheet, className ) {
    // Obtém as regras do arquivo CSS.
    var rules = styleSheet.rule || styleSheet.cssRules;

    // Verifica se a classe está configurada no arquivo e retorna o resultado da operação.
    for ( var i = 0; i < rules.length; i++ ) {
        if ( rules[ i ].cssText.match( className ) == className ) {
            return true;
        } else {
            continue;
        }
    }
    return false;
}
