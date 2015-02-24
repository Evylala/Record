<div class="container">
<h1>
	<?php echo $params[0];?> 
</h1>

<table class="table table-bordered table-striped sortable">
	<thead>
		<th>Désignation<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></i></th>
		<th class="cent">Groupe<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th class="ccq">Temps (min)<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th class="ccq">Acquisition<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th>Récit</th>
		<?php if (connecte()) {
	echo'<th class="action">Actions</th>';
	} ?>
	</thead>
	
	<?php
		foreach ($params[1] as $p) {
		$listID=array($p['idjoueur1'],$p['idjoueur2'],$p['idjoueur3'],$p['idjoueur4']);
			echo 
			'<tr>
				<td>'.$p["designation"].'</td><td>'.$p["nom"].'</td>
				<td class="center">'.$p["tempsjeuminute"].'</td><td>'.$p["acquisition"].'</td>
				<td>'.$p["recit"].'</td>';
			if (connecte()) {
				echo'<td>';
				if (in_array($_SESSION['id'],$listID) || estAdmin()) { 
					echo '<form class="navbar-form form-inline form1" action="index.php?control=partieMulti&action=modifPartieMulti" method="POST">
						<button class="btn btn-mini" type="submit" id="idpartie" name="idpartie" value="'.$p['idpartieg'].'" title="Modifier"><i class="icon-pencil"></i></button>
					</form>
					<form class="navbar-form form-inline form2" action="index.php?control=partieMulti&action=supprimerPartieMulti" style="display:none;"  method="POST">
						<button class="btn btn-mini" type="submit" id="idpartie" name="idpartie" value="'.$p['idpartieg'].'" title="Supprimer"><i class="icon-remove"></i></button>
					</form>
					<div class="clear"></div>';
				}
				echo '</td>';
			}
			echo'</tr>';
		}
		
		if (connecte()) {
			?>
			<form class="navbar-form form-inline" action="index.php?control=groupe&action=home&ajout=true" method="post">
			<button class="btn btn-primary" type="submit">Ajouter</button>
			</form>
			<?php 
		} 
		?>
</table>
</div>

