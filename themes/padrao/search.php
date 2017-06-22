<?php get_header(); ?>
<section id="page" class="single-servico">
    <article>
        <div class="container">
            <div class="col-md-12">
            <?php if ( have_posts() ) : ?>
              <h3 class="search-title">Resultados para a pesquisa : <?php echo get_search_query(); ?></h3>
            <?php else : ?>
                <h2 class="search-title">Nenhum resultado encontrado.</h2>
            <?php 
                endif;
            ?>
            <hr>
            <?php if ( have_posts() ) : ?>
                <?php while (have_posts() ) : the_post(); ?>       
                <div class="topicos">
                    <a href="<?php the_permalink(); ?>">
                    <h3 class="post-title"><?php the_title(); ?></h3>
                    <div class="descricao">
                        <?php echo conteudo(); ?>
                    </div>
                    </a> 
                </div>                
                <?php endwhile; ?>

            <?php else : ?>
            <?php endif; ?>            
            <?php //if(function_exists('tw_pagination')) tw_pagination(); ?>
            </div>
        </div>
    </article>
</section>
<?php get_footer(); ?>