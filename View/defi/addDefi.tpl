<div class="container">
	<h3><?php echo $params[0] ?></h3>
	<form class="form-horizontal" action="<?php echo DEV.'?control=defi&action=valider&nbj='.$_GET['nbj']; ?>" method="post">
		<div class="control-group">
			<label class="control-label">Désignation</label>
			<div class="controls">
				<textarea id="dsgn" name="dsgn" placeholder="Intitulé du défi" ></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Niveau</label>
			<div class="controls">
				<input type="text" class="input-small" id="lvl" name="lvl" placeholder="Niv.max à 9" >
			</div>
		</div>
		
		
<?php 
	if ($_GET['nbj']!=1) {
		echo '
		<div class="control-group">
			<label class="control-label">Nombre joueurs max</label>
			<div class="controls">
				<input type="text" class="input-small" id="nbj" name="nbj" placeholder="Entre 2 et 4">
			</div>
		</div>';
	}
?>
			
		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<button type="submit" class="btn btn-success" name="valider">Valider</button>
			</div>
		</div>
	</form>
<?php
	if (!empty($params[1])) {
		echo $params[1];
		$params[1]=NULL;
	}
?>
</div>
