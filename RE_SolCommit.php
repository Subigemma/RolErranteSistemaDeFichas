<?php 
include_once ( "classes/setup.php");
$SHab_Fisico = array();
$SHab_Inteligencia = array();
$SHab_Destreza = array();
$SHab_Percepcion = array();
$db_chars->doQuery("select RE_ID, RE_Nombre, RE_Efecto, RE_Mana from RE_Habilidades where RE_Atributo = 'Fisico';");
while ($row=$db_chars->NextRow())
{
	$TmpArr=array();
	$TmpArr["RE_ID"] = $row["RE_ID"];
	$TmpArr["RE_Nombre"] = $row["RE_Nombre"];
	$TmpArr["RE_Efecto"] = $row["RE_Efecto"];
	$TmpArr["RE_Mana"] = $row["RE_Mana"];
	$SHab_Fisico[] = $TmpArr;
}
$db_chars->doQuery("select RE_ID, RE_Nombre, RE_Efecto, RE_Mana from RE_Habilidades where RE_Atributo = 'Inteligencia';");
while ($row=$db_chars->NextRow())
{
	$TmpArr=array();
	$TmpArr["RE_ID"] = $row["RE_ID"];
	$TmpArr["RE_Nombre"] = $row["RE_Nombre"];
	$TmpArr["RE_Efecto"] = $row["RE_Efecto"];
	$TmpArr["RE_Mana"] = $row["RE_Mana"];
	$SHab_Inteligencia[] = $TmpArr;
}
$db_chars->doQuery("select RE_ID, RE_Nombre, RE_Efecto, RE_Mana from RE_Habilidades where RE_Atributo = 'Destreza';");
while ($row=$db_chars->NextRow())
{
	$TmpArr=array();
	$TmpArr["RE_ID"] = $row["RE_ID"];
	$TmpArr["RE_Nombre"] = $row["RE_Nombre"];
	$TmpArr["RE_Efecto"] = $row["RE_Efecto"];
	$TmpArr["RE_Mana"] = $row["RE_Mana"];
	$SHab_Destreza[] = $TmpArr;
}
$db_chars->doQuery("select RE_ID, RE_Nombre, RE_Efecto, RE_Mana from RE_Habilidades where RE_Atributo = 'Percepcion';");
while ($row=$db_chars->NextRow())
{
	$TmpArr=array();
	$TmpArr["RE_ID"] = $row["RE_ID"];
	$TmpArr["RE_Nombre"] = $row["RE_Nombre"];
	$TmpArr["RE_Efecto"] = $row["RE_Efecto"];
	$TmpArr["RE_Mana"] = $row["RE_Mana"];
	$SHab_Percepcion[] = $TmpArr;
}
function GetName ($MyArray, $MyIndex)
{
	foreach ( $MyArray as $MyKey => $MyValue )
	{
		if ($MyValue["RE_ID"] == $MyIndex )
			return $MyValue["RE_Nombre"];
	}
}
?>
<html>
<head>
<script>
function BkToFicha()
{
	var MyObj=document.getElementById("REForm");
	MyObj.action = "RE_Solicitud.php";
	MyObj.submit();
}
function Tiramillas()
{
	var MyObj=document.getElementById("REForm");
	MyObj.action = "RE_SolSave.php";
	MyObj.submit();
}

function NoOK( MyStr )
{
	alert (MyStr);
	BkToFicha();
}

</script>
</head>
<body>
<form name=REForm id=REForm method='post'>
<?php
foreach ( $_POST as $MyKey => $MyValue )
	echo "<input type=hidden id=".$MyKey." name=".$MyKey." value='".$MyValue."'>\n";
?>
</form>
<?php
/****************
** VALIDACIONES
*****************/

/*
** Nombre del Personaje
*/
$SeePj=strtolower($_POST["SPersonaje"]);
if (strlen($_POST["SPersonaje"]) < 1 )
	echo "<script>\nNoOK('Debes proporcionar un nombre de personaje válido');\n</script>\n";
$MyQuery="select account, name from characters where lower(name) = '".$SeePj."';";
$db_chars->doQuery($MyQuery);
$MyPj="";
while ($row=$db_chars->NextRow())
	$MyPj = strtolower($row["name"]);
if ($MyPj == $SeePj)
	echo "<script>\nNoOK('El nombre del personaje ya existe.');\n</script>\n";

/*
** Atributos
*/
$TotatAttr = $_POST["SFisico"]+$_POST["SInteligencia"]+$_POST["SDestreza"]+$_POST["SPercepcion"];
if ($TotatAttr > $_POST["MAX_ATTR"])
	echo "<script>\nNoOK('La suma total de atributos excede el máximo permitido');\n</script>\n";
if ( $_POST["SFisico"] < 4 || $_POST["SFisico"] > 10 ||
     $_POST["SInteligencia"] < 4 || $_POST["SInteligencia"] > 10 ||
	 $_POST["SDestreza"] < 4 || $_POST["SDestreza"] > 10 ||
	 $_POST["SPercepcion"] < 4 || $_POST["SPercepcion"] > 10 )
	echo "<script>\nNoOK('El valor de cada atributo debe estar comprendido entre 4 y 10.');\n</script>\n";
	
