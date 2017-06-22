<?php

include 'includes/meta.php';
include 'includes/restyle.php';

//////////////////////////////////////////////////
############## slider
//////////////////////////////////////////////////

add_action( 'init', 'slider' );
function slider() {
	$labels = array(
		'name' 			=> __( 'Slider' ),
		'singular_name' => __( 'Slider' ),		
	);

	$post = array(
		'labels' 			=> $labels,
		'supports'	 		=> array('title','thumbnail'),
		'capability_type'	=> 'post',
		'public' 			=> true,
		'has_archive' 		=> false,		
	);

	register_post_type( 'slider', $post);
}
//////////////////////////////////////////////////
############## sobre
//////////////////////////////////////////////////

add_action( 'init', 'sobre' );
function sobre() {
	$labels = array(
		'name' 			=> __( 'Sobre nós' ),
		'singular_name' => __( 'Sobre nós' ),		
	);

	$post = array(
		'labels' 			=> $labels,
		'supports'	 		=> array('title', 'editor','thumbnail'),
		'capability_type'	=> 'post',
		'public' 			=> true,
		'has_archive' 		=> false,		
	);

	register_post_type( 'sobre', $post);
}

//////////////////////////////////////////////////
############## noticias
//////////////////////////////////////////////////

add_action( 'init', 'noticias' );
function noticias() {
	$labels = array(
		'name' 			=> __( 'Notícias' ),
		'singular_name' => __( 'Notícias' ),		
	);

	$post = array(
		'labels' 			=> $labels,
		'supports'	 		=> array('title', 'editor','thumbnail'),
		'capability_type'	=> 'post',
		'public' 			=> true,
		'has_archive' 		=> false,		
	);

	register_post_type( 'noticias', $post);
}

//////////////////////////////////////////////////
############## blog
//////////////////////////////////////////////////

add_action( 'init', 'blog' );
function blog() {
	$labels = array(
		'name' 			=> __( 'Blog' ),
		'singular_name' => __( 'Blog' ),		
	);

	$post = array(
		'labels' 			=> $labels,
		'supports'	 		=> array('title', 'editor','thumbnail'),
		'capability_type'	=> 'post',
		'public' 			=> true,
		'has_archive' 		=> false,		
	);

	register_post_type( 'blog', $post);
}

//////////////////////////////////////////////////
############## informacoes
//////////////////////////////////////////////////

add_action( 'init', 'informacoes' );
function informacoes() {
	$labels = array(
		'name' 			=> __( 'Informações' ),
		'singular_name' => __( 'Informações' ),		
	);

	$post = array(
		'labels' 			=> $labels,
		'supports'	 		=> array('title'),
		'capability_type'	=> 'post',
		'public' 			=> true,
		'has_archive' 		=> false,		
	);

	register_post_type( 'informacoes', $post);
}