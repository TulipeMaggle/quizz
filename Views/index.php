<?php
// le mdp c'est janna ou admin

require '../Database/pdo.php';
if (isset($_GET['methode']) && $_GET['methode'] == 'inscription') {

	$pseudo = htmlentities($_POST['pseudo']);

	$email = htmlentities($_POST['email']);

	$mdp2 = htmlentities($_POST['mdp']);
	$mdp = password_hash($mdp2, PASSWORD_DEFAULT);


	$query = $pdo->prepare("INSERT INTO `quizz`.`users` (`pseudo`, `email`, `password`, `admin`)
VALUES (:pseudo, :email, :mdp, false);");
	$query->bindValue(":email", $email);
	$query->bindValue(":mdp", $mdp);
	$query->bindValue(":pseudo", $pseudo);
	$querySelector = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$querySelector->bindValue(":email", $email);
	$querySelector->execute();
	$user =
		$querySelector->fetch();
	if ($query->execute()) {
		setcookie('id', $user['id']);
		header('Location: quizz.php');
	}
} else if (
	isset($_GET['methode']) &&
	$_GET['methode'] == 'connexion'
) {
	$email = htmlentities($_POST['email']) ?? "";
	$mdp = htmlentities($_POST['mdp']) ?? "";
	$query = $pdo->prepare("SELECT * FROM
users WHERE email = :email");
	$query->bindValue(":email", $email);
	$query->execute();
	$user = $query->fetch();
	if ($user == false) {
		$ERROR = "
<strong>Erreur dans le mot de passe ou l'email</strong>
";
	} else {
		$hash = $user['password'];
		if (password_verify($mdp, $hash)) {
			setcookie('id', $user['id']);
			header('Location: quizz.php');
		} else {
			$ERROR = "
<strong>Erreur dans le mot de passe ou l'email</strong>
";
		}
	}
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Quizz - Via Formation</title>
	<link rel="stylesheet" href="../CSS/style.css" />
	<link rel="stylesheet" href="../CSS/index.css" />
</head>

<body>
	<header>
		<img class="logo" src="../logo/logo.png" alt="logo" />
		<h1>Bienvenue sur notre Quizz</h1>
	</header>

	<div class="box">
		<h2>Veuillez vous identifier</h2>
		<div class="sign">
			<button onclick="Formulaire(1)" class="btn" id="signIN">
				Se connecter
			</button>

			<button onclick="Formulaire(2)" class="btn" id="signUP">
				Créer un compte
			</button>
		</div>
		<div id="displayons" class="dispositif bb">
			<h3>Connexion</h3>
			<div class="form">
				<form action="?methode=connexion" method="POST" id="formConn">
					<div class="case">
						<label for="Cemail">Votre email :</label>
						<input class="champs" type="email" name="email" id="Cemail" />
					</div>
					<div class="case">
						<label for="Cmdp">Votre mot de passe :</label>
						<input class="champs" type="password" name="mdp" id="Cmdp" />
						<p class="attention"></p>
					</div>
					<p class="attention"><?= $ERROR ?? '' ?></p>
					<div class="case">
						<button type="submit" form="formConn" value="Submit">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
		<div id="displayis" class="dispositif bb">
			<h3>Inscription</h3>
			<div class="form">
				<form action="?methode=inscription" method="POST" id="formInsc">
					<div class="case">
						<label for="pseudo">Votre pseudo :</label>
						<input class="champs" type="text" name="pseudo" id="pseudo" />
						<p class="attention"></p>
					</div>
					<div class="case">
						<label for="Iemail">Votre email :</label>
						<input class="champs" type="email" name="email" id="Iemail" />
						<p class="attention"></p>
					</div>
					<div class="case">
						<label for="Imdp">Votre mot de passe :</label>
						<input class="champs" type="password" name="mdp" id="Imdp" />
						<p class="attention"></p>
					</div>
					<div class="case">
						<button type="submit" form="formInsc" value="Submit">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../js/index.js"></script>
</body>

</html>