<?php
require_once('utils.inc.php');
set_time_limit(180);
header("Content-Type: text/html; charset=iso-8859-1;");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

if ($_GET['lat'] && $_GET['lon'] && $_GET['ntelec']) {
	$lat = $_GET['lat'];
	$long = $_GET['lon'];
	$ntelec = $_GET['ntelec'];
	$sqlBusca .= "SQRT((({$lat}-t.`LATITUDE`)*({$lat}-t.`LATITUDE`))+(({$long}-t.`LONGITUDE`)*({$long}-t.`LONGITUDE`))) as DISTANCIA,";
}

$sqlBusca .= "t.* FROM `telecentros` t ";
$sqlBusca .= "INNER JOIN `ipso_municipio` m ON t.COD_MUNICIPIO = m.codigo ";
$sqlBusca .= "INNER JOIN `ipso_uf` u ON m.id_uf = u.id_uf ";
$sqlBusca .= "WHERE ";

if ($_GET['projetos']) {
	$projetos = explode("|",$_GET['projetos']);
	
	$strProjetos = "";

	$sqlBusca .= "(";
	for ($i=0; $i<count($projetos); $i++) {
		$sqlBusca .= "(";
		$sqlBusca .= "`PROJETO` = '{$projetos[$i]}' OR ";
		$sqlBusca .= "`PROJETO` LIKE '{$projetos[$i]},%' OR ";
		$sqlBusca .= "`PROJETO` LIKE '%,{$projetos[$i]},%' OR ";
		$sqlBusca .= "`PROJETO` LIKE '%,{$projetos[$i]}'";
		$sqlBusca .= ") OR ";
	}

	$sqlBusca = substr($sqlBusca, 0, -4);
	$sqlBusca .= ") AND ";
}

if ($_GET['cidade']) {
	$sqlBusca .= "(";
	$sqlBusca .= "m.codigo = {$_GET['cidade']}";
	$sqlBusca .= ") AND ";
} elseif ($_GET['uf']) {
	$sqlBusca .= "(";
	$sqlBusca .= "u.uf = '{$_GET['uf']}'";
	$sqlBusca .= ") AND ";
}

if ($_GET['pchave']) {
	$palavraschave = explode(" ",$_GET['pchave']);
	$camposSearch = array('TELECENTRO', 'ENTIDADE', 'BAIRRO', 'ENDERECO', 'TELEFONE', 'TELEFONE2', 'TELEFONE3', 'EMAIL', 'EMAIL2', 'EMAIL3');

	$sqlBusca .= "(";
	for ($i=0; $i<count($palavraschave); $i++) {
		$sqlBusca .= "(";
		for ($j=0; $j<count($camposSearch); $j++) {
			$sqlBusca .= "(`{$camposSearch[$j]}` LIKE '%" . utf8_encode($palavraschave[$i]) . "%') OR ";
		}
		$sqlBusca = substr($sqlBusca, 0, -4);
		$sqlBusca .= ") AND ";
	}
	$sqlBusca = substr($sqlBusca, 0, -5);
	$sqlBusca .= ") AND ";
}
$sqlBusca .="`VISIVEL` = 1 ORDER BY ";

if ($_GET['lat'] && $_GET['lon']) {
	$sqlBusca .= "DISTANCIA, ";
}

$sqlBusca .="m.nome, t.TELECENTRO ";

if ($_GET['lat'] && $_GET['lon']) {
	$sqlBusca .= "LIMIT 0, $ntelec";
}

$resTelecentros = query($sqlBusca);

$CsvBody = "";

$count = 1;
while ($telec = mysql_fetch_array($resTelecentros)) {
	$CsvBody .= "<h3>$count) " . limpaString($telec['TELECENTRO']) . "</h3>\r\n";

	$projTelecentro = explode(",",$telec['PROJETO']);
	$strProjetos = "";

	for ($i=0; $i<count($projTelecentro); $i++) {
		$myProjeto = mysql_fetch_array(query(sprintf($sqlGetProjetoById,$projTelecentro[$i])));
		$strProjetos .= $myProjeto['NOME'] . ", ";
	}
	$strProjetos = substr($strProjetos, 0 , -2);
	$CsvBody .= '<table cellpading="0" cellspace="0">' . "\r\n";

	$CsvBody .= '<tr><td class="nome">Projetos:</td><td class="valor">' . limpaString($strProjetos) . "</td></tr>\r\n";

	if ($telec['ENTIDADE']) {
		$CsvBody .= '<tr><td class="nome">Entidade:</td><td class="valor">' . limpaString($telec['ENTIDADE']) . "</td></tr>\r";
	}

	$CsvBody .= '<tr><td class="nome">Endere&ccedil;o:</td><td class="valor">' .
		limpaString($telec['ENDERECO']) . ' - ' . $telec['BAIRRO'] . "<br>" .
		limpaString($telec['MUNICIPIO']) . " - " . limpaString($telec['ESTADO']) . "<br>" .
		$telec['CEP'] . "</td></tr>\r";

	if ($telec['LATITUDE']) {
		$CsvBody .= '<tr><td class="nome">Latitude:</td><td class="valor">' . $telec['LATITUDE'] . "</td></tr>\r";
	}

	if ($telec['LONGITUDE']) {
		$CsvBody .= '<tr><td class="nome">Longitude:</td><td class="valor">' . $telec['LONGITUDE'] . "</td></tr>\r";
	}
		
	if ($telec['TELEFONE']) {
		$CsvBody .= '<tr><td class="nome">Telefones:</td><td class="valor">' . $telec['TELEFONE'] . "</td></tr>\r";
	}

	if ($telec['EMAIL']) {
		$CsvBody .= '<tr><td class="nome">Emails:</td><td class="valor">' . $telec['EMAIL'] . "</td></tr>\r";
	}
	
	$CsvBody .= '</table>' . "\r\n";
	$CsvBody .= "\r\n";
	
	$count++;
}

$CsvBody .= "</dl></body>";

echo($CsvBody);
?>
