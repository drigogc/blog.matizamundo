<?php 

class PostsAdmModel extends MainModel { // NoticiasAdmModel

	// You will receive the number of posts per page to set up a listing of news
	// Also used in pagination
	public $posts_per_page = 5;
	
	// Constructor for this class
	// Configures the DB, controller, parameters and user data
	public function __construct( $db = false, $controller = null ) {
		// Configura o DB (PDO)
		$this->db = $db;
		
		// Configura o controlador
		$this->controller = $controller;

		// Configura os parâmetros
		$this->parameters = $this->controller->parameters;

		// Configura os dados do usuário
		$this->userdata = $this->controller->userdata;
	}
	
	// List the posts
	public function list_posts () {
	
		// Configura as variáveis que vamos utilizar
		$id = $where = $query_limit = null;
		
		// Verifica se um parâmetro foi enviado para carregar uma Post
		if ( is_numeric( chk_array( $this->parameters, 0 ) ) ) {
			
			// Configura o ID para enviar para a consulta
			$id = array ( chk_array( $this->parameters, 0 ) );
			
			// Configura a cláusula where da consulta
			$where = " WHERE post_id = ? ";
		}
		
		// Configura a página a ser exibida
		$page = ! empty( $this->parameters[1] ) ? $this->parameters[1] : 1;
		
		// A páginação inicia do 0
		$page--;
		
		// Configura o número de posts por página
		$posts_per_page = $this->posts_per_page;
		
		// O offset dos posts da consulta
		$offset = $page * $posts_per_page;
		
		/* 
		Esta propriedade foi configurada no noticias-adm-model.php para
		prevenir limite ou paginação na administração.
		*/
		if ( empty ( $this->unlimited ) ) {
		
			// Configura o limite da consulta
			$query_limit = " LIMIT $offset,$posts_per_page ";
		
		}
		
		// Faz a consulta
		$query = $this->db->query(
			'SELECT * FROM tb_posts ' . $where . ' ORDER BY post_id DESC' . $query_limit,
			$id
		);
		
		// Retorna
		return $query->fetchAll();
	} // listar_noticias
	
