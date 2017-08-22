<?php if ( ! defined('ABSPATH')) exit; ?>

<div data-role="main" class="ui-content">

	<div class="ui-grid-a rwd-example">
		<div class="ui-block-a" style="padding: .5em .5em .5em .5em;">

			<section id="author">
				<div class="ui-body ui-body-a ui-corner-all" style="text-align: center;">
					<h3 style="color: #ff6634; font-weight: 400; text-transform: uppercase;">Sobre o autor</h3>
					<p>Rodrigo Carvalho é Tecnólogo em Redes de Computadores e Gestão Empresarial, além de Empreendedor Digital. Aos 22 anos criou seu primeiro negócio online e desde então se dedica em ajudar pessoas com sua experiência por meio da internet.</p>

					<div class="ui-grid-solo">
						<a href="https://www.facebook.com/drigogc" class="ui-btn ui-btn-inline ui-corner-all" target="blank">
							<i class="fa fa-facebook fa-lg"></i>
						</a>

						<a href="https://www.behance.net/drigogc" class="ui-btn ui-btn-inline ui-corner-all" target="blank">
							<i class="fa fa-behance fa-lg"></i>
						</a>
					
						<a href="https://www.linkedin.com/in/rodrigo-garcia-de-carvalho-64b06865/" class="ui-btn ui-btn-inline ui-corner-all" target="blank">
							<i class="fa fa-linkedin fa-lg"></i>
						</a>
					</div>
					<br>
				</div>
			</section>

			<br>

			<section id="advert">
				<div class="ui-body ui-body-a ui-corner-all">
					<h3>Example AD</h3>

					<p>"Por isso não tema, pois estou com você; não tenha medo, pois sou o seu Deus. Eu o fortalecerei e o ajudarei; Eu o segurarei com a minha mão direita vitoriosa". Isaías 41:10 </p>
				</div>
			</section>

		</div>

		<div class="ui-block-b" style="padding: .5em .5em .5em .5em;">

			<section id="posts">

			    <h3 style="color: #777;">Postagens recentes</h3>

			    <!--<input type="number" name="quantity" placeholder="qtd por página" min="1" max="5">-->

			    <ul data-role="listview" data-inset="true">

			        <?php

					// Número de posts por página
					$modelo->posts_per_page = 4;

					// Lista notícias
					$list = $modelo->list_posts();

					foreach( $list as $posts ):

					
					$modelo->listDivider($posts['post_date']);//, $index);
					$modelo->postContent($posts['post_id'], $posts['post_title'], $posts['post_subtitle']);

			        /*<li data-role="list-divider" style="color: #777;">
			            <b>
			            <?php

			            setlocale(LC_ALL, 'pt_BR');
			            echo ucfirst(strftime('%a, %d de %B de %Y', strtotime($posts['post_date'])));

			            ?>
			            </b>
			        </li>

			        <li><a href="<?php echo HOME_URI?>/posts/index/<?php echo $posts['post_id']?>">
			            <?php

			            echo "<h2>" . $posts['post_title'] . "</h2>";
			            echo "<p>" . $posts['post_subtitle'] . "</p><br>";

			            ?>
			        </a></li>*/
		
					 endforeach; ?>
			    </ul>

			    <a href="<?php echo HOME_URI ?>/posts/" class="ui-btn ui-corner-all ui-icon-plus ui-btn-icon-left">Mais postagens</a>

			</section>

		</div><!-- /.ui-block-b -->
	</div>
	
</div><!-- .ui-content -->