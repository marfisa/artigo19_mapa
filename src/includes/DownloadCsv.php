<?php
require_once('utils.inc.php');
set_time_limit(180);

function limpaString($string) {
	if (substr($string, -2) == ', ') {
		$string = substr($string, 0 , -2);
	} elseif (substr($string, -1) == ',' || substr($string, -1) == ' ') {
		$string = substr($string, 0 , -1);
	}

	return str_replace(array("\r\n","\n"),array(" "," "),htmlspecialchars($string, ENT_NOQUOTES));
}

$sqlBusca = "SELECT ";

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
	for ($i=0; $i < count($palavraschave); $i++) {
		$sqlBusca .= "(";
		for ($j=0; $j < count($camposSearch); $j++) {
			$sqlBusca .= "(`{$camposSearch[$j]}` LIKE '%" . utf8_encode($palavraschave[$i]) . "%') OR ";
		}
		$sqlBusca = substr($sqlBusca, 0, -4);
		$sqlBusca .= ") AND ";
	}	
	$sqlBusca = substr($sqlBusca, 0, -5);
	$sqlBusca .= ") AND ";
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

header("Content-Type: text/x-csv; charset=UTF-8;");
header("Content-Disposition: attachment; filename=\"dados.csv\";");

//$CsvBody = utf8_decode('"Razão social";"UF";"Município";"Endereço";"Bairro";"CEP";"Rádio licenciada?";"Canal";"Frequência";"Indicador";"Latitude";"Longitude";"Telefone";"Email";') . "\r\n";
$CsvBody = utf8_decode('"Razão social";"UF";"Município";"Endereço";"Licença";"Canal";"Frequência";"Indicador";"Latitude";"Longitude"') . "\r\n";

while ($telec = mysql_fetch_array($resBusca)) {
	$CsvBody .= '"' . limpaString($telec['razao_social']) . '";';

	$CsvBody .= '"' . (isset($telec['uf']) ? limpaString($telec['uf']) : '') . '";';
	$CsvBody .= '"' . (isset($telec['municipio']) ? limpaString($telec['municipio']) : '') . '";';
	$CsvBody .= '"' . (isset($telec['endereco']) ? limpaString($telec['endereco']) : '') . '";';
	//$CsvBody .= '"' . (isset($telec['bairro']) ? $telec['bairro'] : '') . '";';
	//$CsvBody .= '"' . (isset($telec['cep']) ? $telec['cep'] : '') . '";';
	$CsvBody .= '"' . imprimeLicenca($telec['licenca']) . '";';
	$CsvBody .= '"' . (isset($telec['canal']) ? $telec['canal'] : '') . '";';
	$CsvBody .= '"' . (isset($telec['frequencia']) ? $telec['frequencia'] : '') . '";';
	$CsvBody .= '"' . (isset($telec['indicador']) ? $telec['indicador'] : '') . '";';
	$CsvBody .= '"' . (isset($telec['latitude']) ? $telec['latitude'] : '') . '";';
	$CsvBody .= '"' . (isset($telec['longitude']) ? $telec['longitude'] : '') . '";';
	//$CsvBody .= '"' . (isset($telec['telefone']) ? $telec['telefone'] : '') . '";';
	//$CsvBody .= '"' . (isset($telec['email']) ? $telec['email'] : '') . '";';
	$CsvBody .= "\r\n";
}
		
echo($CsvBody);