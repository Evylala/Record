<div class="container">
	<h1><?php echo $params[0];?></h1>
	
	<?php if ($_GET['ajout']=="true") {
				echo'<p id="list_group">Choisissez un groupe pour accéder au formulaire de création d\'une partie en multi ou créez un groupe.</p>';
	}
	?>
	<div class="sized">
		<table class="table table-bordered table-striped sortable" >
			<thead>
				<?php 	if (estAdmin()) { 
							echo '<th class="cent">id Groupe</th>';
						}
				?>
				<th class="dsgn">Groupe<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
				<th class="ccq">Joueurs<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
				<th class="ccq">Parties jouées<button class="btn-btn-min"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i></button></th>
				<?php if ($_GET['ajout']=="true") {
					echo'<td class="">Ajouter à une partie multi</td>';
				}?>
				
			</thead>
			<?php
				foreach($params[1] as $idg => $g) {
					echo '<tr>';
					if (estAdmin()) { 
						echo '<td class="center">'.$idg.'</td>';
					}

					echo '<td>'.$g[0].'</td>';
					echo 
						'<td>
							<ul>
								<li>'.$g[1].'</li>
								<li>'.$g[2].'</li>
								<li>'.$g[3].'</li>
								<li>'.$g[4].'</li>
							</ul>
						</td><td class="center">'.$g[5].'</td>';
					if ($_GET['ajout']=="true"){
						if(in_array($_SESSION['id'],$g[6])) {
							echo '<td><a href="index.php?control=partieMulti&action=addPartieMulti&idgroupe='.$idg.'"<i class="icon-ok"></i></td>';
						}
						else {
							echo '<td></td>';
						}
					}
				}
				if (connecte()) {
					?>
					<form class="navbar-form form-inline" action="index.php?control=groupe&action=addGroupe" method="post">
					<button class="btn btn-primary" type="submit">Créer un groupe</button>
					</form>
					<?php 
				} 
				echo '</tr>' ;
				?>
		</table>
	</div>
</div>
