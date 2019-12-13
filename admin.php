<?php
	session_start();
?>

<html>
    <head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css" />
        <link rel="icon" type="jpg" href="Lowranceonglet.jpg" />
        <title>Station Meteo</title>
        <?php 
            include 'fonction.php'; 
            Menu()
        ?>
    </head>

    <body>
        <?php
            $login = $_SESSION['login'];
            $mdp = $_SESSION['mdp'];

            Modification_user($login,$mdp);
        ?>
    </body>
</html>