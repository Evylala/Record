<div class="container">

<h3>
	<?php echo $params[0].$params[2];?> 
</h3>

<form class="form-horizontal" action="<?php echo DEV.'?control=joueur&action=validerModifDroit'; ?>" method="post">
	<div class="control-group">
		<label class="control-label">Passer
		<?php switch ($params[3]) {
			case 0: 
				echo "de Membre à";
				break;
			case 1: 
				echo "de Modérateur à";
				break;
			case 2: 
				echo "d'Administrateur à";
				break;
		} ?>
		</label>
		<div class="controls">
			<select id="droit" name="droit" size ="1" />
				<?php switch ($params[3]) {
					case 0:	
						echo '<option value="1">Modérateur</option>
						<option value="2">Administrateur</option>';
						break;
					case 1:
						echo '<option value="0">Membre</option>
						<option value="2">Administrateur</option>';
						break;
					case 2:
						echo '<option value="0">Membre</option>
						<option value="1">Modérateur</option>';
						break;
					}
				?>
			</select>
		</div>
	</div>	
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<button type="submit" id="idjoueur" name="idjoueur" class="btn btn-success" value="<?php echo $params[1] ?>">Changer</button>
			<a class="btn" href="index.php?control=joueur&action=home">Annuler</a>
		</div>
	</div>
</form>

</div>