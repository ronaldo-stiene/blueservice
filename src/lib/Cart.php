<?php
/**
 * Este arquivo implementa a classe Cart.
 *
 * Essa classe contém todas as operações com os itens do carrinho.
 *
 * Ele contém:
 * - Armazenamento do carrinho nos pedidos
 * - Obtenção dos pedidos do usuário
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop;

// Classes usadas.
use Stiene\BlueShop\Tools\Connection;

class Cart
{
	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*                 Persistência                */
	/////////////////////////////////////////////////

	/**
	 * Armazena no banco de dados os itens no carrinho.
	 * @param int   $quantity  - Quantidade do produto
	 * @param float $value     - Valor total do produto
	 * @param int   $userId    - ID do usuário
	 * @param int   $productId - ID do produto
	 */
    public static function setRequest( $quantity, $value, $userId, $productId )
    {
		// Query SQL
        $query = 'INSERT INTO pedidos ( quantidade, valor, usuario_id, produto_id ) VALUES
                  ( :quantidade, :valor, :usuario_id, :produto_id )';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':quantidade', $quantity );
        $stmt->bindValue( ':valor', $value );
        $stmt->bindValue( ':usuario_id', $userId );
        $stmt->bindValue( ':produto_id', $productId );
        $stmt->execute();
    }

	/**
	 * Obtém os pedidos do usuário logado.
	 * @param  int   $userId - Id do usuário
	 * @return array         - Lista de pedidos do usuário
	 */
    public static function getRequestByUser( $userId )
    {
		// Query SQL
        $query = 'SELECT *
                  FROM pedidos
                  WHERE usuario_id = :usuario_id';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':usuario_id', $userId );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetchAll();
    }
}
