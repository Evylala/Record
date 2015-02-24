<div class="container">
<h3>
	<?php echo $params[0]; ?>
</h3>
  
	<?php echo "Etes-vous sûr de vouloir supprimer cette partie ?" ?>
	<form method="POST" action="index.php?control=partieSolo&action=validerSuppr">
		<div class="controls">
		<button class="btn btn-success" type="submit" name="idpartie" id="idpartie" value="<?php echo $params[1] ?>">Oui</button>
		<a class="btn" href="index.php?control=partieSolo&action=home">Annuler</a>
		</div>
	</form>
</div>