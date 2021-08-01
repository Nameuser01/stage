<h3 style="font-weight:bold;color:#6EC1E4;">Informations</h3>
<?php
$bit_color_change = 0;//Bit de parité pour le changement de couleur des lignes
try{
$bdd=new PDO('mysql:host=<HOTE>;dbname=<DB_NAME>;charset=utf8', '<USERNAME>','<PASSWORD>');
}
catch(Exeption $e){
die('Erreur: '. $e->getMessage());
}
$result = $bdd->query('SELECT * FROM demi_journee');
while($data = $result->fetch()){
 if($data["type"] == "texte"){//Si la ligne est du texte on affiche:
  if($bit_color_change%2 == 1){//Si le bit de parité est impair: vert clair
   ?>
   <div style="background-color:#ebf1e9;margin-top:-2px;padding-left:30px;padding-right:30px;padding-top:15px;padding-bottom:15px;">
   <?php
  }
  else{//sinon: ligne -> vert foncé
   ?>
   <div style="background-color:#d5e3cf;margin-top:-2px;padding-left:30px;padding-right:30px;padding-top:15px;padding-bottom:15px;">
   <?php
  }?>
  <p style="font-size: 1px;" id="<?php echo $data["lien"];?>"></p><!--Génération du lien automatique-->
  <span style="font-size:20px;">
  <?php
  echo $data["nom"]."<br>";
  ?>
  </span>
  <?php
  echo nl2br($data["informations"]);//nl2br fait prendre en compte les retours chariots au navigateur
  ?>
  </div>
  <?php
  $bit_color_change++;//Incrémentation pour changer la parité à chaque ligne
 }
 else{/*Do nothing*/}
}?>
