<?php

// Example controller

class HomeController extends MainController {

	// Load page '/views/home/home-view.php'
	public function index() {

		// Title page
		$this->title = 'Home';

		// Carrega o modelo para este view - NAO FAZIA PARTE DESTE ARQUIVO
        $modelo = $this->load_model('posts/posts-adm.model');

		// Parameters of function
		$parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();

		/** Load archieves of View **/
		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/_includes/menu.php';
		require ABSPATH . '/views/home/home.view.php';
		require ABSPATH . '/views/_includes/footer.php';

	} // End function index

} // End class HomeController

?>