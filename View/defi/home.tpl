<div class="container">
	<h1><?php echo $params[0]; ?></h1>
	<div class="sized">
		<h3 id="solo">Défis en solo</h3>
		<button id="btn_show_solo" class="btn btn-mini btn-success">Afficher</button>
		<button id="btn_hide_solo" class="btn btn-mini btn-warning">Ne plus afficher</button>
		
		<div id="defi_solo">
				<table class="table table-bordered table-striped sortable">
					<thead>
						<tr>
							<th>Désignation<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
							<th class="cent">Niveau<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($params[1] as $d) :
							if (is_null($d['niveau'])){
								$lvl = "-";
							}
							else {
								$lvl = $d['niveau'];
							}
						echo '
						<tr>
							<td>'.$d['designation'].'</td><td class="center">'.$lvl.'</td>
						</tr>';
						endforeach;
						if (connecte()) {
						
							echo '<form class="navbar-form form-inline" action="index.php?control=defi&action=addDefi&nbj=1" method="post">
							<button class="btn btn-primary" type="submit" style="margin:5px 0;">Ajouter</button>
							</form>';
						}
						?>
						</tbody>
				</table>
				
		</div>
	
		<h3 id="multi">Défis en multi</h3>
		<button id="btn_show_multi" class="btn btn-mini btn-success">Afficher</button>
		<button id="btn_hide_multi" class="btn btn-mini btn-warning">Ne plus afficher</button>
		
		<div id="defi_multi">
			<table class="table table-bordered table-striped sortable">
				<thead>
					<th>Désignation<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
					<th class="ccq">Joueurs max<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
					<th class="cent">Niveau<button class="btn-btn-mini"><i class="icon-arrow-up"></i><i class=" icon-arrow-down"></i></button></th>
				</thead>
				<?php
					foreach($params[2] as $d) :
						if ($d['niveau']==NULL){
							$lvl="-";
						}
						else {
							$lvl = $d['niveau'];
						}
						echo '
							<tr>
								<td>'.$d['designation'].'</td><td class="center">'.$d['nbparticipantsmax'].'</td><td class="center">'.$lvl.'</td>
							</tr>';
					endforeach;
					if (connecte()) {
						
					echo '<form class="navbar-form form-inline" action="index.php?control=defi&action=addDefi" method="post">
						<button class="btn btn-primary" type="submit" style="margin:5px 0;">Ajouter</button>
						</form>';
					}
					?>
			</table>
		</div>
	</div>
</div>