/*
** Habilidades
*/
$MyHab = array();
$MyHabIndex = 0;
for ( $LoopVar=0; $LoopVar<$_POST["NUM_HABI"]; $LoopVar++)
{
	$MyValue = sprintf ( "SFisV%d" , $LoopVar );
	if ($_POST[$MyValue] > 0)
	{
		if ($_POST[$MyValue] > 2)
		{
		  echo "<script>\nNoOK('El valor de la habilidad debe estar entre 1 y 2');\n</script>\n";	
		  break;
		}
		$MyName=sprintf ( "SFisN%d", $LoopVar );
		if (strlen($_POST[$MyName]) < 2)
		{
		  echo "<script>\nNoOK('No puedes dar valor a habilidades cuyo nombre no has seleccionado');\n</script>\n";	
		  break;
		}
		$MyTmp = array ( "Nombre" => $_POST[$MyName], "Valor" => $_POST[$MyValue] );
		$MyHab[$MyHabIndex] = $MyTmp;
		$MyHabIndex++;
	}
	$MyValue = sprintf ( "SIntV%d" , $LoopVar );
	if ($_POST[$MyValue] > 0)
	{
		if ($_POST[$MyValue] > 2)
		{
		  echo "<script>\nNoOK('El valor de la habilidad debe estar entre 1 y 2');\n</script>\n";	
		  break;
		}
		$MyName=sprintf ( "SIntN%d", $LoopVar );
		if (strlen($_POST[$MyName]) < 2)
		{
		  echo "<script>\nNoOK('No puedes dar valor a habilidades cuyo nombre no has seleccionado');\n</script>\n";	
		  break;
		}
		$MyTmp = array ( "Nombre" => $_POST[$MyName], "Valor" => $_POST[$MyValue] );
		$MyHab[$MyHabIndex] = $MyTmp;
		$MyHabIndex++;
	}
	$MyValue = sprintf ( "SDesV%d" , $LoopVar );
	if ($_POST[$MyValue] > 0)
	{
		if ($_POST[$MyValue] > 2)
		{
		  echo "<script>\nNoOK('El valor de la habilidad debe estar entre 1 y 2');\n</script>\n";	
		  break;
		}
		$MyName=sprintf ( "SDesN%d", $LoopVar );
		if (strlen($_POST[$MyName]) < 2)
		{
		  echo "<script>\nNoOK('No puedes dar valor a habilidades cuyo nombre no has seleccionado');\n</script>\n";	
		  break;
		}
		$MyTmp = array ( "Nombre" => $_POST[$MyName], "Valor" => $_POST[$MyValue] );
		$MyHab[$MyHabIndex] = $MyTmp;
		$MyHabIndex++;
	}
	$MyValue = sprintf ( "SPerV%d" , $LoopVar );
	if ($_POST[$MyValue] > 0)
	{
		if ($_POST[$MyValue] > 2)
		{
		  echo "<script>\nNoOK('El valor de la habilidad debe estar entre 1 y 2');\n</script>\n";	
		  break;
		}
		$MyName=sprintf ( "SPerN%d", $LoopVar );
		if (strlen($_POST[$MyName]) < 2)
		{
		  echo "<script>\nNoOK('No puedes dar valor a habilidades cuyo nombre no has seleccionado');\n</script>\n";	
		  break;
		}
		$MyTmp = array ( "Nombre" => $_POST[$MyName], "Valor" => $_POST[$MyValue] );
		$MyHab[$MyHabIndex] = $MyTmp;
		$MyHabIndex++;
	}
}
$TotalHab = 0;
for ($LoopVar=0;$LoopVar<$MyHabIndex;$LoopVar++)
{
	$TotalHab += Fact($MyHab[$LoopVar]["Valor"]);
	for ($MyIndex=0;$MyIndex<$MyHabIndex;$MyIndex++)
	{
		if ( $MyHab[$LoopVar]["Valor"] == $MyHab[$MyIndex]["Valor"] && $LoopVar != $MyIndex)
		{
		   echo "<script>\nNoOK('Existen habilidades duplicadas\n N0-" . 
		       $MyHab[$LoopVar]["Valor"] . "." . $LoopVar . "/" . 
			   $MyHab[$MyIndex]["Valor"] . "." . $MyIndex . "');\n</script>\n";	
		   break;			
		}
	}
}
if ($TotalHab > $_POST["MAX_HABI"])
    echo "<script>\nNoOK('La suma total de habilidades excede el máximo permitido');\n</script>\n";	
