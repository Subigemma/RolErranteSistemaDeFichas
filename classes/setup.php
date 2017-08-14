<?php
    /*
	** TODO: Check usuario
	*/
	if (!isset($_COOKIE['ips4_member_id']) or !isset($_COOKIE['ips4_pass_hash']))
	{
		die ("<html>\n<body>\n<a href='http://www.rolerrante.com'>Debes identificarte en el foro de Rol Errante.</a>\n</body>\n</html>");
	}
	$RE_UserForo=$_COOKIE['ips4_member_id'];
	//$RE_UserWow="Nuvalia";
	/******/
	define ("MAX_ATTR", 26);
    define ("MAX_HABI", 26);
    define ("NUM_HABI", 10);
    include_once "database.php";
    define("DB_WORLD", "trinity:trinity:localhost:3306:world");
    define("DB_CHARACTERS", "trinity:trinity:localhost:3306:characters");
    define("DB_AUTH", "trinity:trinity:localhost:3306:auth");
    $db_world=new database( DB_WORLD );
    $db_chars=new database( DB_CHARACTERS );
    $db_auth=new database( DB_AUTH );
	/*
	** ESTADOS DE FICHA
	*/
	define ("STATUS_PENDING", 1);      // Pendiente
	define ("STATUS_ONGOING", 2);      // En revision
	define ("STATUS_APPROVED", 3);     // Aprobada
	define ("STATUS_REJECTED", 4);     // Rechazada
	
/*
** Funciones varias
*/
function Fact ( $MyNum )
{
	$MyRes=0;
	for ($LoopVar=$MyNum;$LoopVar>0;$LoopVar--)
		$MyRes+=$LoopVar;
	return $MyRes;
}

?>
