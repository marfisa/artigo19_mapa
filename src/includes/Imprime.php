<?php
require_once('utils.inc.php');
set_time_limit(180);
header("Content-Type: text/html; charset=iso-8859-1;");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1;" />
<title><?php echo SITE_TITLE;?></title>
<link href="../css/imprime.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1><?php echo SITE_TITLE;?></h1>
<?php
require_once('utils.inc.php');

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

$CsvBody = "";

$count = 1;
while ($telec = mysql_fetch_array($resBusca)) {
	$CsvBody .= "<h3>$count) " . limpaString($telec['razao_social']) . "</h3>\r\n";

	$CsvBody .= '<table cellpading="0" cellspace="0">' . "\r\n";

	$CsvBody .= '<tr><td class="nome">Endere&ccedil;o:</td><td class="valor">';
	
	if (isset($telec['endereco'])) {
		$CsvBody .= limpaString($telec['endereco']) . "<br>";
	}

	if (isset($telec['municipio']) && isset($telec['uf'])) {
		$CsvBody .= limpaString($telec['municipio']) . ' - ' . $telec['uf'] . "<br>";
	} else if (isset($telec['municipio'])) {
		$CsvBody .= limpaString($telec['municipio']) . "<br>";
	} else if (isset($telec['uf'])) {
		$CsvBody .= limpaString($telec['uf']) . "<br>";
	}

	$CsvBody .= isset($telec['CEP']) ? $telec['CEP'] : '';
	
	$CsvBody .= "</td></tr>\r";
	
	$CsvBody .= '<tr><td class="nome">R&aacute;dio licenciada:</td><td class="valor">' . (isset($telec['licenciado']) ? 'Sim' : 'N&atilde;o') . "</td></tr>\r";
	
	if (isset($telec['canal'])) {
		$CsvBody .= '<tr><td class="nome">Canal:</td><td class="valor">' . limpaString($telec['canal']) . "</td></tr>\r";
	}
	
	if (isset($telec['frequencia'])) {
		$CsvBody .= '<tr><td class="nome">Frequ&ecirc;ncia:</td><td class="valor">' . limpaString($telec['frequencia']) . "</td></tr>\r";
	}
	
	if (isset($telec['indicador'])) {
		$CsvBody .= '<tr><td class="nome">Indicador:</td><td class="valor">' . limpaString($telec['indicador']) . "</td></tr>\r";
	}

	if (isset($telec['latitude'])) {
		$CsvBody .= '<tr><td class="nome">Latitude:</td><td class="valor">' . $telec['latitude'] . "</td></tr>\r";
	}

	if (isset($telec['longitude'])) {
		$CsvBody .= '<tr><td class="nome">Longitude:</td><td class="valor">' . $telec['longitude'] . "</td></tr>\r";
	}
		
	if (isset($telec['telefone'])) {
		$CsvBody .= '<tr><td class="nome">Telefones:</td><td class="valor">' . $telec['telefone'] . "</td></tr>\r";
	}

	if (isset($telec['email'])) {
		$CsvBody .= '<tr><td class="nome">Emails:</td><td class="valor">' . $telec['email'] . "</td></tr>\r";
	}
	
	$CsvBody .= '</table>' . "\r\n";
	$CsvBody .= "\r\n";
	
	$count++;
}

$CsvBody .= "</dl></body>";

echo($CsvBody);
?>
