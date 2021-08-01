<?php
$user_id = $_POST['user_id'];
$zoom_id = $_POST['zoom_id'];
try{
 $bdd = new PDO('mysql:host=<ip_addr>; dbname=<db_name>;charset=utf8', '<username>' '<password>');
}
catch(Exeption $e){
 die('Erreur: '.$e->getMessage());
}
if(isset($user_id) and isset($zoom_id)){
 $req = $bdd->prepare("INSERT INTO zoom_reunions (hote, id_zoom) VALUES (?, ?)");
 $req->execute(array($user_id, $zoom_id));
 ?>
 <script>
  window.alert("Votre réunion a bien été enregistrée.");//Pop-up d'informations pour l'utilisateur
  window.location.href="https://SITE.net/gestion_zoom";//Redirection automatique onClick
 </script>
 <?php
}
else{
 ?>
 <script>
  window.alert("Nous avons remarqué un problème lors du traitement des informations. Votre réservation n'est pas enregistrée.");
  window.location.href="https://SITE.net/gestion_zoom";//Redirection automatique onClick
 </script>
 <?php
}?>
