<div class="container">
	<h3><?php echo $params[0] ?></h3>
	<form class="form-horizontal" action="<?php echo DEV.'?control=partieMulti&action=validerAjout&idgroupe='.$_GET["idgroupe"]; ?>" method="post">
		<div class="control-group">
			<label class="control-label">Défi</label>
			<div class="controls">
				<select id="defi" name="defi" size ="1" />
				<?php
				foreach ($params[1] as $d) {
					echo '
					<option value="'.$d['iddefi'].'">'.$d['designation'].'</option>';
				}
				?>
				</select>
			</div>
		</div>
	
	
		<div class="control-group">
			<label class="control-label">Temps de jeu</label>
			<div class="controls">
				
				<input type="text" class="input-small" id="temps" name="temps" placeholder="En minutes" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Acquisition</label>
			<div class="controls">
				
				<input type="text" id="acquis" name="acquis" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Récit</label>
			<div class="controls">
				<textarea id="recit" name="recit" rows="10" placeholder="Raconter le déroulement de la partie"></textarea>
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
