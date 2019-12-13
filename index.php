<html>
    <head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css" />
        <link rel="icon" type="jpg" href="Lowranceonglet.jpg" />
        <title>Station Meteo</title>
        <?php 
            include 'fonction.php'; 
        ?>
    </head>

    <body>
        <div class="connexion">
            <div class="titre">
                <p>Station Météo</p>
            </div>
            <div class="formulaire">
                <p>Formulaire de connexion :</p>
                <form method="POST" action="index.php">
                    <form method="POST" action="accueil.php">				
                        <input type="text" name="login" id="login" placeholder="login" required/>
                        <input type="password" name="mdp" id="mdp" placeholder="mot de passe" required/>
                        <p class="submit"><input type="submit" name="connexion" value="Connexion"></p>
                    </form>
			    </form>
            </div>
        </div>

        <?php
			if(isset($_POST['connexion']))
			{
				$login=$_POST['login'];
				$mdp=$_POST['mdp'];
				
				Autorisation($login,$mdp);
			}
		?>
    </body>
</html>