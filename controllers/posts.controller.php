<?php
/**
 * postsController - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class PostsController extends MainController {

	/**
	 * $login_required
	 *
	 * Se a página precisa de login
	 *
	 * @access public
	 */
	public $login_required = false;

	/**
	 * $permission_required
	 *
	 * Permissão necessária
	 *
	 * @access public
	 */
	public $permission_required;

	/**
	 * Carrega a página "/views/posts/index.php"
	 */
    public function index() {
		// Título da página
		$this->title = 'posts';
	
		// Carrega o modelo para este view
        $modelo = $this->load_model('posts/posts-adm.model');
				
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/posts/posts.view.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
	/**
	 * Carrega a página "/views/posts/posts-adm-view.php"
	 */
    public function adm() {
		// Page title
		$this->title = 'Gerenciar posts';
		$this->permission_required = 'gerenciar-posts';
		
		// Verifica se o usuário está logado
		if ( ! $this->logged_in ) {
		
			// Se não; garante o logout
			$this->logout();
			
			// Redireciona para a página de login
			$this->goto_login();
			
			// Garante que o script não vai passar daqui
			return;
		
		}
		
		// Verifica se o usuário tem a permissão para acessar essa página
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
		
			// Exibe uma mensagem
			echo 'Você não tem permissões para acessar essa página.';
			
			// Finaliza aqui
			return;
		}
	
		// Carrega o modelo para este view
        $modelo = $this->load_model('posts/posts-adm.model');
		
		/** Carrega os arquivos do view **/
		
		// /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';
		
		// /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';
		
		// /views/posts/index.php
        require ABSPATH . '/views/posts/posts-adm.view.php';
		
		// /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
		
    } // adm
	
} // class postsController