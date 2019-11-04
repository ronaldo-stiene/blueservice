<?php
/**
 * Este arquivo implementa a classe User.
 *
 * Essa clase contém todas as informações e operações relacionados ao usuário.
 *
 * Ele contém:
 * - Dados do usuário logado
 * - Realização do login e logout
 * - Realização de buscas e inserções no banco de dados.
 *
 * @package BlueService
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

// Namespace da classe.
namespace  Stiene\BlueShop;

// Classes usadas.
use Stiene\BlueShop\Tools\Connection;
use Stiene\BlueShop\Tools\Failure;

class User
{
	/**************************************************************************************************************/
	/**                                                 Atributos                                                **/
	/**************************************************************************************************************/

	/**
	 * Id do usuário.
	 * @var int
	 */
    private $id;

	/**
	 * Nome do usuário.
	 * @var string
	 */
    private $name;

	/**
	 * Sobrenome do usuário.
	 * @var string
	 */
    private $lastName;

	/**
	 * Nome completo do usuário.
	 * @var string
	 */
    private $fullName;

	/**
	 * Email do usuário.
	 * @var string
	 */
    private $email;

	/**
	 * Senha do usuário
	 * @var string
	 */
    private $pass;

	/**
	 * CEP do usuário.
	 * @var string
	 */
    private $zip;

	/**
	 * Rua do usuário.
	 * @var string
	 */
    private $street;

	/**
	 * Complemento do endereço do usuário.
	 * @var string
	 */
    private $complement;

	/**
	 * Bairro do usuário.
	 * @var string
	 */
    private $neighborhood;

	/**
	 * Cidade do usuário.
	 * @var string
	 */
    private $city;

	/**
	 * Estado do usuário.
	 * @var string
	 */
    private $state;

	/**************************************************************************************************************/
	/**                                              Métodos Mágicos                                             **/
	/**************************************************************************************************************/

	/**
	 * Construtor da classe
	 * @param int     $id       - Id do usuário
	 * @param string  $name     - Nome do usuário
	 * @param string  $lastName - Sobrenome do usuário
	 * @param string  $email    - Email do usuário
	 * @param string  $pass     - Senha do usuário
	 * @param array   $adress   - Lista com as informações do endereço do usuário
	 */
    public function __construct( $id, $name, $lastName, $email, $pass, $adress = false )
    {
		// Atribuí cada dado a um atributo.
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->fullName = $name . " " . $lastName;
        $this->email = $email;
        $this->pass = $pass;

		// Define um endereço, caso tenha sido definido.
        if ( $adress ) {
            $this->zip = $adress[ 'zip' ];
            $this->street = $adress[ 'street' ];
            $this->complement = $adress[ 'complement' ];
            $this->neighborhood = $adress[ 'neighborhood' ];
            $this->city = $adress[ 'city' ];
            $this->state = $adress[ 'state' ];
        }
    }

	/**
	 * Lê os atributos privados.
	 * @param  string $property - Atributo
	 * @return object           - Retorna o atributo solicitado
	 */
    public function __get( $property )
    {
        return $this->$property;
    }

	/**************************************************************************************************************/
	/**                                            Métodos de Operação                                           **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*             Instância (Operação)            */
	/////////////////////////////////////////////////

	/**
	 * Obtém os dados do usuário, através da classe.
	 * @return object - Instância do objeto.
	 */
    public function getUser()
    {
		// Atualiza o usuário.
        $this->updateUser();

		// Retorna o usuário.
        return $this;
    }

	/////////////////////////////////////////////////
	/*           Persistência (Inserção)           */
	/////////////////////////////////////////////////

	/**
	* Atualiza o endereço do usuário.
	* @param  string $zip          - CEP do usuário
	* @param  string $street       - Rua do usuário
	* @param  string $complement   - Completo da rua do usuário
	* @param  string $neighborhood - Bairro do usuário
	* @param  string $city         - Cidade do usuário
	* @param  string $state        - Estado do usuáiro
	*/
	public function updateAdress( $zip, $street, $complement, $neighborhood, $city, $state )
	{
		// Query SQL
		$query = 'UPDATE usuarios
		SET cep = :cep, rua = :rua, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado
		WHERE id = :id';

		// Conexão com o banco.
		$connection = Connection::connectDB();

		// Execução da query.
		$stmt = $connection->prepare( $query );
		$stmt->bindValue( ':id', $this->id );
		$stmt->bindValue( ':cep', $zip );
		$stmt->bindValue( ':rua', $street );
		$stmt->bindValue( ':complemento', $complement );
		$stmt->bindValue( ':bairro', $neighborhood );
		$stmt->bindValue( ':cidade', $city );
		$stmt->bindValue( ':estado', $state );
		$stmt->execute();

		// Atualiza os dados a instância do usuário.
		$this->updateUser();
	}

	/**
	 * Atualiza as informações do usuário.
	 * @param  string $value - Novo valor
	 * @param  string $data  - Informação
	 */
	public function updateData( $value, $data )
	{
		// Query SQL
		$query = 'UPDATE usuarios
				  SET ' . $data . ' = :valor
				  WHERE id = :id';

		// Conexão com o banco.
		$connection = Connection::connectDB();

		// Execução da query.
		$stmt = $connection->prepare( $query );
		$stmt->bindValue( ':id', $this->id );
		$stmt->bindValue( ':valor', $value );
		$stmt->execute();

		// Atualiza os dados a instância do usuário.
		$this->updateUser();
	}

	/**
	 * Atualiza a senha do usuário.
	 * @param  string $pass    - Senha atual
	 * @param  string $newPass - Nova senha
	 */
	public function updatePass( $pass, $newPass ) {
		// Verifica se a senha fornecida corresponde com a atual e atualiza para a senha nova.
		// Caso não sejam correspondentes, retorna erro.
		if ( $this->validatePass( $pass ) ) {
			$this->updateData( $newPass, "senha" );
		} else {
			try {
				// Erro lançado, caso as senhas não sejam correspondentes.
				throw new \Exception( "Senha incorreta", 1 );
			} catch ( \Exception $e ) {
				// Cria um erro.
				$error = new Failure( $e );

				// Cria um comando, em JavaScript, que irá mostrar a tela de login.
				$js = "<script>showLogin( 'login' );</script>";

				// Chama o erro, enviado o comando.
				$error->setError( $js );
			}
		}
	}

	/**************************************************************************************************************/
	/**                                             Métodos Estáticos                                            **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*           Persistência (Inserção)           */
	/////////////////////////////////////////////////

	/**
	 * Cria um novo usuário.
	 * @param  string $name     - Nome do usuário
	 * @param  string $lastName - Sobrenome do usuário
	 * @param  string $email    - Email do usuário
	 * @param  string $pass     - Senha do usuário
	 * @return boolean          - Retorna o resultado da operação
	 */
	public static function newUser( $name, $lastName, $email, $pass )
	{
		// Verifica se o email já foi cadastradp.
		if ( self::validateUser( $email ) ) {
			// Query SQL
			$query = 'INSERT INTO usuarios ( nome, sobrenome, email, senha ) VALUES
					  ( :nome, :sobrenome, :email, :senha )';

			// Conexão com o banco.
			$connection = Connection::connectDB();

			// Execução da query.
			$stmt = $connection->prepare( $query );
			$stmt->bindValue( ':nome', $name );
			$stmt->bindValue( ':sobrenome', $lastName );
			$stmt->bindValue( ':email', $email );
			$stmt->bindValue( ':senha', $pass );
			$stmt->execute();

			// Retorna a operação realizada.
			return true;
		} else {
			// Retorna a operação não realizada.
			return false;
		}
	}

	/////////////////////////////////////////////////
	/*                    Login                    */
	/////////////////////////////////////////////////

	/**
	 * Realiza o login do usuário
	 * @param  string $email - Email do usuário
	 * @param  string $pass  - Senha do usuário
	 */
    public static function loginUser( $email, $pass )
    {
		// Trata possíveis erros
        try {
			// Verifica se o email está cadastrado.
            if ( ! self::verifyUser( $email ) ) {
                throw new \Exception( "Email não cadastrado.", 1 );
            }

			// Obtém o usuário referente ao email informado.
            $user = self::getUserByEmail( $email );

			// Verifica se a senha digitada é a mesma que o usuário e salva a instância na sessão.
			// Caso não seja, retorna um erro.
			if ( $user[ 'senha' ] === $pass ) {
				// Verifica se a sessão está iniciada. Se não estiver, a inicia.
				if( ! isset( $_SESSION ) ) {
					session_start();
				}

				// Salva o usário na sessão.
                $_SESSION[ 'user' ] = self::userArrayIntoObject( $user );
            } else {
                throw new \Exception( "Senha inválida.", 1 );
            }
        } catch ( \Exception $e ) {
			// Cria um erro.
            $error = new Failure( $e );

			// Cria um comando, em JavaScript, que irá mostrar a tela de login.
            $js = "<script>showLogin( 'login' );</script>";

			// Chama o erro, enviado o comando.
            $error->setError( $js );
        }
    }

	/**
	 * Desloga o usuário.
	 */
    public static function logoutUser()
    {
		// Verifica se a sessão está iniciada. Se não estiver, a inicia.
		if ( ! isset( $_SESSION ) ) {
			session_start();
		}

		// Remove o usuário da sessão.
        $_SESSION[ 'user' ] = null;
    }

	/**************************************************************************************************************/
	/**                                             Métodos Privados                                             **/
	/**************************************************************************************************************/

	/////////////////////////////////////////////////
	/*                  Validação                  */
	/////////////////////////////////////////////////

	/**
	 * Valida a senha.
	 * @param  string  $pass     - Senha digitada
	 * @param  string  $userPass - Senha fornecida
	 */
    private function validatePass( $pass, $userPass = false )
    {
        if( $userPass ) {
            if ( $pass === $userPass ) {
                return true;
            } else {
                return false;
            }
        } else {
            if ( $pass === $this->pass ) {
                return true;
            } else {
                return false;
            }
        }
    }

	/**
	 * Valida se o usuário está disponível.
	 * @param  string $email - Email que será validado
	 * @return boolean       - Retorna o teste realizado
	 */
    private static function validateUser( $email )
    {
		// Obtém todos os emails cadastrados.
		$users = self::getUserEmail();

		// Verifica se o email já está cadastrado.
		// Se estiver, retorna um erro.
        foreach ( $users as $user ) {
            if ( $user[ 'email' ] == $email ) {
				try {
					throw new \Exception( "Email já cadastrado", 1 );
				} catch ( \Exception $e ) {
					// Cria um erro.
		            $error = new Failure( $e );

					// Cria um comando, em JavaScript, que irá mostrar a tela de login.
		            $js = "<script>
							   showLogin( 'login' );
							   switchVisibility( '.login-box', '.create-user-box' );
						   </script>";

					// Chama o erro, enviado o comando.
		            $error->setError( $js );

					// Retorna o resultado do teste.
					return false;
		        } // endcatch

            } // endif

        } // endforeach

		// Retorna o resultado do teste.
		return true;
    }

	/**
	 * Verifica se o usuário existe.
	 * @param  string $email - Email tentando logar
	 * @return boolean       - Retorno do teste
	 */
    private static function verifyUser( $email )
    {
		// Obtém todos os emails cadastrados.
        $users = self::getUserEmail();

		// Verifica se o email está cadastrado e retorna true.
        foreach ( $users as $user ) {
            if ( $user[ 'email' ] == $email ) {
                return true;
            }
        }

		// Retorna false se o email não estiver cadastrado.
        return false;
    }

	/////////////////////////////////////////////////
	/*             Instância (Operação)            */
	/////////////////////////////////////////////////

	/**
	* Atualiza a instância do usuário com os dodos atualizados.
	*/
	private function updateUser()
	{
		// Query SQL
		$query = 'SELECT *
			  	  FROM usuarios
				  WHERE id = :id';

		// Conexão com o banco.
		$connection = Connection::connectDB();

		// Execução da query.
		$stmt = $connection->prepare( $query );
		$stmt->bindValue( ':id', $this->id );
		$stmt->execute();
		$user = $stmt->fetch();

		// Atualização dos dados.
		$this->id = $user[ 'id' ];
		$this->name = $user[ 'nome' ];
		$this->lastName = $user[ 'sobrenome' ];
		$this->fullName = $user[ 'nome' ] . " " . $user[ 'sobrenome' ];
		$this->email = $user[ 'email' ];
		$this->pass = $user[ 'senha' ];
		$this->zip = $user[ 'cep' ];
		$this->street = $user[ 'rua' ];
		$this->number = $user[ 'numero' ];
		$this->complement = $user[ 'complemento' ];
		$this->neighborhood = $user[ 'bairro' ];
		$this->city = $user[ 'cidade' ];
		$this->state = $user[ 'estado' ];
	}

	/**
	* Transforma os dados do usuário em uma instância do tipo User.
	* @param  array  $user - Usuário
	* @return object       - Instãncia do usuário
	*/
	private static function userArrayIntoObject( $user )
	{
		// Verifica se o cliente possuí endereço e cria uma instância com todos os dados.
		if ( $user[ 'cep' ] == null) {
			// Retorno dos dados.
			return new User( $user[ 'id' ], $user[ 'nome' ], $user[ 'sobrenome' ], $user[ 'email' ], $user[ 'senha' ] );
		} else {
			// Array com todas as informações de endereço.
			$adress = [
			'zip' => $user[ 'cep' ],
			'street' => $user[ 'rua' ],
			'number' => $user[ 'numero' ],
			'complement' => $user[ 'complemento' ],
			'neighborhood' => $user[ 'bairro' ],
			'city' => $user[ 'cidade' ],
			'state' => $user[ 'estado' ]
			];
			// Retorno dos dados.
			return new User( $user[ 'id' ], $user[ 'nome' ], $user[ 'sobrenome' ], $user[ 'email' ], $user[ 'senha' ], $adress );
		}
	}

	/////////////////////////////////////////////////
	/*           Persistência (Obtenção)           */
	/////////////////////////////////////////////////

	/**
	 * Obtém o email dos usuários.
	 * @return array - Lista de emails.
	 */
    private static function getUserEmail()
    {
		// Query SQL
        $query = 'SELECT email
                  FROM usuarios';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetchAll();
    }

	/**
	 * Obtém um usuário através de um email.
	 * @param  string $email - Email solicitado
	 * @return array         - Informações do usuário correspondente
	 */
    private static function getUserByEmail( $email )
    {
		// Query SQL
        $query = 'SELECT *
                  FROM usuarios
                  WHERE email = :email';

		// Conexão com o banco.
        $connection = Connection::connectDB();

		// Execução da query.
        $stmt = $connection->prepare( $query );
        $stmt->bindValue( ':email', $email );
        $stmt->execute();

		// Retorno dos dados.
        return $stmt->fetch();
    }
}
