<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vice
 */

?>

		<?php if( !is_home() ) { ?> </div><!-- #wrap --> <?php } ?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url('https://wordpress.org/'); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'vice' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'vice' ), 'Vice', '<a href="http://github.com/saumya010" rel="designer">Saumya Sharma</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
