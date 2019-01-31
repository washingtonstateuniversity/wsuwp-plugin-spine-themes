<header class="hero-banner<?php if ( ! empty( $img_src ) ) : ?> unbound recto has-image<?php endif; ?>" 
	<?php if ( ! empty( $img_src ) ) : ?>
	style="background-image:url('<?php echo esc_url( $img_src ); ?>')" 
	title="<?php echo esc_attr( $img_alt ); ?>"
	<?php endif; ?>
>
	<div class="hero-banner-inner">
		<hgroup class="hero-banner-copy">
			<?php if ( ! empty( $subtitle ) && ! empty( $subtitle_before ) ) : ?><div class="hero-banner-subtitle"><?php echo esc_html( $subtitle ); ?></div><?php endif; ?>
			<?php if ( ! empty( $title ) ) : ?><<?php echo esc_html( $title_tag ); ?> class="hero-banner-title"><?php echo esc_html( $title ); ?></<?php echo esc_html( $title_tag ); ?>><?php endif; ?>
			<?php if ( ! empty( $subtitle ) && empty( $subtitle_before ) ) : ?><div class="hero-banner-subtitle"><?php echo esc_html( $subtitle ); ?></div><?php endif; ?>
		</hgroup>
	<div class="hero-banner-inner">
</header>
