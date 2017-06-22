<?php 

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

DEFINE(WP_URL, get_bloginfo('url'));
DEFINE(WP_NAME, get_bloginfo('name'));
DEFINE(WP_TEMPLATE, get_bloginfo('template_url'));
DEFINE(WP_DESCRIPTION, get_bloginfo('description'));

add_filter('show_admin_bar', '__return_false');

add_theme_support( 'post-thumbnails' );


add_action('admin_menu','wp_hide_msg');
function wp_hide_msg() {
     remove_action( 'admin_notices', 'update_nag', 3 );
}

function varScript(){
    echo '<script type="text/javascript">
        var templateUrl = "'.WP_TEMPLATE.'";
    </script>';
}
add_action('admin_enqueue_scripts', 'varScript');
if(is_admin()) {
    wp_enqueue_script('jquery-ui', get_template_directory_uri().'/jquery-ui.min.js');
    wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/jquery-ui.min.css');
    wp_enqueue_script('custom-js', get_template_directory_uri().'/custom-js.js');
}

function googlePlaces(){
    echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAKUTbamk1pEER1vty-_nB2UHYKnO37Y&libraries=places"></script>';
}
add_action('admin_enqueue_scripts', 'googlePlaces');

function rebranding_wordpress_logo(){
    global $wp_admin_bar;
    //Remove o submeu padrão
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('wporg');


    //Altera a logo do wp
    $wp_admin_bar->add_menu( array(
        'id'    => 'wp-logo',
        'title' => '<img src="'.get_bloginfo('template_directory').'/image/admin_logo.png" />',
        'href'  => __('http://www.finer.com.br'),
        'meta'  => array(
            'title' => __('Finer'),
        ),
    ) );
}
add_action('wp_before_admin_bar_render', 'rebranding_wordpress_logo' );
function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  $buttons[] = 'sup';

  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");
///// SUPORTE BOX /////
function dashboard_widget_function( $post, $callback_args ) {
    echo "<b>(42)</b> 3223-1295<br><b>(41)</b> 3025-5156<br>suporte@finer.com.br<br><hr>Dr. Colares, 178 - Centro<br>Ponta Grossa/PR.<br><a href='http://finer.com.br/contato/'>www.finer.com.br</a>
";
}

// Function used in the action hook
function add_dashboard_widgets() {
    wp_add_dashboard_widget('dashboard_suporte', 'Precisa de Ajuda?', 'dashboard_widget_function');
}

add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
/**
 * Altera a assinatura
 */

function alterar_footer (){
    echo '<span id="footer-thankyou">Desenvolvido por <a href="http://www.finer.com.br/">Finer Soluções Web</a></span>';
}
add_filter('admin_footer_text', 'alterar_footer');

/**
 * Customiza a logo do login
 */
function cutom_login_logo() {
    echo "<style type=\"text/css\">
            body.login div#login h1 a {
            background-image: url(" . get_bloginfo('template_directory') . "/image/finer-logo.png);
            width: 274px;
            background-size: 274px 63px;
        }</style>";
}
add_action('login_enqueue_scripts', 'cutom_login_logo');

function my_login_css() {
    echo '<link rel="stylesheet" type="text/css" href="' .get_bloginfo('template_directory').'/login.css">';
}

add_action('login_head', 'my_login_css');
add_action('admin_enqueue_scripts', 'my_login_css');

function getThumbUrl($post_id) {
    $url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
    return $url[0];
}

function conteudo($max=200){
    $content = get_the_content();

    $content = strip_shortcodes($content); 
    $content = preg_replace("/<img[^>]+\>/i", "", $content);     
    $content = apply_filters('the_content', $content);
    $content = strip_tags($content);

    $tok    =   strtok($content,' ');
    $content='';
    while($tok!==false && mb_strlen($content)<$max)
    {
        if (mb_strlen($content)+mb_strlen($tok)<=$max)
            $content.=$tok.' ';
        else
            break;
        $tok=strtok(' ');
    }
    return trim($content).'...';
}

function getInformacao()
{
    $args = array(
        'post_type'              => 'informacoes',
        'posts_per_page'         => 1,
    );

    $post = get_posts( $args );
    $informacoes = array();

    foreach ($post as $key => $value) {
        $custom = get_post_custom($value->ID);

        $informacoes['email']       = $custom["informacao_email"][0];
        $informacoes['facebook']    = $custom["informacao_facebook"][0];
        $informacoes['instagram']   = $custom["informacao_instagram"][0];
        $informacoes['linkedin']    = $custom["informacao_linkedin"][0];
        $informacoes['twitter']     = $custom["informacao_twitter"][0];
        $informacoes['telefones']   = get_post_meta( $post->ID, 'telefone', true );

        $informacoes['smtp_host']              = $custom["smtp_host"][0];
        $informacoes['smtp_username']          = $custom["smtp_username"][0];
        $informacoes['smtp_senha']             = $custom["smtp_senha"][0];
        $informacoes['smtp_from1']             = $custom["smtp_from1"][0];
        $informacoes['smtp_from2']             = $custom["smtp_from2"][0];
        $informacoes['smtp_from3']             = $custom["smtp_from3"][0];        
    }

    return $informacoes;
}

?>