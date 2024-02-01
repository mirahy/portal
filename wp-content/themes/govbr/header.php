<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since 0.1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php gov_br_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<nav class="br-skiplink">
		<a class="br-item" href="#content" accesskey="1"><?php _e( 'Ir para o conteúdo (1/4)', 'govbr'); ?><span class="br-tag text ml-1">1</span></a>
		<a class="br-item" href="#-navigation" accesskey="2"><?php _e( 'Ir para o menu (2/4)', 'govbr'); ?><span class="br-tag text ml-1">2</span></a>
		<a class="br-item" href="#main-searchbox" accesskey="3"><?php _e( 'Ir para a busca (3/4)', 'govbr'); ?><span class="br-tag text ml-1">3</span></a>
		<a class="br-item" href="#footer" accesskey="4"><?php _e( 'Ir para o rodapé (4/4)', 'govbr'); ?><span class="br-tag text ml-1">4</span></a>
	</nav>

	<?php do_action( 'gov_br_before_site_header' ); ?>

	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<?php do_action( 'gov_br_after_site_header' ); ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
