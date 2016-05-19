<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stone_Soup
 */

?>

	</div><!-- #content -->

	<section class="search-mod">
		<?php
			get_search_form();
		?>
	</section>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<ul class="site-info">
			<li><a href="/subscriptions">Subscriptions</a></li>
			<li><a href="/contact">Contact</a></li>
			<li><a href="/?feed=rss" target="_blank">RSS</a></li>
			<li>&copy; Stonesoup <?php echo date("Y") ?></li>
		</ul><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/js/jquery.customSelect.js"></script>
<script type="text/javascript">
	$(function(){
		$('select.styled').customSelect();
	});
</script>

<script type="text/javascript">
jQuery(window).load(function() {
        
	// MASSONRY Without jquery
	var container = document.querySelector('#ms-container');
	var msnry = new Masonry( container, {
	itemSelector: '.ms-item',
	columnWidth: '.ms-item',                
	});  
      
});
</script>

</body>
</html>
