<?php 
include_once ( "classes/setup.php");

$SHabFisNom = array();
$SHabFisVal = array();
$SHabFisEfe = array();
$SHabIntNom = array();
$SHabIntVal = array();
$SHabIntEfe = array();
$SHabPerNom = array();
$SHabPerVal = array();
$SHabPerEfe = array();
$SHabDesNom = array();
$SHabDesVal = array();
$SHabDesEfe = array();
$TotalHab = 0;
for ($LoopVar=0;$LoopVar<NUM_HABI;$LoopVar++)
{
	$Aux=sprintf("SFisN%d", $LoopVar);
	$SHabFisNom[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SFisV%d", $LoopVar);
	$SHabFisVal[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:0;
	$Aux=sprintf("SFisE%d", $LoopVar);
	$SHabFisEfe[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SIntN%d", $LoopVar);
	$TotalHab += Fact($SHabFisVal[$LoopVar]);
	$SHabIntNom[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SIntV%d", $LoopVar);
	$SHabIntVal[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:0;
	$Aux=sprintf("SIntE%d", $LoopVar);
	$SHabIntEfe[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SPerN%d", $LoopVar);
	$TotalHab += Fact($SHabIntVal[$LoopVar]);
	$SHabPerNom[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SPerV%d", $LoopVar);
	$SHabPerVal[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:0;
	$Aux=sprintf("SPerE%d", $LoopVar);
	$SHabPerEfe[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$TotalHab += Fact($SHabPerVal[$LoopVar]);
	$Aux=sprintf("SDesN%d", $LoopVar);
	$SHabDesNom[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$Aux=sprintf("SDesV%d", $LoopVar);
	$SHabDesVal[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:0;
	$Aux=sprintf("SDesE%d", $LoopVar);
	$SHabDesEfe[$LoopVar]=isset($_POST[$Aux])?$_POST[$Aux]:'';
	$TotalHab += Fact($SHabDesVal[$LoopVar]);
}
$SFisico=isset($_POST["SFisico"])?$_POST["SFisico"]:4;
$SInteligencia=isset($_POST["SInteligencia"])?$_POST["SInteligencia"]:4;
$SDestreza=isset($_POST["SDestreza"])?$_POST["SDestreza"]:4;
$SPercepcion=isset($_POST["SPercepcion"])?$_POST["SPercepcion"]:4;
$SPersonaje=isset($_POST["SPersonaje"])?$_POST["SPersonaje"]:"";
$RestAttr=MAX_ATTR - $SFisico - $SInteligencia - $SDestreza - $SPercepcion;
$RestHab=MAX_HABI - $TotalHab;
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
?>
<html>
<head>
<script>
var SFisE = new Array();
var SIntE = new Array();
var SDesE = new Array();
var SPerE = new Array();
<?php
foreach ($SHab_Fisico as $MyKey => $MyValue)
   echo "SFisE[".$MyValue["RE_ID"]."]='".$MyValue["RE_Efecto"]."';\n";
foreach ($SHab_Inteligencia as $MyKey => $MyValue)
   echo "SIntE[".$MyValue["RE_ID"]."]='".$MyValue["RE_Efecto"]."';\n";
foreach ($SHab_Destreza as $MyKey => $MyValue)
   echo "SDesE[".$MyValue["RE_ID"]."]='".$MyValue["RE_Efecto"]."';\n";
foreach ($SHab_Percepcion as $MyKey => $MyValue)
   echo "SPerE[".$MyValue["RE_ID"]."]='".$MyValue["RE_Efecto"]."';\n";

?>
function CFis(Index, MyObj)
{
	MyIndex = new Number();
	MyIndex = Index;
	MyField = document.getElementById("SFisE"+MyIndex.toString());
	if (typeof SFisE[MyObj.value] != 'undefined') 
      MyField.value = SFisE[MyObj.value];
    else
      MyField.value = '';
}
function CInt(Index, MyObj)
{
	MyIndex = new Number();
	MyIndex = Index;
	MyField = document.getElementById("SIntE"+MyIndex.toString());
	if (typeof SIntE[MyObj.value] != 'undefined') 
      MyField.value = SIntE[MyObj.value];
    else
      MyField.value = '';
}
function CDes(Index, MyObj)
{
	MyIndex = new Number();
	MyIndex = Index;
	MyField = document.getElementById("SDesE"+MyIndex.toString());
	if (typeof SDesE[MyObj.value] != 'undefined') 
      MyField.value = SDesE[MyObj.value];
    else
      MyField.value = '';
}
function CPer(Index, MyObj)
{
	MyIndex = new Number();
	MyIndex = Index;
	MyField = document.getElementById("SPerE"+MyIndex.toString());
	if (typeof SPerE[MyObj.value] != 'undefined') 
      MyField.value = SPerE[MyObj.value];
    else
      MyField.value = '';
}
function OkSend ()
{
	MyObj = document.getElementById ("REForm");
	MyObj.action = "RE_SolCommit.php";
	MyObj.submit();
}
</script>
</head>
<body>
<h3>Solicitud de ficha</h3>
<form id=REForm name=REForm method='post'>
<input type=hidden id=SMode name=SMode value="send">
<input type=hidden id=SRE_UserForo name=SRE_UserForo value="<?php echo $RE_UserForo ?>">
<input type=hidden id=SRE_UserWow name=SRE_UserWow value="<?php echo $RE_UserWow ?>">
<input type=hidden id=NUM_HABI name=NUM_HABI value="<?php echo NUM_HABI ?>">
<input type=hidden id=MAX_HABI name=MAX_HABI value="<?php echo MAX_HABI ?>">
<input type=hidden id=MAX_ATTR name=MAX_ATTR value="<?php echo MAX_ATTR ?>">
<table align=left>
<tr><td align=right><B>Usuario:</b></td><td align=left><?php echo $RE_UserForo ?></td><td width=30></td></tr>
<tr><td align=right><B>Jugador:</b></td><td align=left><?php echo $RE_UserWow ?></td><td width=30></td></tr>
<tr><td align=right><B>Personaje:</b></td><td align=left><input value='<?php echo $SPersonaje?>' id=SPersonaje name=SPersonaje type=text size=15></td><td width=30></td></tr>
</table>
<table bgcolor=#CCFFCC align=left>
<tr><td  colspan=4 align=center><B>Atributos</B></td></tr>
<tr>
<td align=right><B>F&iacute;sico:</B></td><td align=left><input value=<?php echo $SFisico?> style='width:40px' id=SFisico name=SFisico type=number min="4" max="10"></td>
<td align=right><B>Inteligencia:</B></td><td align=left><input value=<?php echo $SInteligencia?> style='width:40px' id=SInteligencia name=SInteligencia type=number min="4" max="10"></td>
</tr>
<tr>
<td align=right><B>Destreza:</B></td><td align=left><input value=<?php echo $SDestreza?> style='width:40px' id=SDestreza name=SDestreza type=number min="4" max="10"></td>
<td align=right><B>Percepci&oacute;n:</B></td><td align=left><input value=<?php echo $SPercepcion?> style='width:40px' id=SPercepcion name=SPercepcion type=number min="4" max="10"></td>
</tr>
</table>

<table width=30px align=left>
<tr height=30><td></td></tr>
<tr height=30><td></td></tr>
<tr height=30><td></td></tr>
</table>
<input type=hidden id=SVida name=SVida value=<?php echo $SFisico*4?>>
<input type=hidden id=SMana name=SMana value=<?php echo $SInteligencia*3?>>
<input type=hidden id=SIniciativa name=SIniciativa value=<?php echo $SPercepcion?>>
<input type=hidden id=SDefensa name=SDefensa value=<?php echo $SDestreza?>>
<table bgcolor=#CCCCFF align=left>
<tr>
<td  colspan=2 align=left><B>Valores de Combate</B></td>
<td align=right color=red> Puntos disponibles:</td><td align=left style='color:red'><B><?php echo $RestAttr ?></B></td>
</tr>
<tr>
<td align=right><B>Vida:</B></td><td align=left><?php echo $SFisico*4?></td>
<td align=right><B>Mana:</B></td><td align=left><?php echo $SInteligencia*3?></td>
</tr>
<tr>
<td align=right><B>Iniciativa:</B></td><td align=left><?php echo $SPercepcion ?></td>
<td align=right><B>Defensa:</B></td><td align=left><?php echo $SDestreza ?></td>
</tr>
</table>
<table width=100%>
<tr>
<td width=15% ><input type=submit value='Calcular'></td>
<td width=15% ><input type=button value='Enviar' onclick='return OkSend()'></td><td></td>
</tr>
<tr><td colspan=2 style='color:red'><b>Presionar siempre sobre 'Calcular' antes de enviar la ficha</b></td></tr>
</table>
<table bgcolor=#CCFFCC width=100%>
<tr>
<td  colspan=4 align=center><B>Habilidades</B></td>
<td  colspan=8 align=left>Puntos disponibles:<B style='color:red'><?php echo $RestHab; ?></B></td>
</tr>
<tr>
<td colspan=3 align=left bgcolor=#FFCCCC><B>F&iacute;sico</B></td>
<td colspan=3 align=left bgcolor=#FFFF00><B>Destreza</B></td>
<td colspan=3 align=left bgcolor=#CCCCFF><B>Inteligencia</B></td>
<td colspan=3 align=left bgcolor=#FFFFCC><B>Percepci&oacute;n</B></td>
<?php
for ($LoopVar=0;$LoopVar<NUM_HABI;$LoopVar++)
{
   echo "<tr>\n";

   printf ( "<td width=10%% align=right><select style='width:100px' name=SFisN%d id=SFisN%d onchange='return CFis(%d, this);'>\n", $LoopVar, $LoopVar, $LoopVar );
   if ( $SHabFisVal[$LoopVar] == 0 )
      echo "<option value='' selected></option>\n";
   else
      echo "<option value=''></option>\n";
   foreach ($SHab_Fisico as $MyKey => $MyValue)
   {
	  if ($MyValue["RE_ID"] == $SHabFisNom[$LoopVar])
         echo "<option value=".$MyValue["RE_ID"]." selected>".$MyValue["RE_Nombre"]."</option>\n";
	  else
         echo "<option value=".$MyValue["RE_ID"].">".$MyValue["RE_Nombre"]."</option>\n";
   }	  
   printf ( "</select></td><td align=left width=5%%><input style='width:40px' type=number min='0' max='2' value=".$SHabFisVal[$LoopVar]." name=SFisV%d id=SFisV%d></td>\n", $LoopVar, $LoopVar );
   printf ( "<td align=left width=10%%><input type=text size=20 value='".$SHabFisEfe[$LoopVar]."' name=SFisE%d id=SFisE%d></td>\n", $LoopVar, $LoopVar );

   printf ( "<td width=10%% align=right><select style='width:100px' name=SDesN%d id=SDesN%d onchange='return CDes(%d, this);'>\n", $LoopVar, $LoopVar, $LoopVar );
   if ( $SHabDesVal[$LoopVar] == 0 )
      echo "<option value='' selected></option>\n";
   else
      echo "<option value=''></option>\n";
   foreach ($SHab_Destreza as $MyKey => $MyValue)
   {
	  if ($MyValue["RE_ID"] == $SHabDesNom[$LoopVar])
         echo "<option value=".$MyValue["RE_ID"]." selected>".$MyValue["RE_Nombre"]."</option>\n";
	  else
         echo "<option value=".$MyValue["RE_ID"].">".$MyValue["RE_Nombre"]."</option>\n";
   }	  

   printf ( "</select></td><td align=left width=5%%><input style='width:40px' type=number min='0' max='2' value=".$SHabDesVal[$LoopVar]." name=SDesV%d id=SDesV%d></td>\n", $LoopVar, $LoopVar );
   printf ( "<td align=left width=10%%><input type=text size=20 value='".$SHabDesEfe[$LoopVar]."' name=SDesE%d id=SDesE%d></td>\n", $LoopVar, $LoopVar );

   
   
   printf ( "<td width=10%% align=right><select style='width:100px' name=SIntN%d id=SIntN%d onchange='return CInt(%d, this);'>\n", $LoopVar, $LoopVar, $LoopVar );
   if ( $SHabIntVal[$LoopVar] == 0 )
      echo "<option value='' selected></option>\n";
   else
      echo "<option value=''></option>\n";
   foreach ($SHab_Inteligencia as $MyKey => $MyValue)
   {
	  if ($MyValue["RE_ID"] == $SHabIntNom[$LoopVar])
         echo "<option value=".$MyValue["RE_ID"]." selected>".$MyValue["RE_Nombre"]."</option>\n";
	  else
         echo "<option value=".$MyValue["RE_ID"].">".$MyValue["RE_Nombre"]."</option>\n";
   }	  
   printf ( "</select></td><td align=left width=5%%><input style='width:40px' type=number min='0' max='2' value=".$SHabIntVal[$LoopVar]." name=SIntV%d id=SIntV%d></td>\n", $LoopVar, $LoopVar );
   printf ( "<td align=left width=10%%><input type=text size=20 value='".$SHabIntEfe[$LoopVar]."' name=SIntE%d id=SIntE%d></td>\n", $LoopVar, $LoopVar );

   printf ( "<td width=10%% align=right><select style='width:100px' name=SPerN%d id=SPerN%d onchange='return CPer(%d, this);'>\n", $LoopVar, $LoopVar, $LoopVar );
   if ( $SHabPerVal[$LoopVar] == 0 )
      echo "<option value='' selected></option>\n";
   else
      echo "<option value=''></option>\n";
   foreach ($SHab_Percepcion as $MyKey => $MyValue)
   {
	  if ($MyValue["RE_ID"] == $SHabPerNom[$LoopVar])
         echo "<option value=".$MyValue["RE_ID"]." selected>".$MyValue["RE_Nombre"]."</option>\n";
	  else
         echo "<option value=".$MyValue["RE_ID"].">".$MyValue["RE_Nombre"]."</option>\n";
   }	  
   printf ( "</select></td><td align=left width=5%%><input style='width:40px' type=number min='0' max='2' value=".$SHabPerVal[$LoopVar]." name=SPerV%d id=SPerV%d></td>\n", $LoopVar, $LoopVar );
   printf ( "<td align=left width=10%%><input type=text size=20 value='".$SHabPerEfe[$LoopVar]."' name=SPerE%d id=SPerE%d></td>\n", $LoopVar, $LoopVar );


   echo "</tr>\n";
}
?>
</table>
</form>
</body>
</html>
