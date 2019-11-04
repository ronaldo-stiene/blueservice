<?php
/**
 * Este arquivo implementa as configurações gerais do projeto.
 *
 * Ele contém:
 * - Definição da constante que guarda o diretório principal
 * - Definição da constante que guarda o caminho até a index
 * - Definção dos dados do banco.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Classes usadas.
use Stiene\BlueShop\Tools\Connection;

/*********************************************************************************************************************/
/**                                                    DEFINIÇÃO                                                    **/
/*********************************************************************************************************************/

/////////////////////////////////////////////////
/*                  Constantes                 */
/////////////////////////////////////////////////

// Define o diretório principal da aplicação.
define( 'MAIN_DIR', dirname( dirname( __FILE__ ) ) );

// Define o caminho até a index da aplicação.
define( 'INDEX_PATH', '' );

/////////////////////////////////////////////////
/*                Banco de Dados               */
/////////////////////////////////////////////////

// Define os dados do banco.
Connection::defineDataBase(
    'mysql', // Tipo do banco.
    'host', // Host.
    'database', // Banco de Dados.
    'user', // Usuário do banco.
    'pass' // Senha do banco.
);
