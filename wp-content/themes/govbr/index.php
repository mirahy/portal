<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since 0.1.0
 */

get_header();

the_breadcrumb();

?>

<?php if (is_home() && !is_front_page() && !empty(single_post_title('', false))) : ?>

	<?php
	/**
	 * Action for rendering content before the page header in the index template.
	 *
	 * @since 0.1.0
	 */
	do_action('gov_br_index_before_page_header');
	?>

	<header class="page-header container-lg">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->

	<?php
	/**
	 * Action for rendering content after the page header in the index template.
	 *
	 * @since 0.1.0
	 */
	do_action('gov_br_index_after_page_header');
	?>

<?php endif; ?>

<!-- slider -->
<!-- <div class="container-slide">
	<div id="slider" class="col-sm-12 hidden-sm hidden-xs" style="max-width: 1170px;">
		<?php if (function_exists('show_simpleresponsiveslider')) : ?>
			<?php show_simpleresponsiveslider(); ?>
		<?php endif; ?>
	</div>
</div> -->
<!-- Noticias -->
<div class="container container-noticias">
	<!-- Carrossel -->
	<div class="row col-xs-6">
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<?php $cont = 0;
				query_posts('category_name=noticias&posts_per_page=4'); ?>
			<div class="carousel-indicators">
				<?php while (have_posts()) : the_post(); ?>
					<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $cont ?>"
					 <?php if ($cont == 1) {echo "class='active' aria-current='true'";} ?>  aria-label="<?php echo 'Slide '.$cont ?>"></button>
					 <?php $cont++ ?>
				<?php endwhile; ?>
			</div>
			<div class="carousel-inner">
			<?php $cont = 0; ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="carousel-item <?php if ($cont == 1) {
													echo 'active';
												} ?> ">
						<a href="<?php the_permalink(); ?>">
							<div>
								<figure class="post_thumbnail d-block w-100">
									<?php if (has_post_thumbnail()) {
										echo the_post_thumbnail('full');
									}; ?>
								</figure>
							</div>
							<div>
								<strong><?php the_title(); ?></strong>
							</div>
						</a>
					</div>
					<?php $cont++ ?>
				<?php endwhile; ?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<!-- Noticias -->
	<div class="row col-xs-6">
		<div class="col-xs-6 listagem-de-posts container">
			<h1 id="titulo-noticia">Notícias</h1>

			<?php while (have_posts()) : the_post(); ?>

				<article class="post">

					<!-- <time datetime="<?php the_time('c') ?>">
						<?php the_time(get_option('date_format')); ?>
					</time> -->

					<h3 class="post-title">
						<a href="<?php the_permalink(); ?>">
							<strong><?php the_title(); ?></strong>
							<p class="p-post"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
						</a>

					</h3>

				</article>

			<?php endwhile; ?>
		</div>
	</div>
</div>

<!-- Grid de acesso Rápido -->
<div class="container">
	<div class="row acess-cards">
		<div class="access-links col-xs-12 container-lg">
			<div class="col-md-3 card-easy">
				<a href="<?php bloginfo('url') ?>/secaf" class="card-easy-access">Secretaria Acadêmica</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="http://ojs.ufgd.edu.br/index.php?journal=ead" class="card-easy-access">Revista EaD</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="<?php bloginfo('url') ?>/tutoriais" class="card-easy-access">Orientações e Tutoriais</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="https://suporte.ead.ufgd.edu.br" class="card-easy-access">Solicitação de Sala</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="?page_id=6108" class="card-easy-access">Dúvidas e FAQ</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="<?php bloginfo('url') ?>/duvidas" class="card-easy-access">Documentos</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="<?php echo site_url('/validar-certificado/'); ?>" class="card-easy-access">Validar Certificado</a>
			</div>
			<div class="col-md-3 card-easy">
				<a href="<?php echo site_url('/formandos-2/'); ?>" class="card-easy-access">Egressos</a>
			</div>
		</div>
	</div>


	<!-- <div class="row access">
	
			<div class="col-xs-12 col-md-12 easyaccess">
				 Grid do Painel
				<div class="col-md-3 ">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
									<a href="<?php bloginfo('url') ?>/secaf" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/secaf.png" width=600 height=400 alt=""></a>
									<p class="celular">Secretaria Acadêmica</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Secretaria Acadêmica</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
									<a href="http://ojs.ufgd.edu.br/index.php?journal=ead" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-revista.png" width=600 height=400 alt=""></a>
									<p class="celular">Revista EaD</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Revista EaD</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
									<a href="<?php bloginfo('url') ?>/tutoriais" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-tutoriais.png" width=600 height=400 alt=""></a>
									<p class="celular">Orientações e Tutoriais</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Orientações e Tutoriais</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
									<a href="https://suporte.ead.ufgd.edu.br" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-suporte.png" width=600 height=400 alt=""></a>
									<p class="celular">Solicitação de Sala</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Solicitação de Sala</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
	
									<a href="<?php bloginfo('url') ?>/duvidas" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-faq.png" width=600 height=400 alt=""></a>
									<p class="celular">Dúvidas e FAQ</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Dúvidas e FAQ</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
	
								<div class="project__card">
									<a href="?page_id=6108" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-documentos.png" width=600 height=400 alt=""></a>
									<p class="celular">Documentos</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Documentos</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
								<div class="project__card">
									<a href="<?php echo site_url('/validar-certificado/'); ?>" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-certificado.png" width=600 height=400 alt=""></a>
									<p class="celular">Validar Certificado</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Validar Certificado</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="column">
						<div class="project-list">
							<div class="project">
	
								<div class="project__card">
									<a href="<?php echo site_url('/formandos-2/'); ?>" class="project__image"><img src="<?php bloginfo('template_url'); ?>/images/index-formandos.png" width=600 height=400 alt=""></a>
									<p class="celular">Egressos</p>
									<div class="project__detail">
										<h3 class="project__title"><a href="#">Egressos</a></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
</div>
</div>

<?php
// if ( have_posts() ) {

// 	// Load posts loop.
// 	while ( have_posts() ) {
// 		the_post();

// 		get_template_part( 'template-parts/content/content', 'excerpt' );
// 	}

// 	echo '<div class="container-lg">';
// 	gov_br_the_posts_navigation();
// 	echo '</div>';

// } else {

// 	// If no content, include the "No posts found" template.
// 	get_template_part( 'template-parts/content/content-none' );

// }

get_footer();
