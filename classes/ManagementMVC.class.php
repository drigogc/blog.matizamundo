<?php

// ManagementMVC - Management Models, Controllers and Views
class ManagementMVC { // instead of TutsupMVC

	// $controller - receive value of controller (URL).
	// Example: example.com/controller/
	private $controller;

	// $action - receive value of action (URL).
	// Example: example.com/controller/action
	private $action;

	// $parameters - receive value arrays (URL).
	// Example: example.com/controller/action/param1/param40
	private $parameters;

	// $not_found - page not found
	private $not_found = '/views/404.php';

	// Constructor class - receive value of controller, action and parameters
	// Configure the controlled and action (method)
	public function __construct () {

		// Obtém os valores do controller, ação e parâmetros da URL.
		// E configura as propriedades da classe.
		$this->get_url_data();

		/**
		* Verifica se o controller existe. Caso contrário, adiciona o
		* controller padrão (controllers/home-controller.php) e chama o método index().
		*/
		if ( ! $this->controller ) {
			// Adiciona o controller padrão
			require_once ABSPATH . '/controllers/home.controller.php';

			// Cria o objeto do controller "home-controller.php"
			// Este controller deverá ter uma classe chamada HomeController
			$this->controller = new HomeController();

			// Executa o método index()
			$this->controller->index();

			// FIM :)
			return;
		}

		// Se o arquivo do controller não existir, não faremos nada
		if ( ! file_exists( ABSPATH . '/controllers/' . $this->controller . '.php' ) ) {

			// Página não encontrada
			require_once ABSPATH . $this->not_found;

			return;
		}

		// Inclui o arquivo do controller
		require_once ABSPATH . '/controllers/' . $this->controller . '.php';

		// Remove caracteres inválidos do nome do controller para gerar o nome
		// da classe. Se o arquivo chamar "news-controller.php", a classe deverá
		// se chamar NewsController.
		$this->controller = preg_replace( '/[^a-zA-Z]/i', '', $this->controller );

		// Se a classe do controller indicado não existir, não faremos nada
		if ( ! class_exists( $this->controller ) ) {

			// Página não encontrada
			require_once ABSPATH . $this->not_found;

			return;
		} // class_exists

		// Cria o objeto da classe do controller e envia os parâmetros
		$this->controller = new $this->controller( $this->parameters );

		// Se o método indicado existir, executa o método e envia os parâmetros
		if ( method_exists( $this->controller, $this->action ) ) {
			$this->controller->{$this->action}( $this->parameters );

			return;
		}

		// Without action, we call the index method
		if ( ! $this->action && method_exists( $this->controller, 'index' ) ) {
			$this->controller->index( $this->parameters );

			return;
		}

		// Page not found
		require_once ABSPATH . $this->not_found;

		return;
	} // End class __construct



	/**
	* Obtém parâmetros de $_GET['path']
	*
	* Obtém os parâmetros de $_GET['path'] e configura as propriedades 
	* $this->controller, $this->action e $this->parameters
	*
	* A URL deverá ter o seguinte formato:
	* http://www.example.com/controller/action/parametro1/parametro2/etc...
	*/
	public function get_url_data () {

		// Verifica se o parâmetro path foi enviado
		if ( isset( $_GET['path'] ) ) {

			// Captura o valor de $_GET['path']
			$path = $_GET['path'];

			// Limpa os dados
			$path = rtrim($path, '/');
			$path = filter_var($path, FILTER_SANITIZE_URL);

			// Cria um array de parâmetros
			$path = explode('/', $path);

			// Configura as propriedades
			$this->controller  = chk_array($path, 0);
			$this->controller .= '.controller';
			$this->action      = chk_array($path, 1);

			// Configura os parâmetros
			if (chk_array($path, 2)) {
				unset( $path[0] );
				unset( $path[1] );

				// Os parâmetros sempre virão após a ação
				$this->parameters = array_values($path);
			}


			// DEBUG
			//
			// echo $this->controller . '<br>';
			// echo $this->action . '<br>';
			// echo '<pre>';
			// print_r( $this->parameters );
			// echo '</pre>';
			// echo 'DEBUG';
		}

	} // get_url_data

} // End class ManagementMVC

?>