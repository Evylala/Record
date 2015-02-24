<div class="container">
	<h3><?php echo $params[0];?></h3>
	
	<p>Constituez un groupe de jeu avec d'autres joueurs, pour des parties multi endiablées !</p>
	<form class="form-horizontal" action="<?php echo DEV.'?control=groupe&action=validerAjout'; ?>" method="post">
	<div class="control-group">
		<label class="control-label">Nom du groupe</label>
		<div class="controls">	
			<textarea id="nom" name="nom" placeholder="Le nom du groupe" ></textarea>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">Nombre de partenaires</label>
		<div class="controls">	
			<input type="text" class="input-small" id="nbj" name="nbj" placeholder="Entre 1 et 3">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">Vos partenaires</label>
		<div class="controls">
			<select name="joueurs[]" multiple="3">
				<?php
					foreach ($params[1] as $joueur) {
						if ($joueur["idjoueur"]!=$_SESSION['id']){
							echo '<option values="'.$joueur["idjoueur"].'">'.$joueur["pseudo"].'</option>';
						}
					}	
				?>
			</select>
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
	if (!empty($params[2])) {
			echo '<div class="span5"><div class="alert alert-error">Attention ! ';
			echo $params[2];
			$params[2]=NULL;
			echo '</div></div>';
		}
	?>

</div>
