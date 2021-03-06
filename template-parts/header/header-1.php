<?php
/**
 * Template part for displaying Header, style 1.
 *
 * @package Artpop
 * @since Artpop 1.0
 */

?>

<div class="container">
	<div class="header-wrapper">
		<div class="site-branding">
			<?php artpop_custom_logo(); ?>
		</div>
		<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>
		<div class="header-actions">
			<?php artpop_social_menu(); ?>
			<?php if( artpop_is_woocommerce_active() ) artpop_woocommerce_cart_link(); ?>
			<?php artpop_search_popup_amp(); ?>
		</div>
	</div>
</div>
