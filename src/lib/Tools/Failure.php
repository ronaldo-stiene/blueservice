<?php
/**
 * Este arquivo implementa a classe Failure.
 *
 * Essa classe contém os dodos dos erros e exceções lançadas.
 *
 * Ele contém:
 * - Definição do erro na sessão.
 * - Exibição do erro.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace Stiene\BlueShop\Tools;

class Failure
{
	/**************************************************************************************************************/
	/**                                                 Atributos                                                **/
	/**************************************************************************************************************/

	/**
	 * Mensagem do erro.
	 * @var string
	 */
    private $message;

	/**
	 * Código do erro.
	 * @var string
	 */
    private $code;

	/**
	 * Arquivo em que ocorreu o erro.
	 * @var string
	 */
    private $filePath;

	/**
	 * Linha em que ocorreu o erro.
	 * @var int
	 */
    private $fileLine;

	/**
	 * Rota da execução até ocorrer o erro.
	 * @var array
	 */
    private $trace;

	/**************************************************************************************************************/
	/**                                              Métodos Mágicos                                             **/
	/**************************************************************************************************************/

	/**
	 * Construtor da classe.
	 * @param object $e - Erro obtido
	 */
    public function __construct( $error )
    {
        $this->message = $error->getMessage();
        $this->code = $error->getCode();
        $this->filePath = $error->getFile();
        $this->fileLine = $error->getLine();
        $this->trace = $error->getTraceAsString();
    }

	/**************************************************************************************************************/
	/**                                            Métodos de Operação                                           **/
	/**************************************************************************************************************/

	/**
	 * Realiza uma operação, em JavaScript, para exibir o erro.
	 */
    public function showError()
    {
		// Executa o comando em JavaScript.
        echo "<script>
                showError( 'error', 'error-box' );
                informError( 'error-message', '" . $this->message . "' );
              </script>";
    }

	/**
	 * Define o erro na sessão
	 * @param string $js - Comando em JavaScript, caso tenha.
	 */
    public function setError( $js = false )
    {
		// Verifica se a sessão está iniciada. Se não estiver, a inicia.
		if ( ! isset( $_SESSION ) ) {
			session_start();
		}

		// Define o erro e o salva na sessão, com o comando em JavaScript, caso tenha.
        if ( $js ) {
            $_SESSION['error'] = [
                'error' => $this,
                'js' => $js
            ];
        } else {
            $_SESSION['error'] = [
                'error' => $this
			];
        } // endif

    } // endfunction

} // endclass
