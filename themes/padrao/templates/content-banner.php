<article id="banner">
	<?php  
		$args = array(
			'post_type'				 => 'slider',
			'posts_per_page'         => 4,
		);
	
		$my_query = new WP_Query( $args );
	
		while($my_query->have_posts()) : $my_query->the_post(); 
	?>
		<div class="item">
			<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
		</div>	
	<?php endwhile; ?>
</article>