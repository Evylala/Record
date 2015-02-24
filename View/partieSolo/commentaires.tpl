<div class="container-fluid">

    <div class="row-fluid">
		<div class="span4">
			<div class="well well-small">
			<h4>Info partie</h4>
				<table class="table table-bordered table-striped">
					<tr>
						<th>Désignation</th>
							<td><?php echo $params[1][0]['designation'] ?></td>
					</tr>	
					<tr>
						<th>Joueur</th>
							<td><?php echo $params[1][0]['pseudo'] ?></td>
					</tr>
					<tr>
						<th>Temps de jeu</th>
							<td><?php echo $params[1][0]['tempsjeuminute'] ?></td>
					</tr>
					<tr>
						<th>Acquisition</th>
							<td><?php echo $params[1][0]['acquisition'] ?></td>
					</tr>
					<tr>
						<th>Récit</th>
							<td><?php echo $params[1][0]['recit'] ?></td>
					</tr>
				</table>
			</div>
			<div class="span4">
				<a class="btn" href="index.php?control=partieSolo&action=home">Retour</a>
			</div>
		</div>
		
		<div class="span8">
			<h4>
				<?php echo $params[0]; ?>                 
			</h4>
			<div class="span10">
			<?php
			if (connecte()) {
			?>
			<form class="navbar-form form-inline" action="index.php?control=partieSolo&action=validAjoutCom" method="post">
				<textarea class="span12" type="text" rows="5" id="com" name="com" placeholder="Commentez"></textarea>
				<button class="btn btn-primary" id="idpartie" name="idpartie" value="<?php echo $params[2] ?>" type="submit">Ajouter</button>
			</form>
			</div>
			<div class="span10">
			<?php } 
			
			if (!empty($params[4])) {
			echo '<div class="span5"><div class="alert alert-error">Attention ! ';
			echo $params[4];
			$params[4]=NULL;
			echo '</div></div>';
			}	?>
			</div>
			<div class="span10">
			<?php
			if (!empty($params[3])) {
				foreach ($params[3] as $c):
					echo '<blockquote>
					<p>'.$c['texte'].'</p>
					<small>Posté par '.$c['pseudo'].' le '.$c['dateonly'].' à '.$c['heureonly'].'</small>';
					
					if (connecte() && (estAdmin() || estProprietaire($c['idjoueur']))) {
					
					echo '<div class="controls><form class="navbar-form form-inline" action="index.php?control=partieSolo&action=modifierCommentaire"  method="POST">
						<button style="display:none;" class="btn btn-mini" type="submit" id="idcomm" name="idcomm" value="'.$c['idcommi'].'"><i class="icon-pencil"></i></button>
					</form>
					<form class="navbar-form form-inline" action="index.php?control=partieSolo&action=supprimerComm"method="POST">
						<button class="btn btn-mini" type="submit" id="idcomm" name="idcomm" value="'.$c['idcommi'].'"><i class="icon-remove"></i></button>
					</form></div>';
					}
					echo '</blockquote>';
					
				endforeach;
			} ?>
			</div>
		</div>
	</div>
		
 </div>
