<?php
include_once ( "classes/setup.php");
$MyList=array();
$MyQuery = "SELECT RE_Account, RE_pj , RE_DateUpd, RE_Status, RE_SHA from RE_Atributos_SOL order by RE_Status, RE_DateUpd;";
$MyResult = $db_chars->doQuery($MyQuery);
while ($row=$db_chars->NextRow())
{
      $MyTmp=array();
	  $MyTmp["RE_Account"] = $row["RE_Account"];
	  $MyTmp["RE_pj"] = $row["RE_pj"];
	  $MyTmp["RE_DateUpd"] = $row["RE_DateUpd"];
	  switch ( $row["RE_Status"] )
	  {
         case 1:
	        $MyTmp["RE_Status"] = "Pendiente";
			break;
         case 2:
	        $MyTmp["RE_Status"] = "En revisión";
			break;
         case 3:
	        $MyTmp["RE_Status"] = "Aprobada";
			break;
         case 4:
	        $MyTmp["RE_Status"] = "Rechazada";
			break;
	  }
	  $MyTmp["RE_SHA"] = $row["RE_SHA"];
	  $MyList[]=$MyTmp;
}
//else
//	die ($db_chars->ShowErrorDie("No se ha podido realizar la consulta(".$MyQuery.")"));
?>
<html>
<head>
<script>
function GoApp(MySHA)
{
	document.location = 'RE_SolRev.php?SHA=' + MySHA; 
}
</script>
</head>
<body>
<table width=70%>
<tr bgcolor=yellow>
<td> Jugador </td> <td> Personaje </td> <td> Estado Sol. </td> <td> Fecha </td>
</tr>
<?php 
foreach ($MyList as $MyKey => $MyValue) 
{
	echo "<tr onclick=\"return GoApp('".$MyValue["RE_SHA"]."');\">";
	echo "<td>" . $MyValue["RE_Account"] . "</td>";
	echo "<td>" . $MyValue["RE_pj"] . "</td>";
	echo "<td>" . $MyValue["RE_Status"] . "</td>";
	echo "<td>" . substr( $MyValue["RE_DateUpd"], 6, 2) . "/" .
                  substr( $MyValue["RE_DateUpd"], 4, 2) . "/" .	
                  substr( $MyValue["RE_DateUpd"], 0, 4) . " " .	
                  substr( $MyValue["RE_DateUpd"], 8, 2) . ":" .	
                  substr( $MyValue["RE_DateUpd"],10, 2) . 
	     "</td>";
	echo "</tr>";
}
?>
</table>
</body>
</html>
