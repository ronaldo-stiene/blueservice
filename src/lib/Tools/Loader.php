<?php
/**
 * Este arquivo implementa a classe Loader.
 *
 * Essa classe contém os dados dos arquivos que serão carregados.
 *
 * Ele contém:
 * - Caminhos para os principais arquivos a serem carregados
 * - Operações com os caminhos e diretórios.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop\Tools;

class Loader
{
	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/**
	 * Caminho do arquivo que o Loader foi criado.
	 * @var string
	 */
    private $filePath;

	/**
	 * Caminho do diretório principal.
	 * @var string
	 */
	private $mainPath;

	/**
	 * Caminho do arquivo do cabeçalho.
	 * @var string
	 */
	private $headerPath;

	/**
	 * Caminho do arquivo do rodapé.
	 * @var string
	 */
	private $footerPath;

	/**
	 * Caminho do arquivo de login.
	 * @var string
	 */
	private $loginPath;

	/**************************************************************************************************************/
	/**                                              Métodos Mágicos                                             **/
	/**************************************************************************************************************/

	/**
	 * Construtor da classe.
	 * @param string $file - Caminho completo do arquivo em que o Loader foi criado.
	 */
	public function __construct( $file )
	{
        $this->filePath = $file;
		$this->mainPath = $this->returnDir( dirname( $file ) );
		$this->headerPath = self::setSeparator( 'src' );
		$this->footerPath = self::setSeparator( 'src' );
		$this->listPath = self::setSeparator( 'src' );
		$this->categoryAsidePath = self::setSeparator( 'src' );
		$this->userAsidePath = self::setSeparator( 'src' );
		$this->loginPath = self::setSeparator( 'src' );
		$this->errorPath = self::setSeparator( 'src' );
	}

	/**************************************************************************************************************/
	/**                                            Métodos de Operação                                           **/
	/**************************************************************************************************************/

	/**
	 * Carrega o arquivo que contém o cabeçalho.
	 * @param  string  $assets - Nome do arquivo css e js que será carregado.
	 * @param  string  $title  - Nome do título personalizado.
	 */
	public function loadHeader( $assets, $title = false )
	{
		// Verifica se a sessão está iniciada. Se não estiver, a inicia.
		if ( ! isset( $_SESSION ) ) {
			session_start();
		}

		// Salva o nome dos arquivos css e js da página.
        $_SESSION[ 'assets' ] = $assets;

		// Salva o título, caso tenha sido informado.
        if ( $title ) {
            $_SESSION[ 'main-title' ] = $title;
        }

		// Incluí o cabeçalho.
		include $this->mainPath . $this->headerPath . 'header.php';
	}

	/**
	 * Carrega o arquivo que contém o rodapé.
	 */
	public function loadFooter()
	{
		// Incluí o rodapé.
		include $this->mainPath . $this->headerPath . 'footer.php';
	}

	/**
	 * Carrega o arquivo que contém a lista de produtos.
	 * @param  array $products - Lista de produtos, caso tenha
	 */
    public function loadList( $products = false )
    {
		// Caso tenha sido definido produtos, salva eles na sessão.
        if ( $products ) {
			// Verifica se a sessão está iniciada. Se não estiver, a inicia.
			if ( ! isset( $_SESSION ) ) {
				session_start();
			}

			// Salva os produtos.
            $_SESSION[ 'products' ] = $products;
        }

		// Incluí a lista de produtos.
        include $this->mainPath . $this->listPath . 'list.php';
    }

	/**
	 * Carrega o menu lateral de categorias.
	 */
    public function loadCategoryAside()
    {
		// Incluí o menu.
        include $this->mainPath . $this->categoryAsidePath . 'category_aside.php';
    }

	/**
	 * Carrega o menu lateral do usuário.
	 */
    public function loadUserAside()
    {
		// Incluí o menu.
        include $this->mainPath . $this->userAsidePath . 'user_aside.php';
    }

	/**
	 * Carrega a caixa de login.
	 */
	public function loadLogin()
	{
		// Incluí o login.
		include $this->mainPath . $this->loginPath . 'login.php';
	}

	/**
	 * Carrega a caixa de erro.
	 */
    public function loadError()
    {
		// Incluí o erro.
        include $this->mainPath . $this->errorPath . 'error.php';
    }

	/**************************************************************************************************************/
	/**                                             Métodos Privados                                             **/
	/**************************************************************************************************************/

	/**
	 * Método que retorna para o diretório principal.
	 * @param  string $path - Diretório
	 * @return string       - Caminho para o diretório principal.
	 */
	private static function returnDir( $path )
	{
		// Pega o caminho para o arquivo.
		$totalPath = str_replace( MAIN_DIR, "", $path );

		// Define a variavel que irá salvar o arquivo final.
		$finalPath = "";

		// Acrescenta ".." até retornar ao diretório principal.
		for ( $i = 0; $i < substr_count( $totalPath, DIRECTORY_SEPARATOR ); $i++ ) {
			$finalPath .= self::setSeparator( ".." );
		}

		// Retorna o caminho até o diretório principal.
		return $finalPath;
	}

	/**
	 * Incluí o separador padrão do sistema operacional.
	 * @param string $path - Diretório.
	 */
	private static function setSeparator( $path )
	{
		// Caso existam varios caminhos, retorna uma string com todos eles separados corretamente.
		if ( is_array( $path ) ) {
			// Percore pelas pastas, acrescentando o separador
			foreach ( $path as $folder ) {
				$fullPath .= $folder . DIRECTORY_SEPARATOR;
			}

			// Retorna o caminho.
			return $fullPath;
		}

		// Retorna o caminho.
		return $path . DIRECTORY_SEPARATOR;
	}
}
