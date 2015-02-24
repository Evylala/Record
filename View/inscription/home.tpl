<div class="container">
	<h3>Création de votre compte</h3>
	<form class="form-horizontal" action="<?php echo DEV.'?control=inscription&action=valider'; ?>" method="post">
		<div class="control-group">
			<label class="control-label">Login</label>
			<div class="controls">
				<input type="text" class="input-small" id="login" name="login" placeholder="Votre login">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Mot de passe</label>
			<div class="controls">
				<input type="password" class="input-small" id="pass" name="pass">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">E-mail</label>
			<div class="controls">
				<input type="text" class="input-small" id="mail" name="mail" placeholder="Mail valide">
			</div>
		</div>
		
				
		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<button type="submit" class="btn btn-success" name="valider">Valider</button>
			</div>
		</div>
		
		<?php
		if (!empty($params[0])) {
			echo '<div class="span5"><div class="alert alert-error">Attention ! ';
			echo $params[0];
			$params[0]=NULL;
			echo '</div></div>';
		}
		?>
	</form>
</div>

