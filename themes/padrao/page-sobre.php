<?php get_header(); ?>
<section id="page">
	<?php  
		$args = array(
			'post_type'				 => 'sobre',
			'posts_per_page'         => 1,
		);
	
		$my_query = new WP_Query( $args );
	
		while($my_query->have_posts()) : $my_query->the_post(); 
	?>
		<div class="wrapper">
			<h1 class="text-center title"><?php the_title(); ?></h1>
		</div>
		<div class="container">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</section>
<?php get_footer(); ?>