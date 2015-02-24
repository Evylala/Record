<div class="container">
	<h1><?php echo $params[0];?> </h1>
	<div class="sized">
		<table class="table table-bordered table-striped sized sortable">
			<thead><th>Pseudo<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
			<th>Mail<button class="btn-btn-mini"><i class=" icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
			<th>Parties solo<button class="btn-btn-mini"><i class=" icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
			<?php
			if (estSuperAdmin()) {
				echo '<th>Modifier droit</th>';
			}
			echo '</thead>';
			
				foreach($params[1] as $j) :
				echo '
				<tr>
					<td>'.$j['pseudo'].'</td><td><a href="mailto:#">'.$j['mail'].'</a></td><td class="center">'.$j['nbparties'].'</td>';
					if (estSuperAdmin()) { ?>
						<td>
							<?php if ($j['idjoueur'] != $_SESSION['id']) { ?>
								<form method="POST" action="index.php?control=joueur&action=modifierDroit">
									<button class="btn btn-mini" id="idjoueur" name="idjoueur" value="<?php echo $j['idjoueur'] ?>"><i class="icon-pencil"></i></button>
								</form>
							<?php } ?>
						</td>
					<?php
					}
				echo '</tr>';
				endforeach; 
				?>
		</table>
	</div>
</div>


