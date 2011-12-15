<?
require_once('utils.inc.php');
header("Content-Type: text/plain; charset=UTF-8");

if (isset($_GET['UF'])) {
	$uf = $_GET['UF'];
} else {
	$uf = null;
}
	
if ($uf != NULL) {
	$resMunicipios = query(sprintf($sqlGetMunicipiosByCodUf,$uf));

	if (!isset($jsonOutput)) {
		$jsonOutput = '';
	}
	
	$jsonOutput .= '    [' . "\r\n";

	while ($myMunicipio = mysql_fetch_array($resMunicipios)) {
		$jsonOutput .= '      {' . "\r\n";
		$jsonOutput .= '        "cod": "' . $myMunicipio['codigo'] . '",' . "\r\n";
		$jsonOutput .= '        "nome": "' . $myMunicipio['nome'] . '"' . "\r\n";
		$jsonOutput .= '      },' . "\r\n";
	}
		
	$jsonOutput = substr($jsonOutput, 0, -3);
	$jsonOutput .= "\r\n";

	$jsonOutput .= '    ]' . "\r\n";

	echo($jsonOutput);

}
?>
