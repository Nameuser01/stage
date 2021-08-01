<h4>Ajout d'une réunion sur SITE</h4><br />
<form action="https://SITE.net/ajout_reunion" method="post">
 <label>Entrez votre numéro de réunion (SANS ESPACES) *</label><br />
 <input type="text" name="zoom_id" maxlength="15" required />
 <input type="hidden" name="user_id" value="<?php echo um_user("ID"); ?>" /><br /><br /><!--On récupère l'id de l'utilisateur.-->
 <input type="submit" value="Ajouter votre réunion" />
</form><br /><br/>
<h4>Liste des réunions connues dans notre base de donnée</h4><br />
<?php
try{
 $bdd=new PDO('mysql:host=<ip_addr>; dbname=<db_name>;charset=utf8', '<username>' '<password>');
}
catch(Exeption $e){
 die('Erreur: '. $e->getMessage());
}
$result = $bdd->query('SELECT * FROM zoom_reunions');
while($data = $result->fetch())
{
 /*On utilise la ligne d'appel du plugin zoom avec de l'injection PHP à l'intérieur pour afficher la liste des réunions*/?>
 [zoom_api_link meeting_id="<?php echo $data['id_zoom']; ?>" link_only="no"]<br />
 <?php/*Même principe d'utilisation que l'affichage des réservations des équipements*/
}?>
