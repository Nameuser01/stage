<?php
function date_printing($date)/*Fonction qui permet d'afficher les dates ligne 89*/
{//Le format francais n'est pas traité car pas compris par le plugin, on ne le stocke pas dans des variables, on utilise uniquement la fonction echo pour affiehr certaines parties de la date anglais, c'est tout.
 for($i=8;$i<10;$i++){//On prend les 2 derniers caractères. Résultat "15"
  echo $date[$i];
 }
 for($i=4;$i<8;$i++){//On affiche le mois + les deux tirets. Résultat "-01-"
  echo $date[$i];
 }
 for($i=0;$i<4;$i++){//On affiche la date.Résutlat "2021"
  echo $date[$i];
 }
 //Input: 2021-01-15 / Output: 15-01-2021
}
if(isset($_POST['start_date']) && strlen($_POST['start_date']) > "0"){
 //Si la date de début existe, on la stock dans la variable $start_date pour le traitement
 $start_date = $_POST['start_date'];
}
else{
 //sinon on définit la date par défault comme étant "today"
 $start_date = date('Y-m-d');
}
if(isset($_POST['end_date']) && strlen($_POST['end_date']) > "0"){
 //Si la date de fin existe, on la stock dans la variable $end_date pour le traitement
 $end_date = $_POST['end_date'];
 $origin = date_create($start_date);//format
 $target = date_create($end_date);//format
 $interval = date_diff($origin, $target);//function de calcul de différence
 $days_to_add = $interval->format('%a');//stockage de la différence pour le traitement
}
else{//Sinon -> valeur par défaut
 $foo_date = date("Y-m-d");
 $days_to_add = 300;//$start_date + 300 jours. Valeur arbitraire, modifiable
 $end_date = date("Y-m-d", strtotime($foo_date.'+ '.$days_to_add.' days'));//strtotime permet de pouvoir traiter une demande formatée. Si on n'utilise pas cette fonction, on se retrouve à calculer un string + un int, donc Erreur.
}
?>
<form action="https://SITE.net/reservations" method="post">
<fieldset>
 <legend>Filtrez les créneaux par date: </legend>
 <label>date de début</label>
 <?php
 $min_date = date("Y-m-d");//Today
 ?>
 <input name="start_date" type="date" min="<?php echo $min_date; ?>" /><br /><!--Le min="" permet de ne pas pouvoir réserver une date antérieure à aujourd'hui-->
 <label>Date de fin</label>
 <input name="end_date" type="date" min="<?php echo $min_date; ?>"/><br /><!--Le min="" permet de ne pas pouvoir réserver une date antérieure à aujourd'hui-->
 <br /><br /><p>Sélectionnez les équipements que vous souhaitez afficher:</p>
 <p>Note: Si aucun équipement n'est sélectionner, touts les équipements seront affichés</p>
 <input type="checkbox" name="machine1">
 <label>machine 1</label><br />
 <input type="checkbox" name="machine2">
 <label>machine 2</label><br />
 <input type="checkbox" name="machine3">
 <label>machine 3</label><br />
 <input type="checkbox" name="machine4">
 <label>machine 4</label><br />
 <center><input name="send" type="submit" value="Appliquer / Réinitialiser les filtres" /></center><br />
