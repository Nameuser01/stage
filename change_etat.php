<?php
$id = $_POST['id'];
$machine = $_POST['machine'];
$etat = $_POST['etat'];
$comment = $_POST['comment'];
$date_com = date("H:i:s d/m/Y");//Récupération de l'heure grâce a PHP
try{
 $bdd = new PDO('mysql:host=<IP_ADDR>; dbname=<BDD_NAME>;charset=utf8', '<USERNAME>', '<PASSWORD>');
}
catch(Exeption $e){
 die('Erreur: '.$e->getMessage());
}
//Inputs = (1 || 0) machine fonctionnelle, ou non
if($id == $machine and $etat == 1){//Si la machine était fonctionnelle, on la mets à non fonctionnelle dans la bdd
 //requête SQL update pour changer le bit état -> 0. Et on entre la date et commentaire dans la bdd
 $bdd->exec("UPDATE supervision_machines SET etat = 0, date_com = '$date_com', comment = '$comment' WHERE id = '$id'");
}
elseif($id == $machine and $etat == 0){//Si la machine était non-fonctionnelle, on la passe en fonctionnelle sur la bdd
 //udpate SQL pour modifier le bit d'état, changer l'heure(pas utile puisque le bit état sera à 1 donc, l'heure et le commentaires ne seront pas affichés. Et le commentaire est 'supprimé' (vidé)
 $bdd->exec("UPDATE supervision_machines SET etat = 1, date_com = '$date_com', comment = '$comment' WHERE id = '$id'");
}
else{//Ca n'est pas censé se produire
 echo "Erreur: l'id est différent du numéro de la machine !";
}
header('Location: https://SITE.net/calendrier');//redirection
?>
