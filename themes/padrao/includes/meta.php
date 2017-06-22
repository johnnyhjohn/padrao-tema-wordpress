<?php 
/**
 * Custom Meta Boxes
 */
function admin_init() {
    add_meta_box("informacao_email", "Informações", "informacao_email", "informacoes", "normal", "high");
}

add_action("admin_init", "admin_init");

/**
 * Custom Saves
 */
function save_details() {
    global $post;

    foreach ($_POST as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}

add_action('save_post', 'save_details');

/**
 * Meta Box Informação
 */
function informacao_email() {
    global $post;

    $custom = get_post_custom($post->ID);

    $informacao_email       = $custom["informacao_email"][0];
    $informacao_facebook    = $custom["informacao_facebook"][0];
    $informacao_instagram   = $custom["informacao_instagram"][0];
    $informacao_linkedin    = $custom["informacao_linkedin"][0];
    $informacao_twitter     = $custom["informacao_twitter"][0];

    $smtp_host              = $custom["smtp_host"][0];
    $smtp_username          = $custom["smtp_username"][0];
    $smtp_senha             = $custom["smtp_senha"][0];
    $smtp_from1             = $custom["smtp_from1"][0];
    $smtp_from2             = $custom["smtp_from2"][0];
    $smtp_from3             = $custom["smtp_from3"][0];

    $telefone               = get_post_meta( $post->ID, 'telefone', true );

    ?>
        <p><input placeholder="Facebook" type="text" style="width: 100%;" name="informacao_email" value="<?php echo $informacao_email; ?>"/></p>
        <p><input placeholder="Instagram" type="text" style="width: 100%;" name="informacao_instagram" value="<?php echo $informacao_instagram; ?>"/></p>
        <p><input placeholder="Linkedin" type="text" style="width: 100%;" name="informacao_linkedin" value="<?php echo $informacao_linkedin; ?>"/></p>
        <p><input placeholder="Twitter" type="text" style="width: 100%;" name="informacao_twitter" value="<?php echo $informacao_twitter; ?>"/></p>
        <p><input placeholder="contato@gmail.com" type="text" style="width: 100%;" name="informacao_facebook" value="<?php echo $informacao_facebook; ?>"/></p>
        <h4>Telefone(s)</h4>
        <div class="telefones">
            <?php if($telefone) : ?>
                <?php foreach ($telefone as $key => $value): ?>
                <p class="item">
                    <input placeholder="(42) 9999 - 9999" type="text" name="telefone[<?php echo $key ?>]" value="<?php echo $value ?>" style="width: 90%;">
                    <a class="repeatable-add button btn-success" href="#">+</a>
                    <a class="repeatable-remove button" href="#">-</a>
                </p>      
                <?php endforeach ?>
            <?php else : ?>
            <p class="item">
                <input placeholder="(42) 9999 - 9999" type="text" name="telefone[0]" style="width: 90%;">
                <a class="repeatable-add button btn-success" href="#">+</a>
                <a class="repeatable-remove button" href="#">-</a>
            </p>
            <?php endif; ?>
        </div>
        <h4>SMTP Configuração</h4>
        <p><input placeholder="Host" type="text" style="width: 100%;" name="smtp_host" value="<?php echo $smtp_host; ?>"/></p>
        <p><input placeholder="Username" type="text" style="width: 100%;" name="smtp_username" value="<?php echo $smtp_username; ?>"/></p>
        <p><input placeholder="Senha" type="text" style="width: 100%;" name="smtp_senha" value="<?php echo $smtp_senha; ?>"/></p>
        <p><input placeholder="Para Email 1" type="text" style="width: 100%;" name="smtp_from1" value="<?php echo $smtp_from1; ?>"/></p>
        <p><input placeholder="Para Email 2" type="text" style="width: 100%;" name="smtp_from2" value="<?php echo $smtp_from2; ?>"/></p>
        <p><input placeholder="Para Email 3" type="text" style="width: 100%;" name="smtp_from3" value="<?php echo $smtp_from3; ?>"/></p>

    <?php
}
