<?php
$user_informations = um_user("roles");
$i = 0;
$continue = true;
while($user_informations[$i] && $continue = true){
 if($user_informations[$i] == "Administrator" || $user_informations[$i] == "um_pilote"){
  $role = "admin";//Le membre appartient à "Administration"
  $continue = false;//On casse la condition while
  break;//On quitte le if de force
 }
 else{/*Do nothing*/}
 $i++;//On passe à la ligne suivante du tableau récupéré
}
try{
 $bdd = new PDO('mysql:host=<IP_ADDR>;dbname=<BDD_NAME>;charset=utf8', '<USERNAME>', '<PASSWORD>');
}
catch (Exeption $e){
 die('Erreur: ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM supervision_machines');
$machines_dico = array(//LA MODIFICATION DES MACHINES AFFICHÉES SUR LE SITE SE FAIT DANS CE DICTIONNAIRE
 "1" => "machine 1",
 "2" => "machine 2",
 "3" => "machine 3",
 "4" => "machine 4",
);
$etat_machines = array(//lie le bit de select° de la bdd à un affichage humain
 "1" => "fonctionnel",
 "0" => "non-fonctionnel",
);
while ($donnees = $reponse->fetch()){
 ?>
 <div class="cont" style="display:flex; flex-direction: row; justify-content: space-between;margin-bottom: 15px;">
  <?php
  if ($donnees["etat"] == 0){//Si la machine est non fonctionnelle, on fait ca:
   ?>
   <p>L'équipement: <strong><?php echo $machines_dico[$donnees["machine"]];?></strong> est <strong style="color:red"><?php echo $etat_machines[$donnees["etat"]];?></strong> depuis le <?php echo htmlspecialchars($donnees["date_com"]); ?><br /><!--Interprétation du contenu de la bdd en caractères. Pas en code-->
   <?php
   $len_comment = (strlen(htmlspecialchars($donnees["comment"])));//Interprétation du contenu de la bdd en caractères. Pas en code
   if ($len_comment > 0){//Si le commentaire est non null alors on affiche le message suivant
    ?>
    Informations sur la panne: <i><?php echo htmlspecialchars($donnees["comment"]); ?></i>.</p>
    <?php
   }
   else{/*Do nothing*/}
  }
  elseif ($donnees["etat"] == 1){//Si la machine fonctionne on afficeh le message suivant
   ?>
   <p>L'équipement <strong><?php echo $machines_dico[$donnees["machine"]];?></strong> est <strong style="color: green"><?php echo $etat_machines[$donnees["etat"]];?></strong>.</p>
   <?php
  }
  else{echo "ERREUR: BOOLÉEN /etat des machines\ non correct";/*etat != (0 || 1) . Ce cas est normalement impossible*/}
  if ($role == "admin"){//admin = la valeur qu'on a récupéré en début de code si l'utilisateur est admin ou pilote
   ?>
   <form action="https://.net/change_etat" method="post"><!--Form de changement d'état des équipements-->
    <input type="hidden" name="id" value="<?php echo $donnees['id'];?>" />
    <input type="hidden" name="machine" value="<?php echo $donnees['machine'];?>" />
    <input type="hidden" name="etat" value="<?php echo $donnees['etat'];?>" />
    <?php 
    if ($donnees["etat"] == 1){//On propose de changer l'état machine seulement si role="admin" (pilote ou administrateur) et que machine=dysfonctionnelle
     ?>
     <input type="text" name="comment" maxlength="255" placeholder="Informations sur la panne" />
     <?php
    }else{}
    ?>
    <input type="submit" value="Modifier l'état" /><!--On envoie les informations de ce formulaire vers le code de l'annexe 3-->
   </form>
   <?php
  }
  else{}
  ?>
 </div>
<?php
}
$reponse->closeCursor();//Fermeture consultation bdd
?>
