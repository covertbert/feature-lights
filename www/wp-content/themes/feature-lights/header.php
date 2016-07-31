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
		<div class="nav">
			<ul class="menu">
				<li class="menu__item">Commercial expertise</li>
				<li class="menu__item">Home inspiration</li>
				<li class="menu__item">About</li>
				<li class="menu__item">Contact</li>
				<li class="menu__item">Store</li>
			</ul>
		</div>
	</div>
</header>

<div class="header-spacer"></div>