<?php
/**
 * Este arquivo implementa a página de pesquisa de produtos.
 *
 * Ele contém:
 * - Opções de pesquisa dos produtos
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'global.php';

// Classes usadas.
use Stiene\BlueShop\Tools\Failure;
use Stiene\BlueShop\Tools\Loader;
use Stiene\BlueShop\Category;
use Stiene\BlueShop\User;

// Verifica se a sessão está iniciada. Se não estiver, a inicia.
if ( ! isset( $_SESSION ) ) {
	session_start();
}

// Lista todas as categorias.
$categories = Category::getCategories();

// Cria uma instância de um carregador, passando o arquivo atual como parâmetro.
$loader = new Loader( __FILE__ );

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
<?php $loader->loadHeader( "search" ) ?>
		<?php $loader->loadLogin() ?>
		<?php $loader->loadCategoryAside() ?>
		<?php
			// Carrega o erro, caso tenha sido gerado.
			if ( isset( $_SESSION[ 'error' ] ) ) {
			    $loader->loadError();
			}
		?>
        <main class="main seach">
            <div class="main-title seach-title">
                <h3>Buscar Produtos</h3>
            </div>
            <form class="search-form" action="<?= INDEX_PATH ?>/produto/pesquisa/post.php" method="post">
                <div class="search-form-field">
                    <fieldset class="search-by">
                        <legend>Procurar Por:</legend>
                        <div class="search-input-section">
                            <input class="input search-input" type="text" name="name" placeholder="Nome">
                            <input class="input search-input" type="text" name="description" placeholder="Descrição">
                            <input class="input search-input" type="text" name="features" placeholder="Características">
                        </div>
                    </fieldset>
                    <fieldset class="search-in">
                        <legend>Procurar em:</legend>
                        <div class="search-input-section">
                        <?php foreach ( $categories as $category ): ?>
                            <label class="search-category"><input type="checkbox" name="category[ ]" value="<?= $category[ 'id' ] ?>"><?= $category[ 'nome' ] ?></label>
                        <?php endforeach ?>
                        </div>
                    </fieldset>
                </div>
                <button class="button search-button" type="submit">Procurar</button>
            </form>
        </main>
<?php $loader->loadFooter() ?>
