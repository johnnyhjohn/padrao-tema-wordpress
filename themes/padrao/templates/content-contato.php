<article id="contato">
	<div class="container">
		<h2 class="text-center">Contato</h2>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<form id="form">
					<?php $informacoes = getInformacao(); ?>
					<input type="hidden" name="host" 	value="<?php echo $informacoes['smtp_host'] ?>">
					<input type="hidden" name="username" value="<?php echo $informacoes['smtp_username'] ?>">
					<input type="hidden" name="senha" 	value="<?php echo $informacoes['smtp_senha'] ?>">
					<input type="hidden" name="para" 	value="<?php echo $informacoes['smtp_from1'] ?>">
					<input required="require" class="form-control" type="text" name="nome" placeholder="Nome">
					<input required="require" class="form-control" type="email" name="email" placeholder="Email">
					<input required="require" class="form-control" type="text" name="assunto" placeholder="Assunto">
					<textarea required="require" class="form-control" placeholder="mensagem" name="mensagem"></textarea>
					<input class="btn btn-enviar" type="submit" value="Enviar">
				</form>
			</div>
		</div>
	</div>
</article>