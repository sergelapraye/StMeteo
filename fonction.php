<?php
    function Menu()
    {
?>
        <div class="topnav">
            <a href="temperature.php">Température en temps réel</a>
            <a href="historique.php">Historique des températures</a>
            <a href="verifadmin.php">Espace administrateur</a>
            <a href="parametre.php">Paramètres</a>
        </div>
<?php
    }
?>

<?php
    function Affichage_Temperature()
    {
        try
        {
            $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        $affiche = $db->query("SELECT * FROM temperature");

        echo '<table id="customers">';
        echo '<tr>';
        echo '<th><center>ID</center></th>';
        echo '<th><center>Température</center></th>';
        echo '<th><center>Date de réception</center></th>';
        echo '</tr>';
        while ($donnee = $affiche->fetch())
        {
            echo '<tr>';
            echo "<td> ".$donnee['id']."</td> ";
            echo "<td> ".$donnee['valeur']."</td> ";
            echo "<td> ".$donnee['date']."</td> ";
            echo '</tr>';
        }
        echo '</table>'; 
    }  
?>

<?php
    function Recherche()
    {
        try
        {
            $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        echo '<form method="POST" action="historique.php">';
        echo '<input type="text" name="annee1" id="annee1" placeholder="Année (0001 à ∞)">';
        echo '<p class="submit"><input name=rechercherAnnee type="submit" value="Filtrer par année"></p>';
        echo '</form>';

        echo '<form method="POST" action="historique.php">';
        echo '<select name="mois2" id="mois2" size="1">';
        echo '<option>Jan</option>';
        echo '<option>Feb</option>';
        echo '<option>Mar</option>';
        echo '<option>Apr</option>';
        echo '<option>May</option>';
        echo '<option>Jun</option>';
        echo '<option>Jul</option>';
        echo '<option>Aug</option>';
        echo '<option>Sep</option>';
        echo '<option>Oct</option>';
        echo '<option>Nov</option>';
        echo '<option>Dec</option>';
        echo '</select>';
        echo '<p class="submit"><input name=rechercherMois type="submit" value="Filtrer par mois"></p>';
        echo '</form>';

        if(isset($_POST['rechercherAnnee']))
        {
            $annee1=$_POST['annee1'];

            $affiche = $db->query("SELECT * FROM temperature WHERE date LIKE '%$annee1'");
        

            echo '<hr>';
            echo "<p>Tableau des températures reçues entre pour l'année ".$annee1."</p>";
            echo '<div class="tableau">';
            echo '<table id="customers">';
            echo '<tr>';
            echo '<th><center>ID</center></th>';
            echo '<th><center>Température</center></th>';
            echo '<th><center>Date de réception</center></th>';
            echo '</tr>';
            while ($filtrage = $affiche->fetch())
            {
                echo '<tr>';
                echo "<td> ".$filtrage['id']."</td> ";
                echo "<td> ".$filtrage['valeur']."</td> ";
                echo "<td> ".$filtrage['date']."</td> ";
                echo '</tr>';
            }
            echo '</table>'; 
            echo '</div>';
        }

        if(isset($_POST['rechercherMois']))
        {
            $mois2=$_POST['mois2'];

            $affiche = $db->query("SELECT * FROM temperature WHERE date LIKE '%$mois2%'");
        
            echo '<hr>';
            echo "<p>Tableau des températures reçues pour le mois de ".$mois2."</p>";
            echo '<div class="tableau">';
            echo '<table id="customers">';
            echo '<tr>';
            echo '<th><center>ID</center></th>';
            echo '<th><center>Température</center></th>';
            echo '<th><center>Date de réception</center></th>';
            echo '</tr>';
            while ($filtrage = $affiche->fetch())
            {
                echo '<tr>';
                echo "<td> ".$filtrage['id']."</td> ";
                echo "<td> ".$filtrage['valeur']."</td> ";
                echo "<td> ".$filtrage['date']."</td> ";
                echo '</tr>';
            }
            echo '</table>'; 
            echo '</div>';
        }
    }
?>

<?php 
    function Autorisation($login,$mdp) //Méthode qui vérifie si l'utilisateur peut se connecter
    {
        try
        {
            $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
            
        if (isset($login) AND isset($mdp))
        {
    
            $verif = $db->prepare('SELECT COUNT(*) FROM utilisateur WHERE mdp = :password AND login = :pseudo'); // Je compte le nombre d'entrée ayant pour mot de passe et login ceux rentrés
            $verif->bindValue(':password', $mdp, PDO::PARAM_STR);
            $verif->bindValue(':pseudo', $login, PDO::PARAM_STR);
            $verif->execute();
            $donnees = $verif->fetchColumn();
            $verif->closeCursor();
                
            if($donnees == 1) // On a trouvé un membre avec ce couple mdp, login 
            { 
                session_start();
                $_SESSION['login'] = $login;
                $_SESSION['mdp'] = $mdp;
                header('Location:temperature.php');        
            }
            else 
            { // Personne n'existe dans la table avec ce couple mdp, login
                echo "<script type='text/javascript'>";
                echo "alert('Login ou mot de passe invalide, Veuillez ressayer.')";  
                echo "</script>";  
            }
        }
    } 
?>

<?php 
    function Modification_user($login,$mdp) //Méthode permettant de modifier le login utilisateur
    {
        try
        {
            $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        $affiche = $db->query("SELECT * FROM utilisateur");

        echo '<div class="cadreAdmin">';
        echo '<div class="titre">';
        echo '<p>Comptes existant</p>';
        echo '</div>';
        echo '<div class="tableau">';
        echo '<table id="customers">';
        echo '<tr>';
        echo '<th><center>Login</center></th>';
        echo '<th><center>Mot de passe</center></th>';
        echo '<th><center>Catégorie</center></th>';
        echo '</tr>';
        while ($donnee = $affiche->fetch())
        {
            echo '<tr>';
            echo "<td> ".$donnee['login']."</td> ";
            echo "<td> ".$donnee['mdp']."</td> ";
            if ($donnee['admin'] == 1)
            {
                echo "<td>Administrateur</td>";
            }
            else
            {
                echo "<td>Utilisateur</td>";        
            }
            echo '</tr>';
        }
        echo '</table>';
        
        echo '</div>';
        echo '<div class="marge"></div>';
        echo '<div class="formulaire">';
        echo "<p>Sélectionner un utilisateur</p>";
        echo '<form method="POST" action="admin.php">';
        echo '<input type="text" name="selectlogin" id="selectlogin" placeholder="login" required>';    
        echo '</div>';
        echo "<center><p>*Pour modifier ou supprimer un utilisateur vous devez saisir préalablement un login utilisateur*</p></center>";
        echo '<div class="marge"></div>';
        echo '</div>';

        echo '<div class="alignementAdmin">';
        echo '<div class="historique">';
        echo '<div class="marge"></div>';
        echo '<div class="formulaire">';
        echo "<p>Modification d'un utilisateur</p>";
        echo '<input type="text" name="modiflogin" id="modiflogin" placeholder="nouveau login">';
        echo '<input type="password" name="modifmdp" id="modifmdp" placeholder="nouveau mot de passe">';
        echo '<p class="submit"><input name=modifier type="submit" value="Modifier"></p>';
        echo '<div class="marge"></div>';
        echo '<hr>';
        echo '<div class="marge"></div>';
        echo "<p>Suppression d'un utilisateur</p>";
        echo '<p class="submit"><input name=supprimer type="submit" value="Supprimer"></p>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '<div class="recherche">';
        echo '<div class="formulaire">';
        echo '<div class="marge"></div>';
        echo "<p>Ajouter un nouveau compte utilisateur</p>";
        echo '<form method="POST" action="admin.php">';
        echo '<input type="text" name="nouveaulogin" id="nouveaulogin" placeholder="login" required>';
        echo '<input type="password" name="nouveaumdp" id="nouveaumdp" placeholder="mot de passe"required>';
        echo '<div class="marge1"></div>';
        echo '<p>Sélectionner une catégorie de compte<p>';      
        echo '<div><input type="radio" id="admin" value="1" name="radio" checked><label for="admin">Compte administrateur</label></div>';
        echo '<div><input type="radio" id="user" value="0" name="radio"><label for="user">Compte utilisateur</label></div>';      
        echo '<p class="submit"><input name=ajouter type="submit" value="Ajouter"></p>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        if(isset($_POST['modifier']))
        {
            $selectlogin=$_POST['selectlogin'];
            $modiflogin=$_POST['modiflogin'];
            $modifmdp=$_POST['modifmdp'];
        
            $modif = $db->query("UPDATE utilisateur SET login='$modiflogin', mdp='$modifmdp' WHERE login='$selectlogin'");       
        }
        
        if(isset($_POST['supprimer']))
        {
            $supp = $db->query("DELETE from utilisateur WHERE login='$login'");
        }

        if (isset($_POST['ajouter']))
        {
            $nouveaulogin = $_POST['nouveaulogin'];
            $nouveaumdp = $_POST['nouveaumdp'];
            $radio= $_POST['radio'] ;
    
            if ($radio == 1)
            {
                $ajout = $db->query("INSERT INTO utilisateur (login,mdp,admin) VALUES ('$nouveaulogin', '$nouveaumdp', 1)");      
            }
            else
            {
                $ajout = $db->query("INSERT INTO utilisateur (login,mdp,admin) VALUES ('$nouveaulogin', '$nouveaumdp', 0)");    
            } 
        }  
    }
?>

<?php 
    function Autorisation_admin($login,$mdp)
        {
            try
            {
                $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
                $verif = $db->prepare('SELECT COUNT(*) FROM utilisateur WHERE login = :pseudo AND admin = 1'); 
                $verif->bindValue(':pseudo', $login, PDO::PARAM_STR);
                $verif->execute();
                $donnees = $verif->fetchColumn();
                $verif->closeCursor();

            if($donnees == 1) 
            { 
                header('Location:admin.php');               
            }
            else
            {
?> 
                <script type="text/javascript" language="javascript">
                    alert("Vous n'avez pas les droits suffisants pour accéder à cette page");
                    window.location="http://192.168.64.136/StationMeteoV2/temperature.php";
                </script>
<?php           
            }
    }
?> 

<?php 
    function Parametre($login,$mdp)
    {
        try
        {
            $db = new PDO('mysql:host=192.168.65.118;dbname=stationMeteo;charset=utf8','root','root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
       
        echo '<div class="cadreAdmin">';
        echo '<div class="titre">';
        echo '<p>Paramètres</p>';
        echo '</div>';
        echo '<div class="formulaire">';
        echo "<p>Modification login</p>";
        echo '<form method="POST" action="parametre.php">';
        echo '<input type="text" name="ancienlogin" id="ancienlogin" placeholder="login actuel">';
        echo '<input type="text" name="nouveaulogin" id="nouveaulogin" placeholder="nouveau login">';
        echo '<p class="submit"><input name=modifierLogin type="submit" value="Modifier"></p>';
        echo '</form>';
        echo '</div>';
        echo '<div class="marge"></div>';
        echo '<hr>';
        echo '<div class="marge"></div>';
        echo '<div class="formulaire">';
        echo "<p>Modification mot de passe</p>";
        echo '<form method="POST" action="parametre.php">';
        echo '<input type="password" name="ancienmdp" id="ancienmdp" placeholder="mot de passe actuel">';
        echo '<input type="password" name="nouveaumdp" id="nouveaumdp" placeholder="nouveau mot de passe">';
        echo '<p class="submit"><input name=modifierMdp type="submit" value="Modifier"></p>';
        echo '</form>';
        echo '</div>';
        echo '<div class="marge"></div>';
        echo '<hr>';
        echo '<div class="marge"></div>';

        if(isset($_POST['modifierLogin']))
        {
            $ancienlogin=$_POST['ancienlogin'];
            $nouveaulogin=$_POST['nouveaulogin'];
        
            $modif = $db->query("UPDATE utilisateur SET login='$nouveaulogin' WHERE login='$ancienlogin'");       
        }

        if(isset($_POST['modifierMdp']))
        {
            $ancienmdp=$_POST['ancienmdp'];
            $nouveaumdp=$_POST['nouveaumdp'];
        
            $modif = $db->query("UPDATE utilisateur SET mdp='$nouveaumdp' WHERE mdp='$ancienmdp'");       
        }

?> 
        <script type="text/javascript" language="javascript">
            function deconnexion()
            {
                if (confirm("Vous desirez vraiment vous deconnecter ?"))
                {
                    window.location="http://192.168.64.136/StationMeteoV2/index.php"; 
                    alert("Vous êtes désormais déconnecté");
                    session_destroy();
                }
            }
        </script>
<?php 
        echo '<center><button class="button" onclick="deconnexion()">Déconnexion</button></center>';
        echo '<div class="marge"></div>';
        echo '</div>';
    }
?> 







