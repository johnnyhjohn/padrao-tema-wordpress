<?php get_header(); ?>
<?php 
    while (have_posts()) : the_post(); 
?> 
<section style="padding:50px 0;">
	<article id="produtos">
		<div class="container">
				<div class="row">
					<div class="row">
						<div class="col-sm-4">
							<?php the_post_thumbnail(full, array('class' => 'img-responsive')); ?>
						</div>
						<div class="col-sm-8 produto">
							<h4><?php the_title(); ?></h4>
							<p><?php the_content(); ?></p>

							<p class="dim">Dimensōes: <?php the_field('dimensoes'); ?></p>
							<p class="peso">Peso: <?php the_field('peso'); ?></p>
						</div>
					</div>
				</div>
				<hr>
		</div> <!-- final div.container -->
	</article> <!-- final article#produtos -->
</section>
<?php
    endwhile;
?>
<?php get_footer(); ?>