//echo "<pre>";
//echo $TotalHab."\n";
//print_r ($MyHab);
//echo "</pre>";
?>
<h3>Petici&oacute;n de ficha - Resumen</h3>
<table>
<tr><td align=right><b>Usuario:</b></td><td align=left><?php echo $_POST["SRE_UserForo"]?></td></tr>
<tr><td align=right><b>Jugador:</b></td><td align=left><?php echo $_POST["SRE_UserWow"]?></td></tr>
<tr><td align=right><b>Personaje:</b></td><td align=left><?php echo $_POST["SPersonaje"]?></td></tr>
</table>
<h3> -- Ficha generada -- </h3>
<table border="3"  BORDERCOLOR=RED><tr><td>
<table border=1><tr>
<td>
<table>
   <tr><td colspan=2 align=center><B>Atributos</B></td></tr>
   <tr><td align=right><B>Fisico:</b></td><td align=left><?php echo $_POST["SFisico"] ?></td></tr>
   <tr><td align=right><B>Inteligencia:</b></td><td align=left><?php echo $_POST["SInteligencia"] ?></td></tr>
   <tr><td align=right><B>Destreza:</b></td><td align=left><?php echo $_POST["SDestreza"] ?></td></tr>
   <tr><td align=right><B>Percepcion:</b></td><td align=left><?php echo $_POST["SPercepcion"] ?></td></tr>
</table>
</td>
<td>
<table>
   <tr><td colspan=2 align=center><B>Valores de combate</B></td></tr>
   <tr><td align=right><B>Vida:</b></td><td align=left><?php echo $_POST["SVida"] ?></td></tr>
   <tr><td align=right><B>Mana:</b></td><td align=left><?php echo $_POST["SMana"] ?></td></tr>
   <tr><td align=right><B>Iniciativa:</b></td><td align=left><?php echo $_POST["SIniciativa"] ?></td></tr>
   <tr><td align=right><B>Defensa:</b></td><td align=left><?php echo $_POST["SDefensa"] ?></td></tr>
</table>
</td>
<td>
<table>
   <tr><td><input type=button value='Enviar peticion' onclick='return Tiramillas()'></td></tr>
   <tr height=20><td></td></tr>
   <tr><td><input type=button value='Volver a la ficha' onclick='return BkToFicha()'></td></tr>
</table>
</td>
</tr></table>
</td></tr>
<tr><td>

<table>
<tr><td colspan=3 align=center><B>Habilidades</B><td></tr>


<tr bgcolor=yellow ><td  colspan=3 align=center><b>Fisico</b></td></tr>
<?php
for ($LoopVar=0;$LoopVar<$_POST["NUM_HABI"];$LoopVar++)
{
	echo "<tr>";
	$Aux1 = sprintf("SFisV%d", $LoopVar);
	$Aux2 = sprintf("SFisN%d", $LoopVar);
	$Aux3 = sprintf("SFisE%d", $LoopVar);
	if ( $_POST[$Aux1] > 0 )
		echo "<td>".GetName( $SHab_Fisico, $_POST[$Aux2])."</td><td width=20>".$_POST[$Aux1]."</td><td>(".$_POST[$Aux3].")</td></tr>";
	echo "</tr>";
}
?>
<tr bgcolor=yellow ><td colspan=3 align=center><b>Inteligencia</b></td></tr>
<?php
for ($LoopVar=0;$LoopVar<$_POST["NUM_HABI"];$LoopVar++)
{
	echo "<tr>";
	$Aux1 = sprintf("SIntV%d", $LoopVar);
	$Aux2 = sprintf("SIntN%d", $LoopVar);
	$Aux3 = sprintf("SIntE%d", $LoopVar);
	if ( $_POST[$Aux1] > 0 )
		echo "<td>".GetName($SHab_Inteligencia,$_POST[$Aux2])."</td><td width=20>".$_POST[$Aux1]."</td><td>(".$_POST[$Aux3].")</td></tr>";
	echo "</tr>";
}
?>
<tr bgcolor=yellow><td colspan=3 align=center><b>Destreza</b></td></tr>
<?php	
for ($LoopVar=0;$LoopVar<$_POST["NUM_HABI"];$LoopVar++)
{
	$Aux1 = sprintf("SDesV%d", $LoopVar);
	$Aux2 = sprintf("SDesN%d", $LoopVar);
	$Aux3 = sprintf("SDesE%d", $LoopVar);
	if ( $_POST[$Aux1] > 0 )
		echo "<td>".GetName($SHab_Destreza,$_POST[$Aux2])."</td><td width=20>".$_POST[$Aux1]."</td><td>(".$_POST[$Aux3].")</td></tr>";
	echo "</tr>";
}
?>
<tr bgcolor=yellow><td colspan=3 align=center><b>Percepcion</b></td></tr>
<?php	
for ($LoopVar=0;$LoopVar<$_POST["NUM_HABI"];$LoopVar++)
{
	$Aux1 = sprintf("SPerV%d", $LoopVar);
	$Aux2 = sprintf("SPerN%d", $LoopVar);
	$Aux3 = sprintf("SPerE%d", $LoopVar);
	if ( $_POST[$Aux1] > 0 )
		echo "<td>".GetName($SHab_Percepcion,$_POST[$Aux2])."</td><td width=20>".$_POST[$Aux1]."</td><td>(".$_POST[$Aux3].")</td></tr>";
	else
		echo "<td></td><td></td><td></td>";
	
	echo "</tr>\n";
}
?>
</table>
</td></tr>
</table>
</body>
</html>
