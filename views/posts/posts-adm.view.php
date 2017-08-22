<?php

// Evita acesso direto a este arquivo
if ( ! defined('ABSPATH')) exit;

// Configura as URLs
$adm_uri = HOME_URI . '/posts/adm/';
$edit_uri = $adm_uri . 'edit/';
$delete_uri = $adm_uri . 'del/';

		
// Carrega o método para obter uma notícia
$modelo->get_post();

// Carrega o método para inserir uma notícia
$modelo->inserts_post();

// Carrega o método para apagar a notícia
$modelo->form_confirm = $modelo->delete_post();

// Remove o limite de valores da lista de notícias
$modelo->unlimited = true;

?>

<div data-role="main" class="ui-content">

	<?php 
	// Mensagem de configuração caso o usuário tente apagar algo
	echo $modelo->form_confirm;
	?>

	<!-- Formulário de edição das notícias -->
	<form method="post" action=""><!-- enctype="multipart/form-data">-->
		<table class="form-table">
			<tr>
				<td>
					Título: <br>
					<input type="text" name="post_title" value="<?php echo htmlentities( utf8_decode( chk_array( $modelo->form_data, 'post_title') ) );	?>" />
				</td>
			</tr>

			<tr>
				<td>
					Subtítulo: <br>
					<input type="text" name="post_subtitle" value="<?php echo htmlentities( utf8_decode( chk_array( $modelo->form_data, 'post_subtitle') ) ); ?>" />
				</td>
			</tr>

			<tr>
				<td>
					Categoria: <br>
					<input type="text" name="post_category" value="<?php echo htmlentities( utf8_decode( chk_array( $modelo->form_data, 'post_category') ) ); ?>" />
				</td>
			</tr>

			<tr>
				<td>
					Subcategoria: <br>
					<input type="text" name="post_subcategory" value="<?php echo htmlentities( utf8_decode( chk_array( $modelo->form_data, 'post_subcategory') ) ); ?>" />
				</td>
			</tr>

			<!--<tr>
				<td>
					Imagem: <br>
					<input type="file" name="post_imagem" value="" />
				</td>
			</tr>-->
			<tr>
				<td>
					Data: <br>
					<input type="text" name="post_date" value="<?php 
					$date_saved = chk_array( $modelo->form_data, 'post_date');
					if ( $date_saved && $date_saved != '0000-00-00 00:00:00' )
					echo date('d-m-Y H:i:s', strtotime( $date_saved ));
					else
					echo date('d-m-Y H:i:s');
					?>" />
				</td>
			</tr>
			<tr>
				<td>
					Autor: <br>
					<input type="text" name="post_author" value="<?php 
					echo htmlentities( $_SESSION['userdata']['user_name'] );
					?>" />
				</td>
			</tr>
			<tr>
				<td>
					Texto da notícia: <br>
					<textarea name="post_content"><?php
					echo htmlentities( utf8_decode (chk_array( $modelo->form_data, 'post_content' ) ) );
					?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php

					// Mensagem de feedback para o usuário
					echo $modelo->form_message;

					?>

					<input type="submit" value="Save" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="inserts_post" value="1" />
	</form>
	
	<!-- LISTA AS posts -->
	<?php $list = $modelo->list_posts(); ?>

	<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">
		<thead>
			<tr>
				<th data-priority="1">Postagem</th>
				<th data-priority="1">Autor</th>
				<th data-priority="1">Açoes</th>
			</tr>
		</thead>

		<?php foreach( $list as $post ):?>
		
		<tbody>
			<tr>
				<td><p><?php echo $post['post_title']?></p></td>
				<td><p><?php echo $post['post_author']?></p></td>
				<td>
					<a href="<?php echo $edit_uri . $post['post_id']?>" class="ui-nodisc-icon ui-btn ui-btn-b ui-btn-inline ui-icon-edit ui-btn-icon-notext">
						Editar
					</a> 
					
					<a href="<?php echo $delete_uri . $post['post_id']?>" class="ui-nodisc-icon ui-btn ui-btn-b ui-btn-inline ui-icon-delete ui-btn-icon-notext">
						Apagar
					</a>
				</td>
			</tr>
		</tbody>

		<?php endforeach; ?>

	</table>

</div> <!-- .ui-content -->
