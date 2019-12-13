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
        <div class="cadre">
            <div class="titre">
                <p>Station Météo</p>
            </div>
            <hr>
            <div class="sousTitre">
                <p>Température en temps réel :</p>  
            </div>   
            <div class="temperature">
                <p>15</p>
            </div>
        </div>
    </body>
</html>