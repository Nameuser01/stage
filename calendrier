<h3 id="etats">Visualisation de l'état des équipements</h3>
<?php
$user_informations = um_user("roles");
for ($i = 0; $i <= 5; $i++){
 if ($user_informations[$i]){
  if($user_informations[$i] == "um_pilote"){
   $role = "pilote";
   break;
  }
  else{}
 }
 else{break;}
}
try{
 $bdd = new PDO ('mysql:host=;dbname=;charset=utf8', '', '');
}
catch (Exeption $e){
 die('Erreur: ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM supervision_machines');
$machines_dico = array(//LA MODIFICATION DES MACHINES AFFICHÉES SUR LE SITE SE FAIT DANS CE DICTIONNAIRE
 "1" => "",
 "2" => "",
 "3" => "",
 "4" => "",
);
$etat_machines = array(
 "1" => "fonctionnel",
 "0" => "non-fonctionnel",
);
while ($donnees = $reponse->fetch()){
 ?>
 <div class="cont" style="display:flex; flex-direction: row; justify-content: space-between;margin-bottom: 15px;">
  <?php
  if ($donnees["etat"] == 0){
   ?>
   <p>L'équipement: <strong><?php echo $machines_dico[$donnees["machine"]];?></strong> est <strong style="color:red"><?php echo $etat_machines[$donnees["etat"]];?></strong> depuis le <?php echo htmlspecialchars($donnees["date_com"]); ?><br />
   <?php
   $len_comment = (strlen(htmlspecialchars($donnees["comment"])));
   if ($len_comment > 0){
   ?>
   Informations sur la panne: <i><?php echo htmlspecialchars($donnees["comment"]); ?></i>.</p>
   <?php
   }
   else{}
  }
  elseif ($donnees["etat"] == 1){
   ?>
   <p>L'équipement <strong><?php echo $machines_dico[$donnees["machine"]];?></strong> est <strong style="color: green"><?php echo $etat_machines[$donnees["etat"]];?></strong>.</p>
   <?php
  }
  else{echo "ERREUR: BOOLÉEN /etat des machines\ non correct";}
  if ($role == "pilote"){
   ?>
   <form action="https:///change_etat" method="post">
    <input type="hidden" name="id" value="<?php echo $donnees['id'];?>" />
    <input type="hidden" name="machine" value="<?php echo $donnees['machine'];?>" />
    <input type="hidden" name="etat" value="<?php echo $donnees['etat'];?>" />
    <?php 
    if ($donnees["etat"] == 1){
     ?>
     <input type="text" name="comment" maxlength="254" placeholder="Informations sur la panne" />
     <?php
    }else{}
    ?>
    <input type="submit" value="Modifier l'état" />
   </form>
   <?php
  }
  else{}
  ?>
 </div>
<?php
}
$reponse->closeCursor();
?>
