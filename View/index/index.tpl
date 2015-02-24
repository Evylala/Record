<div class="hero-unit">
	<div class="span6">
		<h1>Tales of Diablo 3</h1>
		<h2>Soyons fous</h2>
		<p>Proposez des défis !</p>
		<p>Racontez le déroulement de vos parties !</p>
		<p>Vantez vos loots !</p>
	</div>
	<a href="http://eu.battle.net/d3/fr/"><img  src="<?php echo imgTyrael ?>"></a>	
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span3">
			<h3>Classement</h3>
			<div class="well well-small">
				<h5>Top 10 des joueurs les plus actifs</h5>
				<table class="table table-bordered table-striped">
					<thead><th></th><th>Pseudo</th><th class="center">Nombre de parties</th></thead>
			<?php
				for ($i = 1 ; $i < 11 ; $i++) {
					echo '
						<tr>
							<td>'.$i.'</td><td>'.$params[0][$i-1]['pseudo'].'</td><td class="center">'.$params[0][$i-1]['nbparties'].'</td>
						</tr>';
				}
						
				$i=1;
			?>
				</table>
			</div>
		</div>
		<div class="span1"></div>
		<div class="span6">
			<img class="img-polaroid" src="<?php echo FOND ?>">
		</div>
	</div>
</div>
