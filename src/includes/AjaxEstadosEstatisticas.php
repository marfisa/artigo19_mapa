<?
require_once('utils.inc.php');
header("Content-Type: text/plain; charset=iso-8859-1");
	
$resPopEstados = query($sqlGetPopulacaoEstados);
$resPonEstados = query($sqlGetPontosEstados);
$resMunEstados = query($sqlGetMunicipiosEstados);
  
while($myPopEstado = mysql_fetch_array($resPopEstados)) {
	$myPopEstados[] = $myPopEstado;
	$myPonEstados[] = mysql_fetch_array($resPonEstados);
	$myMunEstados[] = mysql_fetch_array($resMunEstados);
}

$jsonOutput  = "{\r\n";

for ($i=0; $i<count($myPopEstados); $i++) {
	$jsonOutput .= "\t'{$myPopEstados[$i]['uf']}':\r\n";
	$jsonOutput .= "\t{\r\n";
	$jsonOutput .= "\t\t'nom': '{$myPonEstados[$i]['nome']}',\r\n";
	$jsonOutput .= "\t\t'pop': {$myPopEstados[$i]['contagem']},\r\n";
	$jsonOutput .= "\t\t'pon': {$myPonEstados[$i]['contagem']},\r\n";
	$jsonOutput .= "\t\t'mun': {$myMunEstados[$i]['contagem']}\r\n";
	$jsonOutput .= "\t},\r\n";
}

$jsonOutput = substr($jsonOutput, 0, -3);
$jsonOutput .= "\r\n";

$jsonOutput .= "}";

echo($jsonOutput);