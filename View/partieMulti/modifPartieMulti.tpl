
<div class="container">
	<h3>
		<?php echo $params[0] ?>
	</h3>
	<form class="form-horizontal" action="<?php echo DEV.'?control=partieMulti&action=validerModif'; ?>" method="post">
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
				<input type="text" class="input-small" id="tpsjeu" name="tpsjeu" value="<?php echo $params[2][0]['tempsjeuminute'] ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Acquisition</label>
			<div class="controls">
				<textarea id="acquis" name="acquis" rows="5" ><?php echo $params[2][0]['acquisition'] ?></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Récit</label>
			<div class="controls">
				<textarea id="recit" name="recit" rows="10" ><?php echo $params[2][0]['recit'] ?></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<button type="submit" id="idpartie" name="idpartie" class="btn btn-success" value="<?php echo $params[4] ?>">Valider</button>
			</div>
		</div>
	</form>
	<?php
		if (!empty($params[3])) {
			echo '<div class="span5"><div class="alert alert-error">Attention ! ';
			echo $params[3];
			$params[3]=NULL;
			echo '</div></div>';
		}
		
	?>
</div>

