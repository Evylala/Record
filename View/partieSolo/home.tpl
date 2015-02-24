<div class="container">

	<h1><?php echo $params[0];?></h1>

<table class="table table-bordered table-striped sortable" >
	<thead>
		<th>Désignation<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th class="cent">Joueur<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th class="ccq">Temps (min)<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th class="ccq">Acquisition<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
		<th>Récit</th>
	<?php if (connecte()) {
	echo'<th class="action">Actions</th>';
	} ?>
	<th class="ccq">Commentaires<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
	</thead>
	<?php
		$i=0;
		foreach($params[1] as $p) :
		echo '
		<tr>
			<td>'.$p['designation'].'</td><td>'.$p['pseudo'].'</td><td class="center">'.$p['tempsjeuminute'].'</td><td>'.$p['acquisition'].'</td><td>'.$p['recit'].'</td>';
			if (connecte()) {
				echo '<td>';
				if ($p['idjoueur'] == $_SESSION['id'] || estAdmin()) { ?>
					<form class="navbar-form form-inline form1" action="index.php?control=partieSolo&action=modifPartieSolo" method="POST">
						<button class="btn btn-mini" type="submit" id="idpartie" name="idpartie" title="Modifier" value="<?php echo $p['idpartiei'] ?>"><i class="icon-pencil"></i></button>
					</form>
					<form class="navbar-form form-inline form2" action="index.php?control=partieSolo&action=supprimerPartieSolo" method="POST">
						<button class="btn btn-mini" type="submit" id="idpartie" name="idpartie" value="<?php echo $p['idpartiei'] ?>" title="Supprimer"><i class="icon-remove"></i></button>
					</form>
					<div class="clear"></div>
					<?php 
				}
				?></td>
				<?php
			}
			?> 
			<td><form class="navbar-form form-inline" action="index.php?control=partieSolo&action=commentaires" method="POST">
					<button class="btn btn-link" type="submit" id="idpartie" name="idpartie" value="<?php echo $p['idpartiei'] ?>">Lire</button>(<?php echo $params[2][$i] ?>)
				</form>
			</td> 
		<?php
		$i++;
		endforeach;
		if (connecte()) {
			?>
			<form class="navbar-form form-inline" action="index.php?control=partieSolo&action=addPartieSolo" method="post">
			<button class="btn btn-primary" type="submit">Ajouter</button>
			</form>
			<?php 
		} 
		echo '</tr>' ;
		?>
</table>
</div>