</fieldset>
</form>
<!--Les lignes suivantes permettent de récapituler les informations présentes dans le filtres-->
<p style="margin-top:50px;"><strong>Filtres appliqués:</strong><br />Vous voulez afficher les créneaux sur les équipements <strong>
<?php
if((isset($_POST['machine 1']) == false AND isset($_POST['machine 2']) == false AND isset($_POST['machine 3']) == false AND isset($_POST['machine 4']) == false) OR ($_POST['machine 1'] == "on" AND $_POST['machine 2'] == "on" AND $_POST['machine 3'] == "on" AND $_POST['machine 4'] == "on")){
 //Si TOUS les checkbox sont vides ou si ils sont tous cochés. On affiche la ligne suivante.
 echo "[machine 1] [machine 2] [machine 3] [machine 4] ";
}
else{//Sinon on affiche le nom des machines cochées une par une. Pas de retour chariot en PHP, ca affiche donc la même chose que dans le 'if' lignes 63-66
 if($_POST['machine 1'] == "on"){
  echo "[machine 1] ";
 }
 else{/*Do nothing*/}
 if($_POST['machine 2'] == "on"){
  echo "[machine 2] ";
 }
 else{/*Do nothing*/}
 if($_POST['machine 3'] == "on"){
  echo "[machine 3] ";
 }
 else{/*Do nothing*/}
 if($_POST['machine 4'] == "on"){
  echo "[Bâti machine 4]";
 }
 else{/*Do nothing*/}
}
?>
</strong>, concernant la période du <strong><?php date_printing($start_date); ?></strong> au <strong><?php date_printing($end_date); ?></strong></p><!--On affiche finalement les dates. Il faut formater les variables en francais grâce à la fonction date_printing (voir fonction au début du code) -->
<?php
if(isset($_POST['machine 1']) == false AND isset($_POST['machine 2']) == false AND isset($_POST['machine 3']) == false AND isset($_POST['machine 4']) == false){
 echo "<br>indication_debeug(line89)<br>";
 ?><!--Ci-dessous la ligne qui permet d'afficher toutes les réservations dans le cas ou tous les checkbox sont vides-->
 [CP_APP_HOUR_BOOKING_LIST from="<?php echo $start_date; ?>" to="<?php echo $start_date; ?> +<?php echo $days_to_add; ?> days" fields="DATE,TIME,service,email" calendar="6"]
 <?php
}
else{
 //Ci-dessous, les 4 conditions qui permettent d'afficher les réservations lorsqu'au moins 1 checkbox est coché par l'utilisateur
 if($_POST['machine 1'] == "on"){//un checkbox coché retourne la valeur "on". D'où la condition
  ?>
  <br /><p style="color:#6ec1e4;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;padding-left:10px;">Affichage de l'équipement machine 1:</p>
  [CP_APP_HOUR_BOOKING_LIST from="<?php echo $start_date; ?>" to="<?php echo $start_date; ?> +<?php echo $days_to_add; ?> days" service="machine 1" fields="DATE,TIME,service,email" calendar="6"]
  <?php
 }
 else{/*Do nothing*/}
  if($_POST['machine 2'] == "on"){//un checkbox coché retourne la valeur "on". D'où la condition
   ?>
   <br /><br /><p style="color:#6ec1e4;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;padding-left:10px;">Affichage de l'équipement machine 2:</p>
   [CP_APP_HOUR_BOOKING_LIST from="<?php echo $start_date; ?>" to="<?php echo $start_date; ?> +<?php echo $days_to_add; ?> days" service="machine 2" fields="DATE,TIME,service,email" calendar="6"]
   <?php
  }
  else{/*Do nothing*/}
  if($_POST['machine 3'] == "on"){//un checkbox coché retourne la valeur "on". D'où la condition
   ?>
   <br /><br /><p style="color:#6ec1e4;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;padding-left:10px;">Affichage de l'équipement machine 3:</p>
   [CP_APP_HOUR_BOOKING_LIST from="<?php echo $start_date; ?>" to="<?php echo $start_date; ?> +<?php echo $days_to_add; ?> days" service="machine 3" fields="DATE,TIME,service,email" calendar="6"]
   <?php
  }
  else{/*Do nothing*/}
  if($_POST['machine 4'] == "on"){//un checkbox coché retourne la valeur "on". D'où la condition
   ?>
   <br /><br /><p style="color:#6ec1e4;border-bottom:1px solid #cccccc;border-left:1px solid #cccccc;padding-left:10px;">Affichage de l'équipement Bâti machine 4:</p>
   [CP_APP_HOUR_BOOKING_LIST from="<?php echo $start_date; ?>" to="<?php echo $start_date; ?> +<?php echo $days_to_add; ?> days" service="Bâti machine 4" fields="DATE,TIME,service,email" calendar="6"]
   <?php
  }
  else{/*Do nothing*/}
}?>
