<div class="container">
	<h3><?php echo $params[0]?></h3>
	<form class="form-horizontal" action="<?php echo DEV.'?control=connexion&action=valider'; ?>" method="post">
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
			<label class="control-label"></label>
			<div class="controls">
				<button type="submit" class="btn btn-success" name="valider">Valider</button>
			</div>
		</div>
	</form>
	
	<?php
		if (!empty($params[1])) {
			echo '<div class="span5"><div class="alert alert-error">Attention ! ';
			echo $params[1];
			$params[1]=NULL;
			echo '</div></div>';
		}
		
	?>
</div>
