<?php
$role = "none";
$dico = array(
	"1" => "subscriber",
	"2" => "administrateur",
	"3" => "pilote",
	"4" => "pilote",
);
for ($i = 1; $i <= 4; $i++){
	if ($dico[$i] && $dico[$i] == "pilote"){
		$role = "pilote";
		break;
	}
	else{}	
	echo "i vaut : ".$i."<br/>";
}
if ($role == "pilote"){
	echo "Vous êtes un pilote";
}
else{
	echo "fin de l'éxécution du script php";
}
?>
