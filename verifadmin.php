<?php
	session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="jpg" href="Lowranceonglet.jpg" />
        <?php include "fonction.php"; ?>
    <head>
    <body>
        <?php
            $login = $_SESSION['login'];
            $mdp = $_SESSION['mdp'];

            Autorisation_admin($login,$mdp);
        ?>
    <body>
</html>