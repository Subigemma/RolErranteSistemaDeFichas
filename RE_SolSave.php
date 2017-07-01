<?php
include_once ( "classes/setup.php");
$MySha1 = sha1($_POST["SRE_UserWow"].$_POST["SPersonaje"].date("YmdHi"));
$MyDate = date("YmdHi");
function MakeHabQuery ( $Str, $Index, $ThisDate, $ThisSha1 )
{
	global $db_chars;
	$MyValue = sprintf ( "S%sV%d" , $Str, $Index );
	$MyName  = sprintf ( "S%sN%d" , $Str, $Index );
	$MyEfec  = sprintf ( "S%sE%d" , $Str, $Index );
	if ($_POST[$MyValue] > 0)
	{
		$MyQuery = "INSERT INTO RE_Habilidades_pj_SOL ( RE_ID, " .
		   "RE_Pj, " .
		   "RE_Valor, " .
		   "RE_Efecto, " .
		   "RE_Status, " .
		   "RE_DateUpd, " .
		   "RE_Inspect, " .
		   "RE_SHA) values (" .
		   $_POST[$MyName] . ", " .
		   "'". $_POST["SPersonaje"] . "', " .
		   $_POST[$MyValue] . ", " .
		   "'". $_POST[$MyEfec] . "', " .
		   "1, " .
		   $ThisDate . ", " .
		   "'', " .
		   "'" . $ThisSha1 . "');";
           $MyResult = $db_chars->doQuery($MyQuery);
           if (!$MyResult)
	         die ("Error al gravar fichar (" . $db_chars->showError() .")");
	}
}
$MyQuery = "INSERT INTO RE_Atributos_SOL ( RE_Account," .
         " RE_pj," .
         " RE_Fisico," .
         " RE_Destreza," .
         " RE_Inteligencia," .
         " RE_Percepcion," .
         " RE_Mana," .
         " RE_Vida," .
         " RE_Iniciativa," .
         " RE_Defensa," .
         " RE_Status," .
         " RE_DateUpd," .
         " RE_Inspect," .
         " RE_SHA ) values (" .
		 "'" . $_POST["SRE_UserWow"] . "', " .
		 "'" . $_POST["SPersonaje"] . "', " .
		 $_POST["SFisico"] . ", " .
		 $_POST["SDestreza"] . ", " .
		 $_POST["SInteligencia"] . ", " .
		 $_POST["SPercepcion"] . ", " .
		 $_POST["SMana"] . ", " .
		 $_POST["SVida"] . ", " .
		 $_POST["SIniciativa"] . ", " .
		 $_POST["SDefensa"] . ", " .
		 "1, " .
		 $MyDate . ", " .
		 "'', " .
		 "'" . $MySha1 . "');";
$MyResult = $db_chars->doQuery($MyQuery);
if (!$MyResult)
	die ("Error al gravar fichar (" . $db_chars->showError() .")");
for ( $LoopVar=0; $LoopVar<$_POST["NUM_HABI"]; $LoopVar++)
{
	MakeHabQuery ( "Fis" , $LoopVar, $MyDate, $MySha1 );
	MakeHabQuery ( "Int" , $LoopVar, $MyDate, $MySha1 );
    MakeHabQuery ( "Des" , $LoopVar, $MyDate, $MySha1 );
	MakeHabQuery ( "Per" , $LoopVar, $MyDate, $MySha1 );
}		 
?>
<html>
<body>
<P>Tu ficha se ha registrado con éxito, en breve será revisada.</P>
</body>
</html>