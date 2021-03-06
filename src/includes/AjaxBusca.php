<?php
require_once('utils.inc.php');
header("Content-Type: text/plain; charset=UTF-8");

$sqlBusca  = "SELECT ";

if (isset($_GET['lat']) && isset($_GET['lon']) && isset($_GET['ntelec'])) {
	$lat = $_GET['lat'];
	$long = $_GET['lon'];
	$ntelec = $_GET['ntelec'];
	$sqlBusca .= "SQRT((({$lat}-t.`LATITUDE`)*({$lat}-t.`LATITUDE`))+(({$long}-t.`LONGITUDE`)*({$long}-t.`LONGITUDE`))) as DISTANCIA,";
}
  
$sqlBusca .= "t.*, m.nome as municipio FROM `radios_comunitarias` t ";
$sqlBusca .= "INNER JOIN `ipso_municipio` m ON t.COD_MUNICIPIO = m.codigo ";
$sqlBusca .= "INNER JOIN `ipso_uf` u ON m.id_uf = u.id_uf ";
$sqlBusca .= "WHERE ";

if (isset($_GET['cidade'])) {
	$sqlBusca .= "(";
	$sqlBusca .= "m.codigo = {$_GET['cidade']}";
	$sqlBusca .= ") AND ";
} elseif (isset($_GET['uf'])) {
	$sqlBusca .= "(";
	$sqlBusca .= "u.uf = '{$_GET['uf']}'";
	$sqlBusca .= ") AND ";
}
  
if (isset($_GET['pchave'])) {
	$palavraschave = explode(" ",$_GET['pchave']);
	$camposSearch = array('razao_social', 'endereco', 'indicador', 'frequencia');
	
	$sqlBusca .= "(";
	for ($i=0; $i<count($palavraschave); $i++) {
		$sqlBusca .= "(";
		for ($j=0; $j<count($camposSearch); $j++) {
			$sqlBusca .= "(`{$camposSearch[$j]}` LIKE '%" . $palavraschave[$i] . "%') OR ";
	  	}
		$sqlBusca = substr($sqlBusca, 0, -4);
		$sqlBusca .= ") AND ";
	}
	$sqlBusca = substr($sqlBusca, 0, -5);
	$sqlBusca .= ") AND ";
}

if (isset($_GET['tipo']) && $_GET['tipo']) {
	$sqlBusca .= " t.licenca = '{$_GET['tipo']}' AND ";
}

$sqlBusca .="`VISIVEL` = 1 ORDER BY ";

if (isset($_GET['lat']) && isset($_GET['lon'])) {
	$sqlBusca .= "DISTANCIA, ";
}

$sqlBusca .="m.nome, t.razao_social ";
  
if (isset($_GET['lat']) && isset($_GET['lon'])) {
	$sqlBusca .= "LIMIT 0, $ntelec";
}

$resBusca = query($sqlBusca);
$count = 1;

/* Gravar registro da pesquisa */

$logIP = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? '"' . $_SERVER['HTTP_X_FORWARDED_FOR'] . '"' : '"' . $_SERVER['REMOTE_ADDR'] . '"';
$logUF = isset($_GET['uf']) ? '"' . $_GET['uf'] . '"' : "NULL";
$logMunicipio = isset($_GET['cidade']) ? $_GET['cidade'] : "NULL";
$logEndereco = isset($_GET['end']) ? '"' . $_GET['end'] . '"' : "NULL";
$logNProx = isset($_GET['ntelec']) ? $_GET['ntelec'] : "NULL";
$logProjetos = isset($_GET['projetos']) ? '"' . $_GET['projetos'] . '"' : "NULL";
$logPChave = isset($_GET['pchave']) ? '"' . $_GET['pchave'] . '"' : "NULL";

$sqlLog = "INSERT INTO `log_utilizacao` VALUES(NULL, NOW()";
$sqlLog .= ", $logIP";
$sqlLog .= ', "' . $_SERVER['HTTP_USER_AGENT'] . '"';
$sqlLog .= ', NULL';
$sqlLog .= ", $logUF";
$sqlLog .= ", $logMunicipio";
$sqlLog .= ", $logEndereco";
$sqlLog .= ", $logNProx";
$sqlLog .= ", $logProjetos";
$sqlLog .= ", $logPChave";
$sqlLog .= ', ' . mysql_num_rows($resBusca);
$sqlLog .= ')';

query($sqlLog);

$jsonOutput = "{\r\n";
$jsonOutput .= "\"markers\":\r\n";
$jsonOutput .= "\t[\r\n";

while ($telec = mysql_fetch_array($resBusca)) {
	switch ($telec['licenca']) {
		case 'definitiva':
			$icone = "lic";
			break;
		case 'provisoria':
			$icone = 'plic';
			break;
		case 'sem':
			$icone = "nlic";
			break;
	}
	
  	$jsonOutput .= "\t\t{\r\n";
  	$jsonOutput .= "\t\t\t\"id\": {$telec['ID']},\r\n";
  	$jsonOutput .= "\t\t\t\"nom\": \"" . limpaString($telec['razao_social']) . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"mun\": \"" . limpaString($telec['municipio']) . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"end\": \"" . limpaString($telec['endereco']) . "\",\r\n";
	$jsonOutput .= "\t\t\t\"ico\": \"" . $icone . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"coo\": new GLatLng({$telec['latitude']},{$telec['longitude']})\r\n";
  	$jsonOutput .= "\t\t},\r\n";

  	$count++;
}
  
if ($count > 1) {
	$jsonOutput = substr($jsonOutput, 0, -3);
}
	
$jsonOutput .= "\r\n\t]\r\n";
$jsonOutput .= "}";

echo($jsonOutput);
  
/* Funções */
  
function limpaString($string)	{
	if (substr($string, -2) == ', ') {
		$string = substr($string, 0 , -2);
	} elseif (substr($string, -1) == ',' || substr($string, -1) == ' ') {
		$string = substr($string, 0 , -1);
	}

	$string = htmlspecialchars($string, ENT_COMPAT);
	return str_replace(array("\r\n","\n"),array(" "," "),$string);
}
