<?php
/**
 * Este arquivo implementa o autoload do arquivo.
 *
 *
 * Ele contém:
 * - Registro do spl_autoload_register
 * - Substituição do namespace para o diretório padrão das classes.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/////////////////////////////////////////////////
/*                   Autoload                  */
/////////////////////////////////////////////////

spl_autoload_register(
    function ( $namespace ) {
		// Define a pasta padrão das classes.
        $dir = str_replace( "Stiene\\BlueShop\\", "src\\lib\\", $namespace );

		// Troca todas as barras pelo separador padrão do sistema operacional.
        $path = str_replace( "\\", DIRECTORY_SEPARATOR, $dir );

		// Obtém o caminho completo do arquivo.
        $file = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . $path . ".php";

		// Carrega o arquivo.
        include_once $file;
    }
);
