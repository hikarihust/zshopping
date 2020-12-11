<?php
get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<?php 
					global $zController;
					$zController->getController('Product','/frontend');
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
