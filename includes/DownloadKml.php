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

header("Content-Type: application/vnd.google-earth.kml+xml; charset=UTF-8;");
header("Content-Disposition: attachment; filename=\"dados.kml\";");

$kmlBody  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\r\n";
$kmlBody .= "<kml xmlns=\"http://earth.google.com/kml/2.2\">\r\n";
$kmlBody .= "\t<Document>\r\n";

while ($telec = mysql_fetch_array($resBusca)) {
  	$kmlBody .= "\t\t<Placemark>\r\n";
  	$kmlBody .= "\t\t\t<name>" . limpaString($telec['razao_social']) . "</name>\r\n";
  	$kmlBody .= "\t\t\t<description>\r\n\t\t\t<![CDATA[\r\n";
  	
  	if (isset($telec['endereco'])) {
  		$kmlBody .= "\t\t\t\t<b>Endere&ccedil;o:</b><br />\r\n";
  		$kmlBody .= "\t\t\t\t" . limpaString(str_replace("\n","<br />\r\n",$telec['endereco'])) . "\n\n";
  	}

  	$kmlBody .= limpaString($telec['municipio']) . " - " . limpaString($telec['uf']) . "<br />\r\n";

  	if (isset($telec['cep'])) {
  		$kmlBody .= "\t\t\t\tCEP: " . $telec['cep'] . "<br />";
  	}

  	$kmlBody .= "<br />\r\n\r\n";

  	$kmlBody .= "\t\t\t]]>\r\n\t\t\t</description>\r\n";
  	$kmlBody .= "\t\t\t<Point>\r\n\t\t\t\t<coordinates>" . limpaString($telec['longitude'] ) . "," . limpaString($telec['latitude']) . "</coordinates>\r\n\t\t\t</Point>\r\n";
  	$kmlBody .= "\t\t</Placemark>\r\n";
}

$kmlBody .= "\t</Document>\r\n";
$kmlBody .= "</kml>";

echo($kmlBody);
