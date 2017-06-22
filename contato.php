<?php  

if($_SERVER['REQUEST_METHOD'] == "POST"){
	include 'mail/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    
    $nome       = $_POST['nome'];
    $email      = $_POST['email'];
    $assunto    = $_POST['assunto'];
    $mensagem   = $_POST['mensagem'];

    $conteudo = "";
    foreach ($_POST as $key => $value) {
        if($key != 'host' && $key != 'username' && $key != 'senha' && $key != 'para' && $key != 'undefined'){
            $conteudo .= "<strong style='text-transform:capitalize'>".$key."</strong> : ".$value."<br>";
        }
    }

    $mail->isSMTP();                                      	// Set mailer to use SMTP
    $mail->CharSet  = 'UTF-8';
    $mail->Host     = $_POST['host'];             			       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               	   // Enable SMTP authentication
    $mail->Username = $_POST['username'];      			          // SMTP username
    $mail->Password = $_POST['senha'];                     // SMTP password
    
    $mail->Port = 587;                                    	   // TCP port to connect to
    
    $mail->setFrom($email, 'Finer');
    $mail->addAddress($_POST['para'], $nome);
    $mail->isHTML(true);                                  
    
    $mail->Subject = $assunto;
    $mail->Body    = $conteudo;

    // $mail->send();
  	if(!$mail->send()) {
      	echo json_encode(array(
  			'mensagem' => 'Ocorreu problemas ao enviar mensagem.',
  			'codigo'   => 'erro'
  		));
      	return false;
  	} else {
      	echo json_encode(array(
  			'mensagem' => 'Mensagem enviada com sucesso',
  			'codigo'   => 'sucesso'
  		));
      	return false;
  	}
}
?>