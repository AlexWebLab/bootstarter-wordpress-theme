<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap_extended.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-flexbox.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancyBox-18d1712/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/select2-4.0.3/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/flickity-2.0.5/flickity.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/jasny-bootstrap-3.1.3/css/jasny-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation navbar" role="navigation">
		  <div class="container-fluid">
		    <div class="navbar-header">
				<button type="button" class="icon icon--transparent navbar-toggle collapsed" data-toggle="collapse" data-target="#main_navigation">
  				  <span></span><span></span><span></span>
  			  </button>
		      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
		    </div>
	        <?php
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'primary',
	                'depth'             => 2,
	                'container'         => 'div',
	                'container_class'   => 'collapse navbar-collapse',
	        		'container_id'      => 'main_navigation',
	                'menu_class'        => 'nav navbar-nav',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'walker'            => new wp_bootstrap_navwalker())
	            );
	        ?>
		    </div>
		</nav><!-- #site-navigation -->

    </header><!-- #masthead -->

	<main id="main" class="site-main" role="main">
