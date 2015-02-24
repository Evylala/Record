<div class="container">
<h3>
	<?php echo $params[0]; ?>
</h3>
  
	<?php echo "Etes-vous sûr de vouloir supprimer cette partie ?" ?>
	<form method="POST" action="index.php?control=partieSolo&action=validerSuppr">
		<button class="btn btn-success" type="submit" name="idpartie" id="idpartie" value="<?php echo $params[1] ?>">Oui</button>
	</form>
	<a class="btn btn-danger" href="index.php?control=partieSolo&action=home">Non</a>

</div>