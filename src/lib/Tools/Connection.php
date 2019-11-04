<?php
/**
 * Este arquivo implementa a classe Connection.
 *
 * Essa classe contém a conexão com o banco de dados.
 *
 * Ele contém:
 * - Conexão com o banco de dados em PDO.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop\Tools;

class Connection
{
	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/**
	 * Define os dados fornecidos para o banco de dados.
	 * @param  string $drive    - Drive do banco
	 * @param  string $host     - Host do banco
	 * @param  string $database - Banco de Dados
	 * @param  string $user     - Usuário do banco
	 * @param  string $pass     - Senha do banco.
	 */
    public static function defineDataBase( $drive, $host, $database, $user, $pass )
    {
        define( 'DB_DRIVE', $drive );
        define( 'DB_HOST', $host );
        define( 'DB_DATABASE', $database );
        define( 'DB_USER', $user );
        define( 'DB_PASS', $pass );
    }

	/**
	 * Realiza a conexão com o banco.
	 * @return object - Conexão com o banco
	 */
    public static function connectDB()
    {
		// Realiza a conexão com o banco, com os dados do mesmo.
        $connection = new \PDO(
            DB_DRIVE . ':host=' . DB_HOST. ';dbname=' . DB_DATABASE,
            DB_USER,
            DB_PASS,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            ]
        );

		// Retorna a conexão.
        return $connection;
    }
}
