<?php
/**
 * The template for displaying the sidebar.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package feature-lights
 */
?>

<aside class="sidebar">
	<div class="container sidebar__container">
		<section class="sidebar-top">
			<div class="sidebar-top__logo"></div>
		</section>
		<?php the_widget('WP_Ajax_product_filters') ?>
	</div>
</aside>