	/**
	 * Obtém a Post e atualiza os dados se algo for postado
	 *
	 * Obtém apenas uma Post da base de dados para preencher o formulário de
	 * edição.
	 * Configura a propriedade $this->form_data.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function get_post() {
		
		// Verifica se o primeiro parâmetro é "edit"
		if ( chk_array( $this->parameters, 0 ) != 'edit' ) {
			return;
		}
		
		// Verifica se o segundo parâmetro é um número
		if ( ! is_numeric( chk_array( $this->parameters, 1 ) ) ) {
			return;
		}
		
		// Configura o ID da Post
		$post_id = chk_array( $this->parameters, 1 );
		
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		inserts_post.
		
		Se verdadeiro, atualiza os dados conforme a requisição.
		*/
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['inserts_post'] ) ) {
		
			// Remove o campo inserts_post para não gerar problema com o PDO
			unset($_POST['inserts_post']);
			
			// Verifica se a data foi enviada
			$date_saved = chk_array( $_POST, 'post_date' );
			
			/*
			Inverte a data para os formatos dd-mm-aaaa hh:mm:ss
			ou aaaa-mm-dd hh:mm:ss
			*/
			$new_date = $this->inverts_date( $date_saved );
			
			// Adiciona a data no $_POST		
			$_POST['post_date'] = $new_date;
			
			// Tenta enviar a imagem
			/*$imagem = $this->upload_imagem();
			
			// Verifica se a imagem foi enviada
			if ( $imagem ) {
				// Adiciona a imagem no $_POST
				$_POST['noticia_imagem'] = $imagem;
			}*/
			
			// Atualiza os dados
			$query = $this->db->update('tb_posts', 'post_id', $post_id, $_POST);
			
			// Verifica a consulta
			if ( $query ) {
				// Retorna uma mensagem
				$this->form_message = '<p class="success">Post atualizado com sucesso!</p>';
			}
			
		}
		
		// Faz a consulta para obter o valor
		$query = $this->db->query(
			'SELECT * FROM tb_posts WHERE post_id = ? LIMIT 1',
			array( $post_id )
		);
		
		// Obtém os dados
		$fetch_data = $query->fetch();
		
		// Se os dados estiverem nulos, não faz nada
		if ( empty( $fetch_data ) ) {
			return;
		}
		
		// Configura os dados do formulário
		$this->form_data = $fetch_data;
		
	} // get_post
	
	/**
	 * Insere Posts
	 *
	 * @since 0.1
	 * @access public
	 */
	public function inserts_post() {
	
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		inserts_post.
		*/
		if ( 'POST' != $_SERVER['REQUEST_METHOD'] || empty( $_POST['inserts_post'] ) ) {
			return;
		}
		
		/*
		Para evitar conflitos apenas inserimos valores se o parâmetro edit
		não estiver configurado.
		*/
		if ( chk_array( $this->parameters, 0 ) == 'edit' ) {
			return;
		}
		
		// Só pra garantir que não estamos atualizando nada
		if ( is_numeric( chk_array( $this->parameters, 1 ) ) ) {
			return;
		}
			
		// Tenta enviar a imagem
		/*$imagem = $this->upload_imagem();
		
		// Verifica se a imagem foi enviada
		if ( ! $imagem ) {
			return;		
		}*/
		
		// Remove o campo insere_notica para não gerar problema com o PDO
		unset($_POST['inserts_post']);
		
		// Insere a imagem em $_POST
		//$_POST['noticia_imagem'] = $imagem;
		
		// Configura a data
		$date_saved = chk_array( $_POST, 'post_date');
		$new_date = $this->inverts_date($date_saved);
					
		// Adiciona a data no POST
		$_POST['post_date'] = $new_date;
		
		// Insere os dados na base de dados
		$query = $this->db->insert('tb_posts', $_POST);
		
		// Verifica a consulta
		if ( $query ) {
		
			// Retorna uma mensagem
			$this->form_message = '<p class="success">Post salvo com sucesso!</p>';
			return;
			
		} 
		
		// :(
		$this->form_message = '<p class="error">Erro ao enviar dados!</p>';

	} // inserts_post
	
	/**
	 * Apaga a Post
	 *
	 * @since 0.1
	 * @access public
	 */
	public function delete_post () {
		
		// O parâmetro del deverá ser enviado
		if ( chk_array( $this->parameters, 0 ) != 'del' ) {
			return;
		}
		
		// O segundo parâmetro deverá ser um ID numérico
		if ( ! is_numeric( chk_array( $this->parameters, 1 ) ) ) {
			return;
		}
		
		// Para excluir, o terceiro parâmetro deverá ser "confirma"
		if ( chk_array( $this->parameters, 2 ) != 'confirma' ) {
		
			// Configura uma mensagem de confirmação para o usuário
			$mensagem  = '<p class="alert">Tem certeza que deseja apagar a Post?</p>';
			$mensagem .= '<p><a href="' . $_SERVER['REQUEST_URI'] . '/confirma/"class="ui-btn ui-corner-all ui-btn-inline">Sim</a>';
			$mensagem .= '<a href="' . HOME_URI . '/posts/adm/" class="ui-btn ui-corner-all ui-btn-inline">Não</a></p>';

			
			// Retorna a mensagem e não excluir
			return $mensagem;
		}
		
		// Configura o ID da Post
		$post_id = (int)chk_array( $this->parameters, 1 );
		
		// Executa a consulta
		$query = $this->db->delete('tb_posts', 'post_id', $post_id);
		
		// Redireciona para a página de administração de Posts
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/posts/adm/">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/posts/adm/";</script>';
		
	} // apaga_noticia
	
	/**
	 * Paginação
	 *
	 * @since 0.1
	 * @access public
	 */
	public function pagination () {
	
		/* 
		Verifica se o primeiro parâmetro não é um número. Se for é um single
		e não precisa de paginação.
		*/
		if ( is_numeric( chk_array( $this->parameters, 0) ) ) {	
			return;
		}
		
		// Obtém o número count_posts de Posts da base de dados
		$query = $this->db->query(
			'SELECT COUNT(*) as count_posts FROM tb_posts '
		);
		$count_posts = $query->fetch();
		$count_posts = $count_posts['count_posts'];
		
		// Configura o caminho para a paginação
		$path_posts = HOME_URI . '/posts/page/'; // /index/page/';
		
		// Itens por página
		$posts_per_page = $this->posts_per_page;
		
		// Obtém a última página possível
		$last = ceil($count_posts/$posts_per_page);
		
		// Configura a primeira página
		$first = 1;
		
		// Configura os offsets
		$offset1 = 3;
		$offset2 = 6;
		
		// Página atual
		$current = $this->parameters[1] ? $this->parameters[1] : 1;
		
		echo '<div data-role="controlgroup" data-type="horizontal" data-mini="true">';

		// Exibe a primeira página e reticências no início
		if ( $current > 4 ) {
			echo '<a href="' . $path_posts . $first . '" class="ui-btn ui-corner-all">' . $first . '</a>';
			echo '<a href="" class="ui-btn ui-corner-all">...</a>';
		}
		
		// O primeiro loop toma conta da parte esquerda dos números
		for ( $i = ( $current - $offset1 ); $i < $current; $i++ ) {
			if ( $i > 0 ) {
				echo '<a href="' . $path_posts . $i . '" class="ui-btn ui-corner-all">' . $i . '</a>';
				
				// Diminiu o offset do segundo loop
				$offset2--;
			}
		}
		
		// O segundo loop toma conta da parte direita dos números
		// Obs.: A primeira expressão realmente não é necessária
		for ( ; $i < $current + $offset2; $i++ ) {
			if ( $i <= $last ) {
				echo '<a href="' . $path_posts . $i . '" class="ui-btn ui-corner-all">' . $i . '</a>';
			}
		}
		
		// Exibe reticências e a última página no final
		if ( $current <= ( $last - $offset1 ) ) {
			echo ' ... <a href="' . $path_posts . $last . '" class="ui-btn ui-corner-all">' . $last . '</a>';
		}

		echo '</div>';

	} // paginacao
	
	
	
	

	public function listDivider($posts) {

		$list_divider = '<li data-role="list-divider" style="color: #777;"><b>'; 
		$list_divider = $list_divider . ucfirst(strftime('%a, %d de %B de %Y', strtotime($posts))) . '</b></li>';
		
		echo $list_divider;

	}

	public function postContent($id, $title, $subtitle) {
		
		$content_post = '<li><a href="'. HOME_URI . '/posts/index/' . $id . '">'; //index/' . $id . '">';
		

		$content_post = $content_post . "<h2>" . $title . "</h2>";
		$content_post = $content_post . "<p>" . $subtitle . "</p>";
		$content_post = $content_post . '</a></li>';

		echo $content_post;
		
	}
	
} // NoticiasAdmModel