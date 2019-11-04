<?php
/**
 * Este arquivo implementa a classe Category.
 *
 * Essa classe contém todas as operações com a categoria.
 *
 * Ele contém:
 * - Retorno da lista de categorias
 * - Retorno do nome de uma categoria
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop;

// Classes usadas.
use Stiene\BlueShop\Tools\Connection;

class Category
{
	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*                 Persistência                */
	/////////////////////////////////////////////////

	/**
	 * Obtém as categorias.
	 * @return array - Lista de categorias
	 */
    public static function getCategories()
    {
		// Query SQL
        $query = 'SELECT id, nome
                  FROM categorias
                  ORDER BY nome';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetchAll();
    }

	/**
	 * Retorna o nome da categoria, buscada pelo ID.
	 * @param  int    $id - Id da categoria
	 * @return string     - Nome da categoria
	 */
    public static function getCategoryName( $id )
    {
		// Query SQL
        $query = 'SELECT nome
                  FROM categorias
                  WHERE id = :id';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':id', $id );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetch()[ 'nome' ];
    }
}
