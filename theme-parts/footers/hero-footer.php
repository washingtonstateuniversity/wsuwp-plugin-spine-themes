<footer class="hero-footer">
	<?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?><div class="hero-footer-widget-area">
		<?php dynamic_sidebar( 'footer_widgets' ); ?>
	</div><?php endif; ?>
	<div class="hero-footer-contact">
		<ul>
			<?php if ( ! empty( $unit_name ) ) : ?>
			<li>
				<?php if ( ! empty( $unit_url ) ) : ?><a href="<?php echo esc_url( $unit_url ); ?>"><?php endif; ?>
				<?php echo esc_html( $unit_name ); ?>
				<?php if ( ! empty( $unit_url ) ) : ?></a><?php endif; ?>
			</li><?php endif; ?>
			<?php if ( ! empty( $street_address ) ) : ?><li><?php echo esc_html( $street_address ); ?></li><?php endif; ?>
			<?php if ( ! empty( $city_state ) ) : ?>
				<li><?php echo esc_html( $city_state ); ?>, 
				<?php if ( ! empty( $postal_code ) ) : ?><?php echo esc_html( $postal_code ); ?><?php endif; ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $email ) ) : ?><li><a href="mailto:<?php echo esc_url( $email ); ?>"><?php echo esc_html( $email ); ?></a></li><?php endif; ?>
			<?php if ( ! empty( $phone ) ) : ?><li><a href="tel:<?php echo esc_url( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
		</ul>
	</div>
</footer>
