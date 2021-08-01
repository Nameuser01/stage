<?php
$bit_color = 0;//Bit de parité qui sert pour les couleurs vertes
try{
 $bdd=new PDO('mysql:host=<HOTE>;dbname=<DB_NAME>;charset=utf8', '<USERNAME>','<PASSWORD>');
}
catch(Exeption $e){
 die('Erreur: '. $e->getMessage());
}
$result = $bdd->query('SELECT * FROM demi_journee');//stockage requête
while($data = $result->fetch()){//boucle de traitement de la requête
 if($data["type"] == "titre"){//Si la ligne en question est un titre
  /*On applique ce style*/?>
  <div style="background-color:#44546a;color:#ffffff;padding-left:10px;padding-top:5px;padding-bottom:5px;">
  <?php
  echo $data["heure"];
  ?>
  <span style="margin-left:100px;">
  <?php
  echo " <b>".$data["nom"]."</b><br>";
  ?>
  </span>
  </div>
  <?php
  $bit_color=0;//On reset le bit si on tombe sur une ligne de type titre (harmonisation des couleurs)
 }
 else{//Si la ligne n'est pas un titre
  if($bit_color%2 == 1){//Bit impair -> vert clair
  ?>
  <div style="background-color:#ebf1e9;padding-left:10px;padding-top:7px;padding-bottom:7px;">
  <?php
 }
 else{//Bit pair -> vert foncé
  ?>
  <div style="background-color:#d5e3cf;padding-left:10px;padding-top:7px;padding-bottom:7px;">
  <?php
 }
 ?>
 <span style="margin-right:100px;">
 <?php
 echo $data["heure"];
 ?>
 </span>
 <a href="#<?php echo $data["lien"]; ?>">
 <?php
 echo $data["nom"];
 ?>
 </a>
 <?php
 echo " - ".$data["titre"];
 ?>
 </div>
 <?php
 $bit_color++;//incrémentation à chaque ligne pour changer la parité du bit
 }
}?>
