<?php
get_header(); ?>
<style type="text/css">
	#content{
		margin-right: 20px;
	}
</style>
		<div id="container">
			<div id="content" role="main">
				<?php 
					global $zController;
					$zController->getController('Cart','/frontend');
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
