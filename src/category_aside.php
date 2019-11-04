<?php
/**
 * Este arquivo implementa o layout do menu lateral.
 * Este menu mostra todas as categorias de produtos.
 *
 * Ele contém:
 * - Listagem de categorias
 * - Exibição de categorias
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/*********************************************************************************************************************/
/**                                                  INICIALIZAÇÃO                                                  **/
/*********************************************************************************************************************/

// Carrega os arquivos principais: autoload, constantes e configurações.
require_once 'global.php';

// Classes usadas.
use Stiene\BlueShop\Category;

// Obtém todas as categorias.
$categories = Category::getCategories();

/*********************************************************************************************************************/
/**                                                     EXIBIÇÃO                                                    **/
/*********************************************************************************************************************/
?>
        <aside class="side-menu">
            <h4 class="side-menu-title">Categorias</h4>
            <div class="side-menu-itens">
                <ul>
                    <?php foreach($categories as $category): ?>
                    <a href="<?= INDEX_PATH ?>/produto/<?= strtolower( $category[ 'nome' ] ) ?>"><li class="side-menu-item"><?= $category['nome'] ?></li></a>
                    <?php endforeach ?>
                </ul>
            </div>
        </aside>
