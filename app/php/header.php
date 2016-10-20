<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package feature-lights
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
	<div class="container header__container">
		<div class="header__logo"></div>
		<div class="nav nav--header">
			<?php wp_nav_menu( $defaults ); ?>
		</div>
		<div class="nav nav--mobile">
			<?php wp_nav_menu( $defaults ); ?>
		</div>
	</div>
</header>

<?php get_sidebar(); ?>