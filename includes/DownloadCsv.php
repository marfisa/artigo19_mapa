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
	for ($i=0; $i<count($projetos); $i++)
	{
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

header("Content-Type: text/x-csv; charset=UTF-8;");
header("Content-Disposition: attachment; filename=\"Telecentros.csv\";");

$CsvBody = utf8_decode('"Telecentro";"Projetos";"Entidade";"UF";"Município";"Endereço";"Bairro";"CEP";"Latitude";"Longitude";"Telefone";"Email";') . "\r\n";

while ($telec = mysql_fetch_array($resTelecentros)) {
	$CsvBody .= '"' . limpaString($telec['TELECENTRO']) . '";';

	$projTelecentro = explode(",",$telec['PROJETO']);
	$strProjetos = "";

	for ($i=0; $i<count($projTelecentro); $i++) {
		$myProjeto = mysql_fetch_array(query(sprintf($sqlGetProjetoById,$projTelecentro[$i])));
		$strProjetos .= $myProjeto['NOME'] . ", ";
	}
	$strProjetos = substr($strProjetos, 0 , -2);

	$CsvBody .= '"' . limpaString($strProjetos) . '";';
	$CsvBody .= '"' . limpaString($telec['ENTIDADE']) . '";';
	$CsvBody .= '"' . limpaString($telec['ESTADO']) . '";';
	$CsvBody .= '"' . limpaString($telec['MUNICIPIO']) . '";';
	$CsvBody .= '"' . limpaString($telec['ENDERECO']) . '";';
	$CsvBody .= '"' . $telec['BAIRRO'] . '";';
	$CsvBody .= '"' . $telec['CEP'] . '";';
	$CsvBody .= '"' . $telec['LATITUDE'] . '";';
	$CsvBody .= '"' . $telec['LONGITUDE'] . '";';
	$CsvBody .= '"' . $telec['TELEFONE'] . '";';
	$CsvBody .= '"' . $telec['EMAIL'] . '";';
	$CsvBody .= "\r\n";
}
		
echo($CsvBody);