<div class="container">
<h3>
	<?php echo $params[0]; ?>
</h3>
  
	<?php echo "Etes-vous sûr de vouloir supprimer ce commentaire ?" ?>
	<form method="POST" action="index.php?control=partieSolo&action=validerSupprComm">
		<button class="btn btn-success" type="submit" name="idcomm" id="idcomm" value="<?php echo $params[1] ?>">Oui</button>
	</form>
	<form method="POST" action="index.php?control=partieSolo&action=commentaires">
		<button class="btn" type="submit" name="idpartie" id="idpartie" value="<?php echo $params[2] ?>">Annuler</button>
	</form>
</div>