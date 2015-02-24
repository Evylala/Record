<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
		
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="./View/css/bootstrap/js/bootstrap.min.js"></script>
		<!--<script type="text/javascript" src="http://code.jquery.com/jquery.tablesorter.js"></script> -->
		<script type="text/javascript" src="./View/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="./View/js/tod3.js"></script>
		
		
		<link media="screen" href="View/css/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link media="screen" href="View/css/tod3.css" type="text/css" rel="stylesheet" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Tales of Diablo 3</title>
    </head>
    <body>
	<!------------ BARRE DE NAVIGATION ------------>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="navbar-inner">
			<div class="container-fluid">
			<a class="brand" href="<?php echo DEV; ?>"><img src="<?php echo imgD3 ?>"></a>
			<ul class="nav">
				<li class="divider-vertical"><a href="<?php echo DEV; ?>">Accueil</a></li>
				<li><a href="<?php echo DEV.'?control=joueur&action=home'; ?>" >Joueurs</a></li>
				<li><a href="<?php echo DEV.'?control=groupe&action=home'; ?>">Groupes</a></li>
				<li>
					<ul class="nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Défis
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo DEV.'?control=defi&action=home#solo'; ?>" >Défis en solo</a></li>
								<li><a href="<?php echo DEV.'?control=defi&action=home#multi'; ?>">Défis multi</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li>
					<ul class="nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Parties
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo DEV.'?control=partieSolo&action=home'; ?>" >Parties solo</a></li>
								<li><a href="<?php echo DEV.'?control=partieMulti&action=home'; ?>">Parties multi</a></li>
							</ul>
						</li>
					</ul>
				</li>
<?php
	if(!isset($_SESSION['login'])){
		echo '
			</ul>
			<form class="navbar-form pull-right form-inline" action="index.php?control=inscription&action=home" method="post">
				<button type="submit" class="btn btn-inverse" name="valider">Inscription</button>
			</form>
			<form class="navbar-form pull-right form-inline" action="index.php?control=connexion&action=home" method="post">
				<button type="submit" class="btn btn-primary" name="valider">Connexion</button>
			</form>';
	}
	else {
		echo '
							
			</ul>
			<form class="navbar-form pull-right" action="index.php?control=deconnexion&action=home" method="post">
				<button type="submit" class="btn btn-primary" name="valider">Déconnexion ['.$_SESSION['login'].']</button>
			</form>';
	}
?>
			</div>
		</div>
	</div>
