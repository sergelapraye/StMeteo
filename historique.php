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
        <div class="alignement">
            <div class="historique">
                <div class="titre">
                    <p>Historique des températures :</p>
                </div>
                <hr>
                <div class="tableau">
                    <?php
                        Affichage_Temperature()
                    ?>   
                </div>         
            </div>
            <div class="recherche">
                <div class="titre">
                    <p>Filtrage des températures :</p>
                </div> 
                <hr>
                <div class="formulaire">
                     <?php
                        Recherche()
                    ?>  
                </div>  
            </div>
        </div>
    </body>
</html>