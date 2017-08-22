<?php

// Evita acesso direto a este arquivo
if ( ! defined('ABSPATH')) exit;

?>

<div data-role="main" class="ui-content">

	<section id="posts">

		<ul data-role="listview" data-inset="true">

			<?php

			// Número de posts por página
			$modelo->posts_per_page = 10;

			// Lista notícias
			$list = $modelo->list_posts();

			foreach( $list as $posts ):

				$modelo->listDivider($posts['post_date']);
				$modelo->postContent($posts['post_id'], $posts['post_title'], $posts['post_subtitle']);
			
			endforeach;
			
			?>

		</ul>
		
		<?php
		
		// Verifica se estamos visualizando uma única notícia
		if ( is_numeric( chk_array( $modelo->parameters, 0 ) ) ): // single

		?>

			<br><br>

			<div class="ui-body ui-body-a ui-corner-all">

				<h3><?php echo $posts['post_title']; ?></h3>
				<p><?php echo 'Publicado em ' . $modelo->inverts_date( $posts['post_date'] ) . ' Por ' . $posts['post_author']; ?></p>

				<br>

				<p><?php echo $posts['post_content'] . '<br><br>'; ?></p>

				<br>

				<a href="" class="ui-btn ui-corner-all ui-icon-back ui-btn-icon-left" data-rel="back">Voltar</a>

			</div>

		<?php endif; ?>

		<?php $modelo->pagination(); ?>

	</section>

</div><!-- .ui-content -->