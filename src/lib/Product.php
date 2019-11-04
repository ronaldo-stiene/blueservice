<?php
/**
 * Este arquivo implementa a classe Product.
 *
 * Essa classe contém todas as operações com os produtos.
 *
 * Ele contém:
 * - Retorno da lista de produtos
 * - Retorno do de produtos obtidos por uma pesquisa
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop;

// Classes usadas.
use Stiene\BlueShop\Tools\Connection;

class Product
{
	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*                 Persistência                */
	/////////////////////////////////////////////////

	/**
	 * Obtém todos os produtos.
	 * @return array - Lista de produto
	 */
    public static function getProducts()
    {
		// Query SQL
        $query = 'SELECT id, nome, preco, descricao, caracteristicas, imagem, categoria_id
                  FROM produtos
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
	 * Obtém um produto pelo ID.
	 * @param  int   $id - Id do produto.
	 * @return array     - Lista de informações do produto.
	 */
    public static function getProductsById( $id )
    {
		// Query SQL
        $query = 'SELECT id, nome, preco, descricao, caracteristicas, imagem, categoria_id
                  FROM produtos
                  WHERE id = :id';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':id', $id );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetch();
    }

	/**
	 * Obtém uma lista de produtos pela categoria.
	 * @param  int   $categoryId - Id da categoria
	 * @return array             - Lista de produtos de uma categoria
	 */
    public static function getProductsByCategory( $categoryId )
    {
		// Query SQL
        $query = 'SELECT id, nome, preco, descricao, caracteristicas, imagem, categoria_id
                  FROM produtos
                  WHERE categoria_id = :categoria_id
                  ORDER BY nome';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':categoria_id', $categoryId );
        $stmt->bindValue( ':categoria_id', $categoryId );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetchAll();
    }

	/////////////////////////////////////////////////
	/*                   Pesquisa                  */
	/////////////////////////////////////////////////

	/**
	 * Realiza varias buscas por um produto, com base em diversas condições.
	 * @param  array  $condintion  - Condições da pesquisa
	 * @param  int    $categoryId  - Id da categoria
	 * @return array               - Lista de produtos que satisfazem a pesquisa
	 */
    public static function getProductsByManySearch( $condintion, $categoryId = false )
    {
		// Realiza diversas pesquisas por produtos
        foreach ( $condintion as $type => $search ) {

			// Obtém todos os produtos, com base nas condições da pesquisa.
            $validateProducts = Product::getProductsBySearch( $search, $type, $categoryId );

			// Verifica se foi obtido algum produto.
			// Caso tenha sido, ele armezena em um array.
            if ( $validateProducts != null ) {
                foreach ( $validateProducts as $product ) {
                    $products[] = $product;
                } // endforeach
            } // endif
        } // endforeach

		// Verifica se algum produto foi encontrado.
		// Caso não tenha, retorna false.
        if ( isset( $products )) {
            return $products;
        } else {
            return false;
        }
    }

	/**
	 * Realiza a busca por produtos, com base em uma condição.
	 * @param  string  $search     - Condição
	 * @param  string  $type       - Lugar onde buscar a condição
	 * @param  int     $categoryId - Id da categoria
	 * @return array               - Lista de produtos encontrados
	 */
    public static function getProductsBySearch( $search, $type, $categoryId = false )
    {
		// Determina a query SQL, com base na passagem ou não de uma categoria.
        if( $categoryId ) {
            $query = 'SELECT id, nome, preco, descricao, caracteristicas, imagem, categoria_id
                      FROM produtos
                      WHERE categoria_id = :categoria_id
                      ORDER BY nome';
        } else {
            $query = 'SELECT nome, preco, descricao, caracteristicas, imagem, categoria_id
                      FROM produtos
                      ORDER BY nome';
        }

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        if ( $categoryId ) {
            $stmt->bindValue( ':categoria_id', $categoryId );
        }
        $stmt->execute();

		// Retorno dos dados, utilizando um método de busca em array.
        return self::searchProduct( $stmt->fetchAll(), $search, $type );
    }

	/**************************************************************************************************************/
	/**                                             Métodos Privados                                             **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*                   Pesquisa                  */
	/////////////////////////////////////////////////

	/**
	 * Função que realiza a busca de dados em um array.
	 * @param  array  $products - Lista de produtos
	 * @param  string $search   - Condição
	 * @param  string $type     - Local da descrição
	 * @return array            - Produtos encontrados
	 */
    private static function searchProduct( $products, $search, $type )
    {
		// Realiza a verificação da condição nos produtos.
        foreach ( $products as $product ) {
			// Verifica se a condição esta em algum lugar do produto e a salva em uma lista.
			// Caso não esteja, pula para o próximo produto.
            if ( strpos( $product[ $type ], $search ) !== false ) {
                $searchProducts[] = $product;
            } else {
                continue;
            }
        }

		// Retorna os produtos obtidos.
        return $searchProducts;
    }
}
